@extends('admin.layouts.default')

@section('title', 'User Create')

@section('content')

    <div class="page-header">
        <h1>Edit User</h1>
    </div>

    <?php
    $form = [
        'url' => URL::route('admin.users.update', $user->id),
        'method' => 'POST',
        '_method' => 'PATCH',
        'button' => 'Edit User',
    ];
    ?>

    @include('admin.users.form')

@endsection
