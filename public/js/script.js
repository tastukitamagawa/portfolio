// URL
let url = location.href;
// 指定のワードのインデックス
const indexText = url.indexOf('/words');
// word
const wordVoice = document.getElementById('word-voice');
const wordVoiceChild = wordVoice.firstElementChild;
let wordVoiceSrc = wordVoiceChild.src;
const word = document.getElementById('word');
// meaning
const meaningVoice = document.getElementById('meaning-voice');
const meaningVoiceChild = meaningVoice.firstElementChild;
const meaning = document.getElementById('meaning');
let meaningVoiceSrc = meaningVoiceChild.src;
// wordsページボタン
const voiceStopButton = document.getElementById('voice-stop-button');
const voiceStartButton = document.getElementById('voice-start-button');

// 音声ファイルの変更
const getPath = (src) => {
    // インデックスの取得
    let voiceIndex = src.lastIndexOf('/');
    // パスの取得
    let voicePath = src.substring(0, voiceIndex + 1);

    return voicePath
}
let wordVoicePath = getPath(wordVoiceSrc);
let meaningVoicePath = getPath(wordVoiceSrc);

// csrfトークンの取得
let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// 新しいリクエストの取得
let xhr = new XMLHttpRequest();

// リクエストの設定
xhr.open('POST', '/get-words', true);

// リクエストヘッダーの設定
xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

xhr.onreadystatechange = () =>{
    if(xhr.readyState === 4){
        if(xhr.status >= 200 && xhr.status < 300){
            let wordsData = JSON.parse(xhr.responseText);
            if(indexText > -1){
                let wordsCount = 0;

                // 音声制御
                let isPlaying = true;
                
                const playNextWord = () => {
                    // 音声の読み込み
                    wordVoice.load();
                    meaningVoice.load();
                    
                    // すべてのデータが流れた場合や、停止されている場合
                    if(wordsCount === wordsData.length){
                        return window.location.href = '/';
                    } else if(!isPlaying){
                        return;
                    }

                    // 音声の再生
                    let wordPlay = () => {
                        wordVoice.play();
                    }
                    let meaningPlay = () => {
                        meaningVoice.play();
                    }
                    
                    // テキスト変更
                    word.textContent = wordsData[wordsCount]['word'];
                    meaning.textContent = wordsData[wordsCount]['meaning'];
                    // 音声ファイルデータ変更
                    wordVoiceChild.src  = wordVoicePath + 'word' + wordsData[wordsCount]['word_id'] + '.mp3';
                    meaningVoiceChild.src  = meaningVoicePath + 'meaning' + wordsData[wordsCount]['word_id'] + '.mp3';

                    wordPlay();
                    wordVoice.addEventListener('ended', () => {
                        // 音声が再生されていない場合、終了する
                        if(!isPlaying) return;
                        setTimeout(() => {
                            meaningPlay();
                        }, 1500);
                    }, {once: true});
                    meaningVoice.addEventListener('ended', () => {
                        // 音声が再生されていない場合、終了する
                        if(!isPlaying) return;
                        setTimeout(() => {
                            wordsCount++;
                            playNextWord();
                        }, 1000);
                    }, {once: true});
                }   

                // ボタン制御
                const voiceOperation = (button) =>{
                    button.addEventListener('click', function(){
                        this.classList.add('is-hide');
                        this.classList.remove('is-show');
                        if(button === voiceStopButton){
                            voiceStartButton.classList.add('is-show');
                            isPlaying = false;
                            return;
                        } else if(button === voiceStartButton){
                            voiceStopButton.classList.add('is-show');
                            isPlaying = true;
                            playNextWord();
                        }
                    });
                }
                voiceOperation(voiceStopButton);
                voiceOperation(voiceStartButton);
                
                setTimeout(() => {
                    playNextWord();
                }, 1500)
            }
        } 
    }
}

// リクエストを送信
xhr.send();