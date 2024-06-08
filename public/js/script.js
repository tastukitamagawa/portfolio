let url = location.href;
const indexText = url.indexOf('/words/');
const wordVoice = document.getElementById('word-voice');
const meaningVoice = document.getElementById('meaning-voice');

window.onload = () => {
    if(indexText > -1){
        
        // 音声の再生
        const wordPlay = () => wordVoice.play();
        const meaningPlay = () => meaningVoice.play();
        const redirect = () => window.location.href = '/';;

        const play = () => {
            wordPlay();
            wordVoice.addEventListener('ended', () => {
                setTimeout(meaningPlay, 2000);
            });
        }

        // 2秒経過したら再生する
        setTimeout(play, 1000);
    }
}