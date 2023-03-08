@extends('layouts.main')

@section('main')
    <div class="w-[800px] mx-auto mt-20">
        @foreach ($posts as $post)
            <div class="post-list"></div>
        @endforeach
    </div>

    <script src="{{ asset('js/js.js') }}"></script>
@endsection