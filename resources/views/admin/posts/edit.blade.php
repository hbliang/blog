@extends('admin.layouts.default')

@section('title', 'Edit Post')

@section('content')

<div class="page-header">
    <h1>Update Post</h1>
</div>

<?php
$form = [
    'url' => URL::route('admin.posts.update', $post->id),
    'method' => 'POST',
    '_method' => 'PATCH',
    'button' => 'Edit The Post',
];
?>

@include('admin.posts.form')

@endsection
