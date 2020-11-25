@extends('layouts.header')

@section('title')
Edit area
@endsection

@section('content')
<h2 class="page-title">Edit area</h2>
<div class="create-item">
    <form method="POST" action="{{route('area.update', $area)}}" enctype="multipart/form-data">
        {{method_field('PUT')}}
        <div class="input">
            <label>Title</label>
            <input type="text" name="title" value="{{old('title', $area->title)}}">
        </div>
        <div class="input">
            <label>Photo</label>
            <input class="file" type="file" name="photo">
        </div>
        @csrf
        <button class="button" type="submit">EDIT</button>
    </form>
</div>
@endsection
