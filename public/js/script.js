// URL
const url = location.href;
// pathname
const pathname = location.pathname;
// word
const wordVoice = document.getElementById('word-voice');
const word = document.getElementById('word');
// meaning
const meaningVoice = document.getElementById('meaning-voice');
const meaning = document.getElementById('meaning');
// wordsページボタン
const voiceStopButton = document.getElementById('voice-stop-button');
const voiceStartButton = document.getElementById('voice-start-button');
const wordPrevButton = document.getElementById('word-prev-button');
const wordNextButton = document.getElementById('word-next-button');
// ナビゲーションボタン
const navButtons = document.getElementsByClassName('navigation-list__item');
const navButtonsArray = Array.from(navButtons);
// ログアウトボタン
const logoutButton = document.getElementById('logout-button');


// csrfトークンの取得
let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
// 新しいリクエストの取得
let xhr = new XMLHttpRequest();
// リクエストの設定
xhr.open('POST', '/get-words', true);
// リクエストヘッダーの設定
xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
// 非同期で単語の遷移
xhr.onreadystatechange = () =>{
    if(xhr.readyState === 4){
        if(xhr.status >= 200 && xhr.status < 300){
            let wordsData = JSON.parse(xhr.responseText);
            if(pathname === '/words'){
                let wordsCount = 0;
                const wordVoiceChild = wordVoice.firstElementChild;
                const meaningVoiceChild = meaningVoice.firstElementChild;
                let wordVoiceSrc = wordVoiceChild.src;
                let meaningVoiceSrc = meaningVoiceChild.src;

                // 音声ファイルの変更
                const getPath = (src) => {
                    // インデックスの取得
                    let voiceIndex = src.lastIndexOf('/');
                    // パスの取得
                    let voicePath = src.substring(0, voiceIndex + 1);

                    return voicePath
                }
                let wordVoicePath = getPath(wordVoiceSrc);
                let meaningVoicePath = getPath(meaningVoiceSrc);
                
                // 音声制御
                let isPlaying = true;
                let isWOrdOperation = false;

                // 前へ・次へボタン制御
                const wordOperation = (button, increment) => {
                    button.addEventListener('click', function() {
                        wordsCount += increment;
                        isWOrdOperation = true;
                    });
                };
                
                const displayAndPlayWord = () => {    
                    isPlaying = true;  

                    // 音声の読み込み
                    wordVoice.load();
                    meaningVoice.load();
                                
                    // ボタンのスタイル変更
                    if(wordsCount <= 0){
                        wordPrevButton.style.pointerEvents = 'none';
                        wordPrevButton.style.cursor = 'not-allowed';
                    } else{
                        wordPrevButton.style.pointerEvents = '';
                        wordPrevButton.style.cursor = '';
                    }

                    // すべてのデータが流れた場合や、停止されている場合
                    if(wordsCount === wordsData.length){
                        return window.location.href = '/';
                    } 

                    if(wordsCount < 0){
                        wordsCount = 0;
                    }

                    // テキスト変更
                    word.textContent = wordsData[wordsCount]['word'];
                    meaning.textContent = wordsData[wordsCount]['meaning'];
                    // 音声ファイルデータ変更
                    wordVoiceChild.src  = wordVoicePath + 'word' + wordsData[wordsCount]['word_id'] + '.mp3';
                    meaningVoiceChild.src  = meaningVoicePath + 'meaning' + wordsData[wordsCount]['word_id'] + '.mp3';
                    
                    // 音声の再生
                    wordVoice.addEventListener('canplay', () => {
                        if(isPlaying) {
                            wordVoice.play().catch(() => {
                                return window.location.href = '/';
                            });
                        }
                    }, {once: true});
                    wordVoice.addEventListener('ended', () => {
                        // 音声が再生されていない場合、終了する
                        if(!isPlaying) return;
                        setTimeout(() => {
                            meaningVoice.play();
                        }, 1500);
                    }, {once: true});
                    meaningVoice.addEventListener('ended', () => {
                        // 音声が再生されていない場合、終了する
                        if(!isPlaying) return;
                        setTimeout(() => {
                            if(!isWOrdOperation){
                                wordsCount++;
                            }
                            displayAndPlayWord();
                            isWOrdOperation = false;
                        }, 1000);
                    }, {once: true});
                }   
                wordOperation(wordNextButton, 1);
                wordOperation(wordPrevButton, -1);

                // 停止・再生ボタン制御
                const voiceOperation = (button) =>{
                    button.addEventListener('click', function(){
                        this.classList.add('is-hide');
                        this.classList.remove('is-show');
                        if(button === voiceStopButton){
                            voiceStartButton.classList.add('is-show');
                            isPlaying = false;
                            wordVoice.pause();
                            meaningVoice.pause();
                        } else if(button === voiceStartButton){
                            voiceStopButton.classList.add('is-show');
                            isPlaying = true;
                            displayAndPlayWord();
                        }
                    });
                }
                voiceOperation(voiceStopButton);
                voiceOperation(voiceStartButton);
                
                setTimeout(() => {
                    console.log(displayAndPlayWord());
                    displayAndPlayWord();
                }, 1500)
            }
        } 
    }
}
// リクエストを送信
xhr.send();


//現在ページが分かるようにナビゲーションボタンに印を付ける
window.addEventListener('load', () => {
    // ページ名の取得
    let urlIndex = url.lastIndexOf('/');
    let urlPath = url.substring(urlIndex + 1);
    
    navButtonsArray.forEach(navButton => {
        let currentPage = navButton.getAttribute('data-page');
        if(currentPage === 'top'){
            currentPage = '';
        }
        navButton.classList.remove('is-current');
        if(urlPath === currentPage){
            navButton.classList.add('is-current');
        } else if(urlPath === 'words'){
            document.querySelector('[data-page="top"]').classList.add('is-current');
        } else if(url.indexOf('word-update') > 1){
            document.querySelector('[data-page="words-register"]').classList.add('is-current');
        }
    });
});