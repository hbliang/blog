@extends('layouts.app')

@section('content')

    <h1 class="page-header">
        Welcome
        <small>No Title</small>
    </h1>

    @forelse($posts as $post)

            <!-- First Blog Post -->
    <div class="row">
        @if($post->cover)
            <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
                <img src="{{ $post->cover }}" class="img-rounded center-block" alt="{{ $post->title }}" width="150">
            </div>
        @endif
        <div class="col-md-9 col-lg-9 col-xs-12 col-sm-12">
            <p class="strong" style="font-size: 23px;">
                <a href="{{ route('posts.show', $post->getKey()) }}">{{ $post->title }}</a>
            </p>
            <p>{{ $post->excerpt }}</p>
            <p>
                @foreach($post->tags as $tag)
                    <a style="text-decoration: none;" href="{{ route('tags.index', $tag->getKey()) }}">
                        <label style="cursor: pointer;" class="label label-default"><i class="glyphicon glyphicon-tag">{{ $tag->name }}</i></label>
                    </a>
                @endforeach
            </p>
            <p>
                <i class="glyphicon glyphicon-user"></i> {{ $post->user->name }} |
                <i class="glyphicon glyphicon-time"></i> {{ $post->created_at }} |
                <i class="glyphicon glyphicon-eye-open"></i> {{ $post->views }} |
                <i class="glyphicon glyphicon-comment"></i> {{ $post->comments_count }}</p>
            {{--<a class="btn btn-primary" href="{{ route('posts.show', $post->getKey()) }}">Read More <span--}}
                        {{--class="glyphicon glyphicon-chevron-right"></span></a>--}}
        </div>
    </div>

    <hr>

    @empty
        <h1>Sorry, No Posts</h1>
    @endforelse


    {{--<!-- Pager -->--}}
    {{--<ul class="pager">--}}
    {{--<li class="previous">--}}
    {{--<a href="#">&larr; Older</a>--}}
    {{--</li>--}}
    {{--<li class="next">--}}
    {{--<a href="#">Newer &rarr;</a>--}}
    {{--</li>--}}
    {{--</ul>--}}

    {!! $posts->links() !!}

@endsection
