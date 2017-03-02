@extends('admin.layouts.default')

@section('title', 'Role Edit')

@section('content')

<div class="page-header">
    <h1>Edit Role</h1>
</div>

<?php
$form = [
    'url' => URL::route('admin.roles.update', ['role' => $role->id]),
    'method' => 'POST',
    '_method' => 'PATCH',
    'button' => 'Edit New Role',
];
?>

@include('admin.roles.form')

@endsection
