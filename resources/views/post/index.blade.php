@extends('layouts.main')

@section('main')
    <div class="w-[800px] mx-auto mt-20 pb-2 border-b border-zinc-300">
        <div class="w-full mb-5">
            <input type="search" id="searchInput" class="w-full border border-zinc-500 p-2">
        </div>

        <div class="w-full h-96 border border-zinc-500 mb-20 overflow-auto">
            <div class="w-full h-10 px-5 hover:bg-zinc-200">
                <div id="searchResult"></div>
                <img src="{{ asset('img/Spinner-1s-200px.svg') }}" alt="Loading" class="loading hidden">
            </div>
        </div>

        <div class="postList"></div>
    </div>
@endsection

@section('script-post')
        <script src="{{ asset('js/js.js') }}"></script>
@endsection