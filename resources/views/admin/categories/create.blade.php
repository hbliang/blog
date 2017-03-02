@extends('admin.layouts.default')

@section('title', 'Category Create')

@section('content')

    <div class="page-header">
        <h1>Create Category</h1>
    </div>

    <?php
    $form = [
            'url' => URL::route('admin.tags.store'),
            'method' => 'POST',
            'button' => 'Create New Category',
    ];
    ?>

    @include('admin.categories.form')

@endsection
