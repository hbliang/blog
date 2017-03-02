<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ $form['_method'] or $form['method'] }}">

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="name">Name</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="name" value="{{ old('name') ?: ($tag->name ?? '') }}" type="text" class="form-control" placeholder="Tag Name">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="description">Description</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <textarea name="description" class="form-control" placeholder="Tag Description">{{ old('description') ?: ($tag->description ?? '') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> {!! $form['button'] !!}</button>
        </div>
    </div>

</form>
