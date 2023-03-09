const postList = document.querySelector('.postList');
function getPostData() {
    fetch('/post/data')
        .then(response => response.json())
        .then(data => {
            let posts = data.posts;
            let output = '';

            posts.forEach(post => {
                output += `
                    <div class="mb-5 pb-2 border-b border-zinc-400">
                        <h1 class="text-xl font-medium">${post.title}</h1>
                        <p class="mt-2 text-sm">${post.author}</p>
                        <p class="mt-2">${post.excerpt}</p>
                    </div>
                ` 
            });

            postList.innerHTML = output;
        })
}

getPostData();