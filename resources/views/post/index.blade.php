@extends('layouts.header')

@section('title')
Posts list
@endsection

@section('content')

@section('content')
<div class="index-container">
  <h2 class="page-title">Posts List</h2>
  <div class="sort">
    <form action="{{route('post.index')}}" method="get">
      <div class="filter">
        <label>Choose job area:</label>
        <select name="area_id">
          <option value="0">Show All</option>
          @foreach ($areas as $area)
            <option value="{{$area->id}}" @if($area_id == $area->id) selected @endif>{{$area->title}}</option>
          @endforeach
        </select>
      </div>
      <div class="search">
        <label>Search:</label>
        <input type="text" name="search" value = "@if($search) {{$search}} @endif" placeholder="Enter search term">
      </div>
        <div class="submit">
        <button class="button" type="submit">FILTER</button>
      </div>
    </form>
    <div class="reset">
      <a class="button" href="{{route('post.index')}}">Reset</a>
    </div>
  </div>
  <ul class="items-list">
      @foreach ($posts as $post)
      <li class="row">
        <div class="user-info">
            <a class="title" href="{{route('post.edit', $post)}}">{{$post->title}} 
                <span>Salary: {{$post->salary}} Eur<span>
                <span>Area: {{$post->postAreaName}}<span>
            </a>
            @if($post->photo) 
                <img class="photo" src="{{asset('images/' . $post->photo)}}" alt="photo">
            @else
                <img class="photo" src="{{asset('images/no-image.png')}}" alt="no-photo">
            @endif
        </div>
        <div class="buttons">
            <div class="show">
                <a class="button" href="{{route('post.show', $post)}}">Show</a>
            </div>
            <form method="POST" action="{{route('post.destroy', $post)}}">
                {{method_field('DELETE')}}
                <button class="button" type="submit">DELETE</button>
                @csrf
            </form>
        </div>
      </li>
      @endforeach
  </ul>
</div>
<div class="pagination">{{$posts->links()}}</div>
@endsection