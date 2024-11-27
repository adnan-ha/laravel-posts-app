@extends('layouts.app')

@section('title', 'posts')

@section('content')
@section('headTitle', $post->title)

<div class="row mb-3">
    <div class="col">
        <p class="my-4">{{ $post->description }}</p>
        @if ($post->image)
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                @foreach ($post->image as $image)
                    <div class="col mb-3">
                        <img src="/images/posts/{{ $image }}" class="show_img mw-100">
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection
