<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ $form['_method'] or $form['method'] }}">

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="name">Name</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="name" value="{!! old('name') ?: ($permission->name ?? '') !!}" type="text" class="form-control" placeholder="Permission Name">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="display_name">Display Name</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="display_name" value="{!! old('display_name') ?: ($permission->display_name ?? '') !!}" type="text" class="form-control" placeholder="Permission Display Name">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="description">Description</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <textarea name="description" type="text" class="form-control" placeholder="Permission Description">{!! old('description') ?: ($permission->description ?? '') !!}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="role_ids">Roles</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            @forelse($roles as $role)
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="{{ $role->id }}" name="role_ids[]">
                    {{ $role->display_name }}
                </label>
            </div>
            @empty
            <div class="checkbox">
                <label class="text-danger">No Rule</label>
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
