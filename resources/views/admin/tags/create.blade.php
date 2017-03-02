@extends('admin.layouts.default')

@section('title', 'Tag Create')

@section('content')

    <div class="page-header">
        <h1>Create Tag</h1>
    </div>

    <?php
    $form = [
            'url' => URL::route('admin.tags.store'),
            'method' => 'POST',
            'button' => 'Create New Tag',
    ];
    ?>

    @include('admin.tags.form')

@endsection
