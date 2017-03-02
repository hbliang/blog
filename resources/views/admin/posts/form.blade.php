@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/editormd.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/selectize.default.css') }}">
@endsection


<form class="form-horizontal" action="{{ $form['url'] }}" method="{{ $form['method'] }}" enctype="multipart/form-data">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ $form['_method'] or $form['method'] }}">

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="title">Post Title</label>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-10">
            <input name="title" value="{{ old('title') ?: ($post->title ?? '') }}" type="text" class="form-control" placeholder="Post Title">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="content_original">Post Content</label>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-10">
            <div id="editormd">
                <textarea style="display:none;" name="content_original">{{ old('content_original') ?: ($post->content_original ?? '') }}</textarea>
            </div>
            {{--<textarea name="content_original" class="form-control" placeholder="Post Content">{{ old('content_original') ?: ($post->content_original ?? '') }}</textarea>--}}
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="category">Category</label>
        <div class="col-lg-4 col-md-4 col-sm-9 col-xs-10">
            <select class="form-control" name="category_id">
                <option value="">None</option>
                <?php
                    $category_id = old('category_id') ?: ($post->category_id ?? 0)
                ?>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="status">Status</label>
        <div class="col-lg-4 col-md-4 col-sm-9 col-xs-10">
            <select class="form-control" name="status">
                @foreach(\App\Post::getStatuses() as $status)
                    @if($status !== 'BLOCKED' || Auth::user()->can('block-post', \App\Post::class))
                        <option value="{{ $status }}">{{ $status }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="category">Category</label>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-10">
            <select class="tags" name="tags[]" multiple>
                <option value="">None</option>
                @foreach($tags as $tag)
                <option value="{{ $tag->name }}" {{ in_array($tag->name, $postTagNameArray ?? []) ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="image">Image</label>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-10">
            <input type="file" accept="image/*" name="cover">
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-rocket"></i> {{ $form['button'] }}</button>
        </div>
    </div>
    
</form>

@section('js')
    <script src="{{ asset('js/editormd/editormd.js') }}"></script>
    <script src="{{ asset('js/selectize/selectize.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            var editor = editormd({
                id: 'editormd',
                path : "{{ asset('js/editormd/lib') }}/",
                toolbarIcons: 'simple',
                height: 480
            });

            $('select.tags').selectize({
                plugins: ['restore_on_backspace'],
                delimiter: ',',
                persist: false,
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    }
                }
            });

        });
    </script>

@endsection
