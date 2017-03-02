<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ $form['_method'] or $form['method'] }}">

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="name">Name</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="name" value="{{ old('name') ?: ($role->name ?? '') }}" type="text" class="form-control" placeholder="Role Name">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="display_name">Display Name</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="display_name" value="{{ old('display_name') ?: ($role->display_name ?? '') }}" type="text" class="form-control" placeholder="Role Display Name">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="description">Description</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <textarea name="description" class="form-control" placeholder="Role Description">{{ old('description') ?: ($role->description ?? '') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="permission_ids">Roles</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            @forelse($permissions as $permission)
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="{{ $permission->id }}" name="permission_ids[]" {{ $role->hasPermission($permission->name) ? 'checked' : '' }}>
                    {{ $permission->display_name }}
                </label>
            </div>
            @empty
            <div class="checkbox">
                <label class="text-danger">No Permission</label>
            </div>
            @endforelse
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> {!! $form['button'] !!}</button>
        </div>
    </div>
    
</form>
