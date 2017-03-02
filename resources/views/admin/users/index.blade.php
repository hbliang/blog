@extends('admin.layouts.default')

@section('title', 'Users')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-xs-8">
                <h1>Users</h1>
            </div>
            <div class="col-xs-4">
                <h1 class="pull-right">
                    @can('create', App\User::class)
                    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-plus"></i> New User</a>
                    @endcan
                </h1>
            </div>
        </div>
    </div>

    <table class="table table-condensed table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>email</th>
            <th>created</th>
            <th>action</th>
        <tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>
                    {{ $user->name }}
                </td>
                <td>
                    {{ $user->descirption ?? '/' }}
                </td>
                <td>{{ $user->created_at }}</td>
                <td>
                    @can('update', $user)
                    <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit User"><i class="glyphicon glyphicon-pencil"></i></a>
                    @endcan()
                    @can('delete', App\User::class)
                    @include('admin.partials.deleteButton', ['url' => route('admin.users.destroy', ['user' => $user->id])])
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $users->links() !!}
@endsection