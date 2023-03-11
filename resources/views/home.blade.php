@extends('layouts.main')

@section('main')
    <div class="w-[600px] mx-auto mt-10">
        <form action="{{ route('search') }}" method="GET"><input type="text" name="search" id="search" class="border border-zinc-400 px-3 w-full"></form>

        <div class="w-full h-40 mt-5 border border-zinc-400 overflow-auto" id="search-results">
            @foreach ($searchResults as $post)
                <a href="#" class="w-full px-4 py-2 inline-block hover:bg-zinc-200">{{ $post->title }}</a>
            @endforeach
        </div>

        <div class="w-full mt-20">
            @foreach ($posts as $post)
                <h1>{{ $post->title }}</h1>
                <div class="mt-2 mb-5 text-sm text-zinc-500">{{ $post->author }}</div>
            @endforeach
        </div>

        <form action="{{ route('search') }}" method="GET"><input type="text" name="search" id="search-mobile" class="w-40 border border-zinc-400 px-3"></form>

        <div class="w-40 h-40 mt-5 border border-zinc-400 overflow-auto" id="search-results">
            @foreach ($searchResults as $post)
                <a href="#" class="w-full px-4 py-2 inline-block hover:bg-zinc-200">{{ $post->title }}</a>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var searchInput = document.getElementById('search');
            var searchResults = document.getElementById('search-results');
    
            searchInput.addEventListener('keyup', function(event) {
                var query = searchInput.value;
                if (query.length >= 3) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', '{{ route('search') }}?search=' + query, true);
                    xhr.onload = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var results = JSON.parse(xhr.responseText);
                            var output = '';
                            for (var i in results) {
                                output += '<a href="#" class="w-full px-4 py-2 inline-block hover:bg-zinc-200">' + results[i].title + '</a>';
                            }
                            searchResults.innerHTML = output;
                        }
                    };
                    xhr.send();
                } else {
                    searchResults.innerHTML = '';
                }
            });
        });



    // Menyeleksi input pencarian pada tampilan mobile dengan menggunakan querySelector
    const searchMobile = document.querySelector('#search-mobile');
    // Menambahkan event listener pada input pencarian
    searchMobile.addEventListener('keyup', function() {
        const query = this.value;
        if (query.length >= 3) {
            // Menggunakan fetch untuk mengambil data hasil pencarian dari server
            fetch('{{ route('search') }}?search=' + query)
                .then(response => response.json())
                .then(data => {
                    const searchResultsMobile = document.querySelector('#search-results-mobile');
                    // Menghapus konten sebelumnya pada elemen searchResultsMobile
                    searchResultsMobile.innerHTML = '';
                    // Membuat elemen <a> untuk menampilkan hasil pencarian
                    data.forEach(post => {
                        const link = document.createElement('a');
                        link.href = '#';
                        link.classList.add('w-full', 'px-4', 'py-2', 'inline-block', 'hover:bg-zinc-200');
                        link.textContent = post.title;
                        // Menambahkan elemen <a> ke elemen searchResultsMobile
                        searchResultsMobile.appendChild(link);
                    });
                })
                .catch(error => console.log(error));
        } else {
            // Menghapus konten pada elemen searchResultsMobile jika input pencarian kosong
            document.querySelector('#search-results-mobile').innerHTML = '';
        }
    });
    </script>
@endsection