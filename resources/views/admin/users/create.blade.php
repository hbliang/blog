@extends('admin.layouts.default')

@section('title', 'User Create')

@section('content')

    <div class="page-header">
        <h1>Create User</h1>
    </div>

    <?php
    $form = [
            'url' => URL::route('admin.users.store'),
            'method' => 'POST',
            'button' => 'Create New User',
    ];
    ?>

    @include('admin.users.form')

@endsection
