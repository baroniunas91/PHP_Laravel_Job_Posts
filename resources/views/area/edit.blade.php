@extends('layouts.header')

@section('title')
{{__('area_edit.main_title')}}
@endsection

@section('content')
<h2 class="page-title">{{__('area_edit.main_title')}}</h2>
<div class="create-item">
    <form method="POST" action="{{route('area.update', compact('area', 'lang'))}}" enctype="multipart/form-data">
        {{method_field('PUT')}}
        <div class="input">
            <label>{{__('area_edit.input_title')}}</label>
            <input type="text" name="title" value="{{old('title', $area->title)}}" placeholder="{{__('area_edit.input_title_placeholder')}}">
        </div>
        <div class="input">
            <label>{{__('area_edit.photo_title')}}</label>
            <input class="file" type="file" name="photo">
        </div>
        @csrf
        <button class="button" type="submit">{{__('area_edit.button_title')}}</button>
    </form>
</div>
@endsection
