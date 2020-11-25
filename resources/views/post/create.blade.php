@extends('layouts.header')

@section('title')
Create new post
@endsection

@section('content')
<h2 class="page-title">Create new post</h2>
<div class="create-item">
    <form class="create_form" method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
        <div class="input">
            <label>Title</label>
            <input type="text" name="title" value="{{old('title')}}" placeholder="Enter post title">
        </div>
        <div class="input">
            <label>Description</label>
            <div class="textarea" id="editor">{!!old('description')!!}</div>
            <input type="hidden" name="description">
        </div>
        <div class="input">
            <label>Salary</label>
            <input type="text" name="salary" value="{{old('salary')}}" placeholder="Enter salary">
        </div>
        <div class="input">
            <label>Select job area</label>
            <select name="area_id">
                @foreach ($areas as $area)
                    <option value="{{$area->id}}" @if($area->id == old('area_id')) selected @endif>{{$area->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="input">
            <label>Photo</label>
            <input class="file" type="file" name="photo">
        </div>
        @csrf
        <button class= "button" type="submit">ADD</button>
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