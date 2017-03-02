<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ $form['_method'] or $form['method'] }}">

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="name">Name</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <input name="name" value="{{ old('name') ?: ($category->name ?? '') }}" type="text" class="form-control" placeholder="Category Name">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="description">Description</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <textarea name="description" class="form-control" placeholder="Category Description">{{ old('description') ?: ($category->description ?? '') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="parent">Parent Category</label>
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
            <?php
                $parent_id = app('request')->input('parent_id') ?: ($category->parent_id ?? 0);
            ?>
            <select class="form-control" name="parent_id">
                <option value="">None</option>
                @foreach($categories as $row)
                    <option value="{{ $row->id }}" {{ $row->id == $parent_id ? 'selected' : ''}}>{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> {!! $form['button'] !!}</button>
        </div>
    </div>

</form>
