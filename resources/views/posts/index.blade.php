@extends('layouts.app')

@section('title', 'posts')

@section('content')
@section('headTitle', 'Posts:')
<a href="{{ route('posts.create') }}" class="btn btn-primary my-3">Add new post</a>
<div class="cards row row-cols-1 row-cols-sm-2 row-cols-lg-3">
    @forelse ($posts as $post)
        <div class="col mb-4">
            <div class="card h-100">
                @if ($post->image)
                    <img src="/images/posts/{{ $post->image[0] }}" class="card-img-top">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->description }}</p>
                </div>
                <div class="btns">
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-success">update</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-secondary float-end">show →</a>
                </div>
            </div>
        </div>
    @empty
        <h3 class="mt-4 text-danger">There is no data to show</h3>
    @endforelse
</div>

@endsection
