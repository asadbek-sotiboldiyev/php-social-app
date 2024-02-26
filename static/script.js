function like(btn, user_id){
    let command = 'like';
    let post_id = btn.value;
    let like_count = btn.parentElement.querySelector('.like-count');
    let likes = +like_count.textContent;

    let apiUrl = `http://localhost:8000/api?command=${command}&post_id=${post_id}&user_id=${user_id}`;

    fetch(apiUrl,  {mode:'cors'})
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // console.log(data);
            if(data['user'] != null && data['post'] != null){
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
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });

    
}