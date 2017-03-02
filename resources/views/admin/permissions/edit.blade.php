@extends('admin.layouts.default')

@section('title', 'Edit Permissions')

@section('content')

<div class="page-header">
    <h1>Edit Permission</h1>
</div>

<?php
$form = [
    'url' => URL::route('admin.permissions.update', ['permission' => $permission->id]),
    'method' => 'POST',
    '_method' => 'PATCH',
    'button' => 'Edit Permission',
];
?>

@include('admin.permissions.form')

@endsection
