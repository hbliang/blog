@extends('admin.layouts.default')

@section('title', 'Edit Category')

@section('content')

    <div class="page-header">
        <h1>Edit Category</h1>
    </div>

    <?php
    $form = [
            'url' => URL::route('admin.tags.update', $category->id),
            'method' => 'POST',
            '_method' => 'PATCH',
            'button' => 'Edit Category',
    ];
    ?>

    @include('admin.categories.form')

@endsection
