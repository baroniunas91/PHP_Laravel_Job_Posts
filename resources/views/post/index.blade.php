@extends('layouts.header')

@section('title')
{{__('post_index.main_title')}}
@endsection

@section('content')

@section('content')
<div class="index-container">
  <h2 class="page-title">{{__('post_index.main_title')}}</h2>
  <div class="sort">
    <form action="{{route('post.index', $lang)}}" method="get">
      <div class="filter">
        <label>{{__('post_index.filter')}}</label>
        <select name="area_id">
          <option value="0">{{__('post_index.show_all')}}</option>
          @foreach ($areas as $area)
            <option value="{{$area->id}}" @if($area_id == $area->id) selected @endif>{{$area->title}}</option>
          @endforeach
        </select>
      </div>
      <div class="search">
        <label>{{__('post_index.search')}}</label>
        <input type="text" name="search" value = "@if($search){{$search}}@endif" placeholder="{{__('post_index.keyword')}}">
      </div>
        <div class="submit">
        <button class="button" type="submit">{{__('post_index.filter_button')}}</button>
      </div>
    </form>
    <div class="reset">
      <a class="button" href="{{route('post.index', $lang)}}">{{__('post_index.reset_button')}}</a>
    </div>
  </div>
  <ul class="items-list">
      @foreach ($posts as $post)
      <li class="row">
        <div class="user-info">
            <a class="title" href="{{route('post.show', compact('post', 'lang'))}}">{{$post->title}} 
                <span>{{__('post_index.salary')}} {{$post->salary}} Eur<span>
                <span>{{__('post_index.area')}} {{$post->postAreaName}}<span>
            </a>
            @if($post->photo) 
                <img class="photo" src="{{asset('images/' . $post->photo)}}" alt="photo">
            @else
                <img class="photo" src="{{asset('images/no-image.png')}}" alt="no-photo">
            @endif
        </div>
        <div class="buttons">
            <div class="edit">
                <a class="button" href="{{route('post.edit', compact('post', 'lang'))}}">{{__('post_index.edit_button')}}</a>
            </div>
            <form method="POST" action="{{route('post.destroy', compact('post', 'lang'))}}">
                {{method_field('DELETE')}}
                <button class="button" type="submit">{{__('post_index.delete_button')}}</button>
                @csrf
            </form>
        </div>
      </li>
      @endforeach
  </ul>
</div>
<div class="pagination">{{$posts->links()}}</div>
@endsection