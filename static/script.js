function like(btn){
    let like_count = btn.parentElement.querySelector('.like-count');
    let likes = +like_count.textContent;
    if(btn.classList.contains('liked')){
        btn.classList.remove('liked');
        btn.classList.add('dis-liked');
        like_count.textContent = likes-1;
    }else{
        btn.classList.remove('dis-liked');
        btn.classList.add('liked');
        like_count.textContent = likes+1;
    }
}