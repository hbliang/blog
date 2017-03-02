<!-- Search Well -->
<div class="well">
    <h4>Search</h4>
    <div class="input-group">
        <input type="text" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
    </div>
    <!-- /.input-group -->
</div>



<!-- Categories Well -->
<div class="well">
    <h4><a style="color: #000;" href="{{ route('categories.index') }}">Categories</a></h4>
    <div class="row">
        @foreach($categories as $category)
        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6" style="margin: 5px 0;">
            <a style="text-decoration: none;" href="{{ route('categories.show', $category->getKey()) }}">
                <label style="cursor: pointer;" class="label label-primary">{{ $category->name }}</label>
            </a>
        </div>
        @endforeach
    </div>
    <!-- /.row -->
</div>

<!-- Categories Well -->
<div class="well">
    <h4><a style="color: #000;" href="{{ route('tags.index') }}">Tags</a></h4>
    <div class="row">
        @foreach($tags as $tag)
            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6" style="margin: 5px 0;">
                <a style="text-decoration: none;" href="{{ route('tags.show', $tag->getKey()) }}">
                    <label style="cursor: pointer;" class="label label-info">{{ $tag->name }}</label>
                </a>
            </div>
        @endforeach
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<div class="well">
    <h4>Side Widget Well</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus
        laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
</div>
