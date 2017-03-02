<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ $form['_method'] or $form['method'] }}">

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="name">Name</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="name" value="{{ old('name') ?: ($user->name ?? '') }}" type="text" class="form-control" placeholder="User Name" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="email">Email</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input type="email" name="email" class="form-control" placeholder="User Description" value="{{ old('email') ?: ($user->email ?? '') }}" required>
        </div>
    </div>
    @if(!isset($form['_method']))
    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="password">Password</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input type="password" name="password" class="form-control" placeholder="User Password" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="password-confirm">Password Confirm</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="User Password Confirm" required>
        </div>
    </div>
    @endif

    @can('updateRole', App\User::class)
    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="role">Role</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            @foreach($roles as $role)
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="{{ $role->id }}" name="role_ids[]" {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                    {{ $role->display_name }}
                </label>
            </div>
            @endforeach
        </div>
    </div>
    @endcan

    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> {!! $form['button'] !!}</button>
        </div>
    </div>

</form>
