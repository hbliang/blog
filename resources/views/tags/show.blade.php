@extends('layouts.app')

@section('content')
    <h1 class="page-header">
        Tag
        <small>{{ $tag->name }}</small>
    </h1>

    <div class="row">
        <div class="list-group">
            @forelse($posts as $post)

                <a href="{{ route('posts.index', $post->getKey()) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $post->title }}</h5>
                        <small>{{ $post->created_at }}</small>
                    </div>
                    <p class="mb-1">{{ $post->excerpt }}</p>
                    <small>By {{ $post->user->name }}</small>
                </a>
            @empty
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <h1>Nothing~</h1>
                </a>
            @endforelse
        </div>
    </div>

    {{ $posts->links() }}
@endsection