@unless ($categories->isEmpty())
    <ul class="category-tree">
        @foreach ($categories as $category)
            <li>
                <a data-toggle="tooltip" title="{{ $category->description }}">
                    {{ $category->name }}
                </a>

                <span class="actions">
                    <a href="{{ route('admin.tags.edit', [ $category->getKey() ]) }}" data-toggle="tooltip" title="Edit Category">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>

                    <a href="{{ route('admin.tags.create', [ 'parent_id' => $category->getKey() ]) }}" data-toggle="tooltip" title="Create Child">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>

                    @include('admin.partials.deleteButton', [
                        'class' => 'text-danger',
                        'url' => route('admin.tags.destroy', [ $category->getKey() ])])
                </span>

                @include('admin.categories.partials.tree', [ 'categories' => $category->children ])
            </li>
        @endforeach
    </ul>
@endunless