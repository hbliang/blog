@extends('admin.layouts.default')

@section('title', 'Edit Tag')

@section('content')

    <div class="page-header">
        <h1>Edit Tag</h1>
    </div>

    <?php
    $form = [
            'url' => URL::route('admin.tags.update', $tag->id),
            'method' => 'POST',
            '_method' => 'PATCH',
            'button' => 'Edit Tag',
    ];
    ?>

    @include('admin.tags.form')

@endsection
