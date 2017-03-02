@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/styles/default.min.css">
@endsection

@section('content')

@include('partials.notifications')
<!-- Blog Post -->

<!-- Title -->
<h1>{{ $post->title }} <small>by <a href="#">{{ $post->user->name }}</a></small></h1>

<!-- Author -->
<p class="lead">

</p>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span> {{ $post->created_at }} <span class="glyphicon glyphicon-eye-open"></span> {{ $post->views }}</p>
<hr>


<!-- Post Content -->
<div>
    {!! $post->content !!}
</div>
<hr>

<!-- Blog Comments -->

<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>
    <form role="form" action="{{ route('comments.store') }}" method="POST" >
        {{ csrf_field() }}
        <input type="hidden" value="{{ $post->getKey() }}" name="post_id">

        <div class="form-group">
            <textarea name="content_original" oninput="this.editor.update();" class="form-control" rows="3" id="commentInput" placeholder="Please type markdown here">{{ old('content_original') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <div style="margin-top: 10px;" id="previewComment"></div>
</div>

<hr>

<!-- Posted Comments -->

<!-- Comment -->
@forelse($comments as $comment)
<div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">{{ $comment->user->name ?? 'Anonymous' }}
            <small>#{{ $loop->index + 1 }}</small>
            ·
            <small>{{ $comment->created_at }}</small>
        </h4>
        <div>
            {!! $comment->content !!}
        </div>
    </div>
</div>
@empty
    <h2>Leave the first comment~</h2>
@endforelse

<!-- Comment -->
{{--<div class="media">--}}
    {{--<a class="pull-left" href="#">--}}
        {{--<img class="media-object" src="http://placehold.it/64x64" alt="">--}}
    {{--</a>--}}
    {{--<div class="media-body">--}}
        {{--<h4 class="media-heading">Start Bootstrap--}}
            {{--<small>August 25, 2014 at 9:30 PM</small>--}}
        {{--</h4>--}}
        {{--Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}
        {{--<!-- Nested Comment -->--}}
        {{--<div class="media">--}}
            {{--<a class="pull-left" href="#">--}}
                {{--<img class="media-object" src="http://placehold.it/64x64" alt="">--}}
            {{--</a>--}}
            {{--<div class="media-body">--}}
                {{--<h4 class="media-heading">Nested Start Bootstrap--}}
                    {{--<small>August 25, 2014 at 9:30 PM</small>--}}
                {{--</h4>--}}
                {{--Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<!-- End Nested Comment -->--}}
    {{--</div>--}}
{{--</div>--}}

@endsection

@section('js')
<script src="{{ asset('js/showdown.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/highlight.min.js"></script>
<script>
    $(function() {
        hljs.initHighlightingOnLoad({

        });

        function Editor(input, preview) {
            this.update = function() {
                var converter = new showdown.Converter();
                preview.innerHTML = converter.makeHtml(input.value);
            };

            input.editor = this;
            this.update();
        }

        new Editor(document.getElementById('commentInput'), document.getElementById('previewComment'));
    });
</script>
@endsection