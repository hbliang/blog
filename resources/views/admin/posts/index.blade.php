@extends('admin.layouts.default')

@section('title', 'Posts')

@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1>Posts</h1>
        </div>
        <div class="col-xs-4">
            <h1 class="pull-right">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-plus"></i> New Post</a>
            </h1>
        </div>
    </div>
</div>

@forelse($posts as $post)
    <h2><a href="{{ route('posts.show', ['posts' => $post->id]) }}">{{ $post->title }}</a></h2>
    <pre>{!! $post->excerpt !!}</pre>
    <p class="pull-right">
        @can('update', $post)
        <a class="btn btn-info" href="{{ route('admin.posts.edit', ['posts' => $post->id]) }}"><i class="glyphicon glyphicon-pencil"></i> Edit Post</a>
        @endcan
        @can('delete', $post)
        <a class="btn btn-danger" href="{{ route('admin.posts.destroy', ['posts' => $post->id]) }}" data-toggle="modal" data-target="#delete_post_{{ $post->id }}"><i class="glyphicon glyphicon-trash"></i> Delete Post</a>
        @endcan
    </p>
    <br>
@empty
<h1>Sorry, No Posts</h1>
@endforelse

@if (count($posts))
{!! $posts->links() !!}
@endif

@endsection
