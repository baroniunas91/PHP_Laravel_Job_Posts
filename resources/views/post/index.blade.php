@extends('layouts.header')

@section('title')
Posts list
@endsection

@section('content')

@section('content')
<div class="index-container">
  <h2 class="page-title">Posts List</h2>
  {{-- <div class="sort">
    <form action="{{route('post.index')}}" method="get">
      <div class="filter">
        <label>Choose statuse:</label>
        <select name="statuse_id">
          <option value="0">Show All</option>
          @foreach ($statuses as $statuse)
            <option value="{{$statuse->id}}" @if($statuse_id == $statuse->id) selected @endif>{{$statuse->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="sort-content">
        <div class="input-radio">
          <label for="_1">Sort by completed</label>
          <input type="radio" name="sort" value="completed_date" id="_1" @if ('completed_date' == $sort) checked @endif>
        </div>
        <div class="input-radio">
          <label for="_2">Sort by add</label>
          <input type="radio" name="sort" value="add_date" id="_2" @if ('add_date' == $sort) checked @endif>
        </div>
      </div>
      <div class="sort-content">
        <div class="input-radio">
          <label class="dir" for="_3">ASC</label>
          <input type="radio" name="dir" value="asc" id="_3" @if ('asc' == $order) checked @endif>
        </div>
        <div class="input-radio">
          <label class="dir" for="_4">DESC</label>
          <input type="radio" name="dir" value="desc" id="_4" @if ('desc' == $order) checked @endif>
        </div>
      </div>
      <div class="submit">
        <button class="button" type="submit">FILTER</button>
      </div>
    </form>
    <div class="reset">
      <a class="button" href="{{route('post.index')}}">Reset</a>
    </div>
  </div> --}}
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
                <button class="button" type="submit">DELETE</button>
                @csrf
            </form>
        </div>
      </li>
      @endforeach
  </ul>
</div>
@endsection