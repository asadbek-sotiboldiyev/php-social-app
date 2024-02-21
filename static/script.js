function like(btn){
    let like_count = btn.parentElement.querySelector('.like-count');
    let likes = +like_count.textContent;
    if(btn.classList.contains('liked')){
        btn.style=" background-color: #0d2137";
        btn.classList.remove('liked');
        like_count.textContent = likes-1;
    }else{
        btn.style=" background-color: #ff7d00";
        btn.classList.add('liked');
        like_count.textContent = likes+1;
    }
}