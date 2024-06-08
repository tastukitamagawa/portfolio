<?php

namespace App\Http\Controllers;

require __DIR__ . '/../../../vendor/autoload.php';

use App\Models\Dictionary;
use Illuminate\Http\Request;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;

class WordsController extends Controller
{
    public function create($id){
        $word = Dictionary::where("user_id", auth()->id())->where('word_id', $id)->with('word')->orderBy('created_at')->first();

        // 環境変数に値を入れる
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/../../../text-to-speak.json');

        // 新しくクライアントを設定する
        $wordClient = new TextToSpeechClient();
        $meaningClient = new TextToSpeechClient();

        // 音声化対象のテキストの設定
        $wordInput = new SynthesisInput();
        $wordInput->setText($word->word->word);
        $meaningInput = new SynthesisInput();
        $meaningInput->setText($word->word->meaning);

        // 音声の設定
        $wordVoice = new VoiceSelectionParams();
        $wordVoice->setLanguageCode('en-US');
        $wordVoice->setSsmlGender(SsmlVoiceGender::FEMALE);
        $meaningVoice = new VoiceSelectionParams();
        $meaningVoice->setLanguageCode('en-US');
        $meaningVoice->setSsmlGender(SsmlVoiceGender::MALE);
        
        // ファイル形式の設定
        $wordAudioConfig = new AudioConfig();
        $wordAudioConfig->setAudioEncoding(AudioEncoding::MP3);
        $meaningAudioConfig = new AudioConfig();
        $meaningAudioConfig->setAudioEncoding(AudioEncoding::MP3);
        
        // オプションの指定
        $wordResponse = $wordClient->synthesizeSpeech($wordInput, $wordVoice, $wordAudioConfig);
        $meaningResponse = $meaningClient->synthesizeSpeech($meaningInput, $meaningVoice, $meaningAudioConfig);
        
        // 音声データーの取得
        $wordAudioContent = $wordResponse->getAudioContent();
        $meaningAudioContent = $meaningResponse->getAudioContent();
        
        // フォルダの作成
        $outputDir = storage_path('app/public/voice');
        if(!file_exists($outputDir)){
            mkdir($outputDir, 0777, true);
        }

        // 保存するファイル
        $wordOutputPath = $outputDir . '/word.mp3';
        $meaningOutputPath = $outputDir . '/meaning.mp3';

        // データをファイルの書き込む
        $wordResult = file_put_contents($wordOutputPath, $wordAudioContent);
        $meaningResult = file_put_contents($meaningOutputPath, $meaningAudioContent);
        
        $wordClient->close();
        $meaningClient->close();
        
        return view('words', compact('word'));
    }
}
