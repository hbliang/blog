<?php
$currentLoopIndex = $loop->index ?? 1;
?>

<a href="{{ $url }}"
    delete-form-id="delete-form-{{ $currentLoopIndex }}"
    class="{{ $class ?? 'btn btn-sm btn-danger' }} delete" data-toggle="tooltip" title="Delete">
    <i class="glyphicon glyphicon-trash"></i> {{ $text or '' }}
</a>
<form class="delete" id="delete-form-{{ $currentLoopIndex }}" method="POST" action="{{ $url }}" style="display:none;">
    <input type="hidden" name="_method" value="DELETE">
    {{ csrf_field() }}
</form>
