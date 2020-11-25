@extends('layouts.header')

@section('title')
Areas list
@endsection

@section('content')

@section('content')
<div class="index-container">
    <h2 class="page-title">Areas List</h2>
    <ul class="items-list">
        @foreach ($areas as $area)
        <li class="row">
            <div class="user-info">
                <a class="title" href="{{route('area.edit', $area)}}">{{$area->title}}<span>Posts count: {{$area->postsCount}}</span>
                @foreach($area->postsList as $post)
                <span>Post title: {{$post->title}}</span>
                @endforeach
                </a>
                @if($area->photo) 
                    <img class="photo" src="{{asset('images/' . $area->photo)}}" alt="photo">
                @else
                    <img class="photo" src="{{asset('images/no-image.png')}}" alt="no-photo">
                @endif
            </div>
            <div class="buttons">
                <div class="show">
                    <a class="button" href="{{route('area.show', $area)}}">Show</a>
                </div>
                <form method="POST" action="{{route('area.destroy', $area)}}">
                    <button class="button" type="submit">DELETE</button>
                    @csrf
                </form>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection