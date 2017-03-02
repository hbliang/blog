@extends('admin.layouts.default')

@section('title', 'Role Create')

@section('content')

<div class="page-header">
    <h1>Create Role</h1>
</div>

<?php
$form = [
    'url' => URL::route('admin.roles.store'),
    'method' => 'POST',
    'button' => 'Create New Role',
];
?>

@include('admin.roles.form')

@endsection
