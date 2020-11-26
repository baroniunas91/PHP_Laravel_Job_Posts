@extends('layouts.header')

@section('title')
{{__('post_edit.main_title')}}
@endsection

@section('content')
<h2 class="page-title">{{__('post_edit.main_title')}}</h2>
<div class="create-item">
    <form class="create_form" method="POST" action="{{route('post.update', compact('post', 'lang'))}}" enctype="multipart/form-data">
        {{method_field('PUT')}}
        <div class="input">
            <label>{{__('post_edit.input_title')}}</label>
            <input type="text" name="title" value="{{old('title', $post->title)}}" placeholder="{{__('post_edit.input_title_placeholder')}}">
        </div>
        <div class="input">
            <label>{{__('post_edit.input_description')}}</label>
            <div class="textarea" id="editor">{!!old('description', $post->description)!!}</div>
            <input type="hidden" name="description">
        </div>
        <div class="input">
            <label>{{__('post_edit.input_salary')}}</label>
            <input type="text" name="salary" value="{{old('salary', $post->salary)}}" placeholder="{{__('post_edit.input_salary_placeholder')}}">
        </div>
        <div class="input">
            <label>{{__('post_edit.select_area')}}</label>
            <select name="area_id">
                @foreach ($areas as $area)
                    <option value="{{$area->id}}" @if($area->id == old('area_id', $post->area_id)) selected @endif>{{$area->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="input">
            <label>{{__('post_edit.photo_title')}}</label>
            <input class="file" type="file" name="photo">
        </div>
        @csrf
        <button class= "button" type="submit">{{__('post_edit.button_title')}}</button>
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