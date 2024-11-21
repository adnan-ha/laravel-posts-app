@extends('layouts.app')

@section('title', 'posts')

@section('content')
@section('headTitle', $post->title)

<div class="row mb-3">
    <div class="col">
        <p class="my-4">{{ $post->description }}</p>
        <img src="/images/posts/{{ $post->image }}" class="show_img mw-100">
    </div>
</div>

@endsection
