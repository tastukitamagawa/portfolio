let url = location.href;
const indexText = url.indexOf('/words');
const wordVoice = document.getElementById('word-voice');
const meaningVoice = document.getElementById('meaning-voice');
const word = document.getElementById('word');
const meaning = document.getElementById('meaning');

// csrfトークンの取得
let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// 新しいリクエストの取得
let xhr = new XMLHttpRequest();

// リクエストの設定
xhr.open('POST', '/get-words', true);

// リクエストヘッダーの設定
xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

console.log(xhr);


xhr.onreadystatechange = () =>{
    if(xhr.readyState === 4){
        if(xhr.status >= 200 && xhr.status < 300){
            let wordsData = JSON.parse(xhr.responseText);
            if(indexText > -1){
                let wordsCount = 0;
                
                const playNextWord = () => {
                    if(wordsCount === wordsData.length){
                        return;
                    }
                    // 音声の再生
                    let wordPlay = () => wordVoice.play();
                    let meaningPlay = () => meaningVoice.play();
                    
                    word.textContent = wordsData[wordsCount]['word'];
                    meaning.textContent = wordsData[wordsCount]['meaning'];

                    wordPlay();
                    wordVoice.addEventListener('ended', () => {
                        setTimeout(() => {
                            meaningPlay();
                        }, 1500);
                    }, {once: true});
                    meaningVoice.addEventListener('ended', () => {
                        setTimeout(() => {
                            wordsCount++;
                            playNextWord();
                        }, 1000);
                    }, {once: true});
                }   
                setTimeout(() => {
                    playNextWord();
                }, 1500)
            }
        } 
    }
}

// リクエストを送信
xhr.send();