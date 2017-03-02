@extends('admin.layouts.default')

@section('title', 'Tags Index')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-xs-8">
                <h1>Tags</h1>
            </div>
            <div class="col-xs-4">
                <h1 class="pull-right">
                    <a href="{{ route('admin.tags.create') }}" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-plus"></i> New Tag</a>
                </h1>
            </div>
        </div>
    </div>

    <table class="table table-condensed table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Descirption</th>
            <th>Action</th>
        <tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>
                    {{ $tag->name }}
                </td>
                <td>
                    {{ $tag->descirption ?? '/' }}
                </td>
                <td>
                    <a href="{{ route('admin.tags.edit', ['tag' => $tag->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit Tag"><i class="glyphicon glyphicon-pencil"></i></a>
                    @include('admin.partials.deleteButton', ['url' => route('admin.tags.destroy', ['tag' => $tag->id])])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
