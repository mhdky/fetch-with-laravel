@extends('layouts.main')

@section('main')
    <div class="w-[800px] mx-auto my-20 border border-zinc-500 p-5">
        {{-- berhasil --}}
        @if (session('ok'))
            <p class="text-green-600 mb-5">{{ session('ok') }}</p>
        @endif

        <form action="/dashboard" method="post">
            @csrf
            <div class="flex flex-col mb-10">
                {{-- category --}}
                <label for="category" class="mb-1">Category</label>
                <select name="category_id" id="category" class="border border-zinc-500 mb-3 py-1 px-2">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    {{ $message }}
                @enderror

                {{-- tittle --}}
                <label for="title" class="mb-1">Tittle</label>
                <input name="title" id="title" class="border border-zinc-500 mb-3 py-1 px-2">
                @error('title')
                    {{ $message }}
                @enderror

                {{-- slug --}}
                <label for="slug" class="mb-1">slug</label>
                <input name="slug" id="slug" class="border border-zinc-500 mb-3 py-1 px-2">
                @error('slug')
                    {{ $message }}
                @enderror

                {{-- author --}}
                <label for="author" class="mb-1">Author</label>
                <input name="author" id="author" class="border border-zinc-500 mb-3 py-1 px-2">
                @error('author')
                    {{ $message }}
                @enderror

                {{-- excerpt --}}
                <label for="excerpt" class="mb-1">Excerpt</label>
                <input name="excerpt" id="excerpt" class="border border-zinc-500 mb-3 py-1 px-2">
                @error('excerpt')
                    {{ $message }}
                @enderror
            
                <button type="submit" class="bg-blue-500 text-white py-2">Simpan</button>
            </div>
        </form>

        @foreach ($posts as $post)
            <div class="mb-5 pb-3 border-b border-zinc-500" data-post-id="{{ $post->id }}">
                <a href="{{ $post->slug }}" class="text-lg font-medium">{{ $post->title }}</a>
                <p class="text-sm mt-1">{{ $post->author }}</p>
                <a class="text-sm mt-1" href="{{ $post->category->slug }}">{{ $post->category->name }}</a>
                <p class="mt-2">{{ $post->excerpt }}</p>

                <div class="w-full flex justify-end mt-5">
                    <p class="cursor-pointer mr-3">Edit</p>
                    <p class="cursor-pointer" onclick="deletePost('{{ $post->id }}')">Delete</p>
                </div>
            </div>
        @endforeach

        <div class="alertHapus hidden fixed bottom-2 left-2 bg-blue-700 p-2 text-white rounded-md">Data berhasil dihapus</div>
    </div>

    <script>
        function deletePost(id) {
            fetch('/dashboard/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    document.querySelector(`[data-post-id="${id}"]`).remove();
                    document.querySelector('.alertHapus').style.display='block';
                } else {
                    alert('Failed to delete post');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Failed to delete post');
            });
        }

    </script>
@endsection