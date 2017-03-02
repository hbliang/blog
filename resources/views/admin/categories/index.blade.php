@extends('admin.layouts.default')

@section('title', 'Categories Index')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-xs-8">
                <h1>Categories</h1>
            </div>
            <div class="col-xs-4">
                <h1 class="pull-right">
                    <a href="{{ route('admin.tags.create') }}" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-plus"></i> New Categorie</a>
                </h1>
            </div>
        </div>
    </div>

    @include('admin.categories.partials.tree')
@endsection

@section('js')
<script src="{{ asset('js/bootstrap-treeview.js') }}"></script>
@endsection
