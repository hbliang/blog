@extends('admin.layouts.default')

@section('title', 'Permission Index')

@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1>Permissions</h1>
        </div>
        <div class="col-xs-4">
            <h1 class="pull-right">
                <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-plus"></i> New Permission</a>
            </h1>
        </div>
    </div>
</div>


<table class="table table-condensed table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Display Name</th>
            <th>Descirption</th>
            <th>Action</th>
        <tr>
    </thead>
    <tbody>
        @foreach($permissions as $permission)
        <tr>
            <td>
                {{ $permission->name }}
            </td>
            <td>
                {{ $permission->display_name }}
            </td>
            <td>
                {{ $permission->descirption ?? '/' }}
            </td>
            <td>
                <a href="{{ route('admin.permissions.edit', ['permission' => $permission->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit Permission"><span class="glyphicon glyphicon-pencil"></span></a>
                @include('admin.partials.deleteButton', ['url' => route('admin.permissions.destroy', ['permission' => $permission->id])])
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
