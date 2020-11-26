<div class="navbar-content">
    <div class="left">
        <div class="create">
            <a class ="menu-option" href="{{route('area.create', $lang)}}">{{__('navbar.create_area')}}</a>
            <a class ="menu-option" href="{{route('post.create', $lang)}}">{{__('navbar.create_post')}}</a>
        </div>
        <div class="list">
            <a class ="menu-option" href="{{route('area.index', $lang)}}">{{__('navbar.areas_list')}}</a>
            <a class ="menu-option" href="{{route('post.index', $lang)}}">{{__('navbar.posts_list')}}</a>
        </div>
    </div>
    <div class="right">
        <div class="language">
        <a class="en" href="{{substr(url()->current(), 0, -2) . 'en'}}">EN</a>
            <a class="lt" href="{{substr(url()->current(), 0, -2) . 'lt'}}">LT</a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="button" type="submit">{{__('navbar.logout')}}</button>
        </form>
    </div>
</div>