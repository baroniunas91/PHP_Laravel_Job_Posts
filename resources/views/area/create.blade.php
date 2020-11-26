@extends('layouts.header')

@section('title')
{{__('area_create.main_title')}}
@endsection

@section('content')
<h2 class="page-title">{{__('area_create.main_title')}}</h2>
<div class="create-item">
    <form method="POST" action="{{route('area.store', $lang)}}" enctype="multipart/form-data">
        <div class="input">
            <label>{{__('area_create.input_title')}}</label>
            <input type="text" name="title" placeholder="{{__('area_create.input_title_placeholder')}}" value="{{old('title')}}">
        </div>
        <div class="input">
            <label>{{__('area_create.photo_title')}}</label>
            <input class="file" type="file" name="photo">
        </div>
        @csrf
        <button class= "button" type="submit">{{__('area_create.button_title')}}</button>
    </form>
</div>
@endsection