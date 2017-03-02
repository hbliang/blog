@extends('layouts.app')

@section('content')
    <h1 class="page-header">
        Tags
    </h1>

    <div class="row">
        @forelse($tags as $tag)
            <div class="col-lg-1">
                <a style="text-decoration: none;" href="{{ route('tags.show', $tag->getKey()) }}">
                    <label style="cursor: pointer;" class="label label-info">{{ $tag->name }}</label>
                </a>
            </div>
        @empty
            <h2>Sorry, No tag</h2>
        @endforelse
    </div>
@endsection