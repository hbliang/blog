<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Laravel</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route('admin.posts.index') }}">Post</a>
                </li>
                <li>
                    <a href="{{ route('admin.comments.index') }}">Comments</a>
                </li>
                @can('manage', App\Role::class)
                <li><a href="{{ route('admin.roles.index') }}">Role</a></li>
                @endcan
                @can('manage', App\Permission::class)
                <li><a href="{{ route('admin.permissions.index') }}">Permission</a></li>
                @endcan
                @can('view', App\User::class)
                <li>
                    <a href="{{ route('admin.users.index') }}">User</a>
                </li>
                @endcan
                @can('manage', App\Category::class)
                <li>
                    <a href="{{ route('admin.categories.index') }}">Category</a>
                </li>
                @endcan
                @can('manage', App\Tag::class)
                <li>
                    <a href="{{ route('admin.tags.index') }}">Tag</a>
                </li>
                @endcan
            </ul>
            <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
                <li>
                    <a href="#"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }}</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @else
                <li>
                    <a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
                </li>
            @endif
            </ul>
        </div>
    </div>
</nav>
