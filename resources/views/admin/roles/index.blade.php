@extends('admin.layouts.default')

@section('title', 'Roles Index')

@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1>Roles</h1>
        </div>
        <div class="col-xs-4">
            <h1 class="pull-right">
                <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-plus"></i> New Role</a>
            </h1>
        </div>
    </div>
</div>

<table class="table table-condensed table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Display Name</th>
            <th>Description</th>
            <th>Permissions</th>
            <th>Action</th>
        <tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr>
            <td>
                {{ $role->name }}
            </td>
            <td>
                {{ $role->display_name }}
            </td>
            <td>
                {{ $role->descirption ?? '/' }}
            </td>
            <td>
                @foreach($permissions as $permission)

                    @if($role->hasPermission($permission->name))
                        <div style=" display: inline-block; margin: 5px 0;"><label class="label label-default">{{ $permission->display_name }}</label></div>
                    @endif

                @endforeach
            </td>
            <td width="10%">
                <a href="{{ route('admin.roles.edit', ['role' => $role->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit Role"><i class="glyphicon glyphicon-pencil"></i></a>
                @include('admin.partials.deleteButton', ['url' => route('admin.roles.destroy', ['role' => $role->id])])
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
