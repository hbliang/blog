@extends('admin.layouts.default')
@section('css')
    <style>
        div.status a label {
            cursor: pointer;
        }
    </style>
@endsection

@section('title', 'Comments')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-xs-8">
                <h1>Comments</h1>
            </div>
        </div>
    </div>

    @forelse($comments as $comment)
        <div style="margin: 8px;">
            <div @can('block', App\Comment::class)class="status" @endcan style="display: inline-block;">
                <a style="text-decoration: none; {{ $comment->status === 'PUBLISHED' ? '' : 'display: none;' }}" data-url="{{ route('admin.comments.toggleStatus', $comment->getKey()) }}" class="published">
                    <label class="label label-success">PUBLISHED</label>
                </a>
                <a style="text-decoration: none; {{ $comment->status === 'BLOCKED' ? '' : 'display: none;' }}" data-url="{{ route('admin.comments.toggleStatus', $comment->getKey()) }}" class="blocked">
                    <label class="label label-danger">BLOCKED</label>
                </a>
            </div>

            <a href="{{ route('posts.show', $comment->post->getKey()) }}">{{ $comment->post->title }}</a> |
            <small>By <a href="">{{ $comment->user->name ?? 'Anonymous' }}</a></small> |
            {{ $comment->created_at }}

            @can('delete', $comment)
                @include('admin.partials.deleteButton', [
                    'class' => 'pull-right text-danger',
                    'url' => route('admin.comments.destroy', ['comments' => $comment->id]),
                    'text' => 'Delete Comment',
                    ])
            @endcan

        </div>
        <div>
            {!! $comment->content !!}
        </div>
        <hr>
    @empty
        <h1>Sorry, No Comments</h1>
    @endforelse

    @if (count($comments))
        {!! $comments->links() !!}
    @endif

@endsection

@section('js')
<script>
    $(function() {
        var toggleStatus = function($e) {
            this.handle = function() {
                $e.hide();
                $e.siblings().fadeIn('fast');
            };

            this.rollback = function() {
                $e.fadeIn('fast');
                $e.siblings().hide();
            };
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('div.status a').click(function() {
            var _toggleStatus = new toggleStatus($(this));
            _toggleStatus.handle();

            var url = $(this).data('url');

            $.ajax({
                url: url,
                type: 'PUT',
                dataType: 'json',
                success: function(data) {
                    if (data.error) {
                        _toggleStatus.rollback();
                        return false;
                    }
                },
                error: function(xhr, status) {
                    var err = JSON.parse(xhr.responseText);
                    var message = err.message ? err.message : err.error;
                    alert(message);
                    _toggleStatus.rollback();

                }
            });
        });
    });
</script>
@endsection
