@extends('admin.layouts.default')

@section('title', 'Create Post')


@section('content')

<div class="page-header">
    <h1>Create Post</h1>
</div>

<?php
$form = [
    'url' => URL::route('admin.posts.store'),
    'method' => 'POST',
    'button' => 'Create New Post',
];
?>

@include('admin.posts.form')

@endsection
