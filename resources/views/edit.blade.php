@extends('layouts.app')

@section('title', 'update-post')

@section('content')
@section('headTitle', 'Update Post:')

<form action="{{ route('posts.update', $post->id) }}" method="POST" class="mt-5" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">title:</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}"
            placeholder="post title">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">description:</label>
        <textarea class="form-control" id="description" name="description" rows="5" placeholder="post description">{{ $post->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">choose image:</label>
        <input class="form-control" type="file" id="formFile" name="image">
    </div>
    <input type="submit" value="send" class="btn btn-primary w-50 d-block m-auto">
</form>

@endsection
