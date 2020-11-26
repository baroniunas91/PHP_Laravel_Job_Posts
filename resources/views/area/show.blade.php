<style>
    body,
    body * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    * {
        text-align: center;
    }
    .container {
        display: block;
        width: 100%;
    }
    h1 {
        margin: 40px 0;
    }
    .book-section {
        display: inline-block;
        /* background-color: #eee; */
        color: black;
        margin-bottom: 20px;
        padding: 20px;
        width: 90%;
        border-radius: 20px;
        border-bottom: 1px solid #eee;
    }
    .book-section p {
        text-align: left;
        font-size: 20px;
    }
    .book-section p span {
        font-weight: bold;
    }
    .download {
        background-color: black;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        text-transform: uppercase;
        font-size: 14px;
        box-shadow: 5px 5px 10px #888888;
        text-decoration: none;
        margin-bottom: 40px;
    }
    .download-section {
        margin-bottom: 40px;
    }
}
</style>

<h1>{{__('area_show.main_title')}} {{$area->title}}</h1>
<div class="container">
@foreach ($area->postsList as $post)
    <div class="book-section">
        <p><span>{{__('area_show.post_title')}}</span> {{$post->title}}</p>
        <p><span>{{__('area_show.post_description')}}</span> {!!$post->description!!}</p>
        <p><span>{{__('area_show.post_salary')}}</span> {{$post->salary}}</p>
        <p><span>{{__('area_show.area_id')}}</span> {{$post->area_id}}</p>
    </div>
@endforeach
</div>
<div class="download-section">
    <a class="download" href="{{route('area.pdf', compact('area', 'lang'))}}">{{__('area_show.download')}}</a>
</div>
<div class="download-section">
    <a class="download" href="{{route('area.index', $lang)}}">{{__('area_show.back')}}</a>
</div>