@extends('layouts.header')

@section('title')
Create new area
@endsection

@section('content')
<h2 class="page-title">Create new area</h2>
<div class="create-item">
    <form method="POST" action="{{route('area.store')}}" enctype="multipart/form-data">
        <div class="input">
            <label>Title</label>
            <input type="text" name="title" placeholder="Enter area title" value="{{old('title')}}">
        </div>
        <div class="input">
            <label>Photo</label>
            <input class="file" type="file" name="photo">
        </div>
        @csrf
        <button class= "button" type="submit">ADD</button>
    </form>
</div>
@endsection