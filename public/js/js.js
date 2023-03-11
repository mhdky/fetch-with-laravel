// get data dengan fetch
const postList = document.querySelector('.postList');
function getPostData() {
    fetch('/post/data')
        .then(response => response.json())
        .then(ok => {
            let posts = ok.posts;

            posts.forEach(post => {
                postDetailData(post)
            });
        })
}

getPostData();

function postDetailData(post) {
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
}




// live search
const searchInput = document.querySelector('#searchInput');
const searchResult = document.querySelector('#searchResult');
const loading = document.querySelector('.loading');

searchInput.addEventListener('keyup', (e) => {
    const searchText = e.target.value.trim();

    if (searchText.length > 0) {
        // Tampilkan loading
        loading.style.display = 'block';

        fetch(`/posts/search/${searchText}`)
            .then(response => response.json())
            .then(data => {
                // Sembunyikan loading
                loading.style.display = 'none';

                searchResult.innerHTML = '';

                if (data.length === 0) {
                    // Jika data tidak ditemukan, tampilkan pesan
                    noData();
                } else {
                    data.forEach(post => {
                        // jika data ditemukan
                        showData(post)
                    });
                }
            })
            .catch(error => console.log(error));
    } else {
        loading.style.display = 'none';
        searchResult.innerHTML = '';
    }
});

// function jika data tidak ditemukan
function noData() {
    const notFound = document.createElement('div');
    notFound.classList.add('text-gray-500', 'py-2');
    notFound.textContent = 'Data tidak ditemukan';
    searchResult.appendChild(notFound);
}

// function jika data ditemukan
function showData(post) {
    const link = document.createElement('a');
    link.href = `/posts/${post.slug}`;
    link.classList.add('w-full', 'h-full', 'flex', 'items-center');
    link.textContent = post.title;

    searchResult.appendChild(link);
}