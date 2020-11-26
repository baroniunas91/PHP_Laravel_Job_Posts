@extends('layouts.header')

@section('title')
{{__('area_index.main_title')}}
@endsection

@section('content')

@section('content')
<div class="index-container">
    <h2 class="page-title">{{__('area_index.main_title')}}</h2>
    <ul class="items-list">
        @foreach ($areas as $area)
        <li class="row">
            <div class="user-info">
                <a class="title" href="{{route('area.show', compact('area', 'lang'))}}">{{$area->title}}<span>{{__('area_index.posts_count')}} {{$area->postsCount}}</span>
                @foreach($area->postsList as $post)
                <span>{{__('area_index.posts_title')}} {{$post->title}}</span>
                @endforeach
                </a>
                @if($area->photo) 
                    <img class="photo" src="{{asset('images/' . $area->photo)}}" alt="photo">
                @else
                    <img class="photo" src="{{asset('images/no-image.png')}}" alt="no-photo">
                @endif
            </div>
            <div class="buttons">
                <div class="edit">
                    <a class="button" href="{{route('area.edit', compact('area', 'lang'))}}">{{__('area_index.edit_button')}}</a>
                </div>
                <form method="POST" action="{{route('area.destroy', compact('area', 'lang'))}}">
                    {{method_field('DELETE')}}
                    <button class="button" type="submit">{{__('area_index.delete_button')}}</button>
                    @csrf
                </form>
            </div>
        </li>
        @endforeach
    </ul>
</div>
<div class="pagination">{{$areas->links()}}</div>
@endsection