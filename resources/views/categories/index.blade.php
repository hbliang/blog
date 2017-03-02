@extends('layouts.app')

@section('content')
    <h1 class="page-header">
        Categories
    </h1>

    <div class="row">
        @forelse($categories as $category)
            <div class="col-lg-1">
                <a style="text-decoration: none;" href="{{ route('categories.show', $category->getKey()) }}">
                    <label style="cursor: pointer;" class="label label-primary">{{ $category->name }}</label>
                </a>
            </div>
        @empty
            <h2>No Category</h2>
        @endforelse
    </div>
@endsection