<div class="navbar-content">
    <div class="left">
        <div class="create">
            <a class ="menu-option" href="{{route('area.create')}}">Create new job area</a>
            <a class ="menu-option" href="{{route('post.create')}}">Create new post</a>
        </div>
        <div class="list">
            <a class ="menu-option" href="{{route('area.index')}}">Job areas list</a>
            <a class ="menu-option" href="{{route('post.index')}}">Posts list</a>
        </div>
    </div>
    <div class="right">
        <h2 class="user">{{Auth::user()->name}}</h2>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="button" type="submit">Logout</button>
        </form>
    </div>
</div>