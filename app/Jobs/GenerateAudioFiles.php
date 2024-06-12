<?php

namespace App\Jobs;

require __DIR__ . '/../../vendor/autoload.php';

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Illuminate\Support\Facades\Log;

class GenerateAudioFiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $wordData;

    /**
     * Create a new job instance.
     */
    public function __construct($wordData)
    {
        $this->wordData = $wordData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // 環境変数に値を入れる
            putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/../../text-to-speak.json');

            // 新しくクライアントを設定する
            $wordClient = new TextToSpeechClient();
            $meaningClient = new TextToSpeechClient();

            // 音声化対象のテキストの設定
            $wordInput = new SynthesisInput();
            $meaningInput = new SynthesisInput();

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

            // フォルダの作成
            $outputDir = storage_path('app/public/voice');
            if (!file_exists($outputDir)) {
                mkdir($outputDir, 0777, true);
            }
            
            // ハッシュマップ
            $hashmap = [];
            foreach($this->wordData as $word){
                $hashmap[] = [
                    'word_id' => $word['word']['word_id'],
                    'word' => $word['word']['word'],
                    'meaning' => $word['word']['meaning'],
                ];
            }

            for ($i = 0; $i < count($hashmap); $i++) {
                $wordInput->setText($hashmap[$i]['word']);
                $meaningInput->setText($hashmap[$i]['meaning']);

                // 保存するファイル
                $wordOutputPath = $outputDir . '/word' . $hashmap[$i]['word_id'] . '.mp3';
                $meaningOutputPath = $outputDir . '/meaning' . $hashmap[$i]['word_id'] . '.mp3';
            
                // オプションの指定
                $wordResponse = $wordClient->synthesizeSpeech($wordInput, $wordVoice, $wordAudioConfig);

                $meaningResponse = $meaningClient->synthesizeSpeech($meaningInput, $meaningVoice, $meaningAudioConfig);
                
                // 音声データーの取得
                $wordAudioContent = $wordResponse->getAudioContent();

                $meaningAudioContent = $meaningResponse->getAudioContent();

                // データをファイルの書き込む
                file_put_contents($wordOutputPath, $wordAudioContent);
                file_put_contents($meaningOutputPath, $meaningAudioContent);
            }
            
            $wordClient->close();
            $meaningClient->close();
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
        }
    }
}