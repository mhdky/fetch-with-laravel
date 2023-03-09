const postList = document.querySelector('.postList');
function getPostData() {
    fetch('/post/data')
        .then(response => response.json())
        .then(data => {
            let posts = data.posts;
            let output = '';
            
            posts.forEach(post => {
                // Membuat elemen judul post
                const titleEl = document.createElement('h1');
                const titleText = document.createTextNode(post.title);
                titleEl.classList.add('text-xl', 'font-medium');
                titleEl.appendChild(titleText);

                // Membuat elemen penulis post
                const authorEl = document.createElement('p');
                const authorText = document.createTextNode(post.author);
                authorEl.classList.add('mt-2', 'text-sm');
                authorEl.appendChild(authorText);

                // Membuat elemen kutipan post
                const excerptEl = document.createElement('p');
                const excerptText = document.createTextNode(post.excerpt);
                excerptEl.classList.add('mt-2');
                excerptEl.appendChild(excerptText);

                // Membuat elemen utama untuk post dan menambahkan elemen judul, penulis, dan kutipan ke dalamnya
                const postEl = document.createElement('div');
                postEl.classList.add('mb-5', 'pb-2', 'border-b', 'border-zinc-400');
                postEl.appendChild(titleEl);
                postEl.appendChild(authorEl);
                postEl.appendChild(excerptEl);

                // Menambahkan elemen utama post ke dalam postList
                postList.appendChild(postEl);
            });
        })
}

getPostData();

setInterval(() => {
    getPostData();
}, 5000);