const postList = document.querySelector('.post-list');

function getPosts() {
    fetch('/post')
        .then(response => response.json())
        .then(data => {
            let posts = data.posts;
            let output = '';

            posts.forEach(post => {
                output += `
                <div">
                    <div>${post.title}</div> 
                    <p>${post.author}</p>
                    <p>${post.excerpt}</p>
                </div>
                `
            });

            postList.innerHTML = output;
        })
}

getPosts();