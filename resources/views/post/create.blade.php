@extends('layouts.header')

@section('title')
{{__('post_create.main_title')}}
@endsection

@section('content')
<h2 class="page-title">{{__('post_create.main_title')}}</h2>
<div class="create-item">
    <form class="create_form" method="POST" action="{{route('post.store', $lang)}}" enctype="multipart/form-data">
        <div class="input">
            <label>{{__('post_create.input_title')}}</label>
            <input type="text" name="title" value="{{old('title')}}" placeholder="{{__('post_create.input_title_placeholder')}}">
        </div>
        <div class="input">
            <label>{{__('post_create.input_description')}}</label>
            <div class="textarea" id="editor">{!!old('description')!!}</div>
            <input type="hidden" name="description">
        </div>
        <div class="input">
            <label>{{__('post_create.input_salary')}}</label>
            <input type="text" name="salary" value="{{old('salary')}}" placeholder="{{__('post_create.input_salary_placeholder')}}">
        </div>
        <div class="input">
            <label>{{__('post_create.select_area')}}</label>
            <select name="area_id">
                @foreach ($areas as $area)
                    <option value="{{$area->id}}" @if($area->id == old('area_id')) selected @endif>{{$area->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="input">
            <label>{{__('post_create.photo_title')}}</label>
            <input class="file" type="file" name="photo">
        </div>
        @csrf
        <button class= "button" type="submit">{{__('post_create.button_title')}}</button>
    </form>
</div>

<script>
    var quill = new Quill('#editor', {
      theme: 'snow'
    });
    document.querySelector('.create_form').addEventListener('submit', e => {
        e.target.querySelector('[name=description]').value =
        e.target.querySelector('#editor .ql-editor').innerHTML
    })
</script>
@endsection