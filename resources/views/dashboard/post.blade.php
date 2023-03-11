@extends('layouts.main')

@section('main')
    <div class="w-[800px] mx-auto mt-20 overflow-auto">

        <div class="btRefresh bg-green-500 w-max mb-5 px-4 py-2 rounded-md text-white text-sm cursor-pointer" id="refreshBtn">Refresh</div>

        {{-- tambah postingan --}}
        <form id="add-post-form" class="mb-5">
            @csrf
            <div class="flex flex-col">
            {{-- category --}}
            <label for="category" class="mb-1">Category</label>
            <select name="category" id="category" class="border border-zinc-500">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        
            {{-- title --}}
            <label for="title" class="mb-1 mt-3">Title</label>
            <input type="text" name="title" id="title" class="border border-zinc-500 px-2">
            @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        
            {{-- slug --}}
            <label for="slug" class="mb-1 mt-3">slug</label>
            <input type="text" name="slug" id="slug" class="border border-zinc-500 px-2">
            @error('slug')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        
            {{-- author --}}
            <label for="author" class="mb-1 mt-3">author</label>
            <input type="text" name="author" id="author" class="border border-zinc-500 px-2">
            @error('author')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
                        
            {{-- excerpt --}}
            <label for="excerpt" class="mb-1 mt-3">excerpt</label>
            <input type="text" name="excerpt" id="excerpt" class="border border-zinc-500 px-2">
            @error('excerpt')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror        
            
            <button type="submit" class="bg-blue-500 px-4 py-2 text-white text-sm mt-3">Simpan</button>
            </div>
        </form>

        <table class="w-max" id="postTable">
            <tr class="">
                <th class="border border-zinc-500 text-sm p-2">No</th>
                <th class="border border-zinc-500 text-sm p-2">Title</th>
                <th class="border border-zinc-500 text-sm p-2">Categories</th>
                <th class="border border-zinc-500 text-sm p-2">Slug</th>
                <th class="border border-zinc-500 text-sm p-2">Author</th>
                <th class="border border-zinc-500 text-sm p-2">Excerpt</th>
            </tr>
            
            @foreach ($posts as $post)
                <tr>
                    <td class="border border-zinc-500 text-sm p-2">{{ $loop->iteration }}</td>
                    <td class="border border-zinc-500 text-sm p-2">{{ $post->title }}</td>
                    <td class="border border-zinc-500 text-sm p-2">{{ $post->category->name }}</td>
                    <td class="border border-zinc-500 text-sm p-2">{{ $post->slug }}</td>
                    <td class="border border-zinc-500 text-sm p-2">{{ $post->author }}</td>
                    <td class="border border-zinc-500 text-sm p-2">{{ $post->excerpt }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <script>
        const csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.querySelector('#add-post-form').addEventListener('submit', (event) => {
            event.preventDefault();

            const data = {
                category: document.querySelector('#category').value,
                title: document.querySelector('#title').value,
                slug: document.querySelector('#slug').value,
                author: document.querySelector('#author').value,
                excerpt: document.querySelector('#excerpt').value,
                _token: csrf_token
            };

            const headers = new Headers();
            headers.append('Content-Type', 'application/json');
            headers.append('X-CSRF-TOKEN', csrf_token);

            fetch('/dashboard/post', {
                method: 'POST',
                headers: headers,
                body: JSON.stringify(data),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log(data.message);
                alert('Post created successfully');

                // menghapus value dari inputan setelah berhasil menambahkan postingan
                document.querySelector('#category').value = '';
                document.querySelector('#title').value = '';
                document.querySelector('#slug').value = '';
                document.querySelector('#author').value = '';
                document.querySelector('#excerpt').value = '';
            })
            .catch(error => {
                console.error(error);
                alert('Failed to create post');
            });
        });
    </script>
@endsection