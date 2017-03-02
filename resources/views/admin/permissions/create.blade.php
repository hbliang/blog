@extends('admin.layouts.default')

@section('title', 'Create Permissions')

@section('content')

<div class="page-header">
    <h1>Create Permission</h1>
</div>

<?php
$form = [
    'url' => URL::route('admin.permissions.store'),
    'method' => 'POST',
    'button' => 'Create New Permission',
];
?>

@include('admin.permissions.form')

@endsection
