let userSetting = document.getElementsByClassName("mypage-setting__icon");
let modalBg = document.querySelector(".modal__bg");
let modalCancelBtn = document.querySelectorAll(".modal-cancel-button");
const html = document.querySelector("html");
let scrollPosition = 0;


// ユーザー情報更新アイコンをクリックして、モーダルを開く
for(let i = 0; i < userSetting.length; i++){
    userSetting[i].addEventListener("click",  function(){
        let data = userSetting[i].dataset.user_update
        modalBg = document.getElementById(data);
        modalBg.classList.add("is--show");
        
        scrollPosition = document.documentElement.scrollTop;
        html.style.position = "fixed";
        html.style.top = `-${scrollPosition}px`
    });
}

// モーダルのキャンセルボタンをクリックすると、モーダルが閉じる
modalCancelBtn.forEach(function(btn){
    btn.addEventListener("click", function(){
        modalBg.classList.remove("is--show");
        html.style.position = "";
        html.style.top = "";
        window.scrollTo(0, scrollPosition);
    });
})