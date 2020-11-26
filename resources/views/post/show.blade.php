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
    body {
        background: url('https://teltonika-iot-group.com/img/career/telematics-net-developer-mid-senior.2b6576fb12f803bafd68becb169198de7946705e1c0a436621e393163bc08e9d.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }
    .container {
        display: block;
        width: 100%;
    }
    h1 {
        padding: 40px 0;
        color: white
    }
    .book-section {
        display: inline-block;
        background-color: white;
        color: black;
        padding: 20px;
        width: 90%;
        border-radius: 10px;
    }
    .book-section p {
        text-align: left;
        font-size: 20px;
    }
    .book-section p span {
        font-weight: bold;
    }
    .download {
        background-color: white;
        color: black;
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 5px;
        text-transform: uppercase;
        font-size: 14px;
        box-shadow: 5px 5px 10px black;
        text-decoration: none;
        margin-bottom: 40px;
    }
    .download:hover {
        transition: 0.5s;
        background-color: black;
        color: white;
    }
    .download-section {
        padding: 20px 0 10px;
    }
    .bottom {
        height: 300px;
    }
    .background {
        background: rgb(0,84,166);
        background: linear-gradient(180deg, rgba(0,84,166,0.7952364803699965) 0%, rgba(130,130,231,0.5424274916059515) 100%);
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: -1;
    }
}
</style>
<div class="background"></div>
<h1>{{$post->title}}</h1>
<div class="container">
    <div class="book-section">
        <p><span>{{__('post_show.post_title')}}</span> {{$post->title}}</p>
        <p><span>{{__('post_show.post_description')}}</span> {!!$post->description!!}</p>
        <p><span>{{__('post_show.salary')}}</span> {{$post->salary}} Eur</p>
        <p><span>{{__('post_show.area')}}</span> {{$post->postAreaTitle}}</p>
    </div>
</div>
<div class="bottom">
    <div class="download-section">
        <a class="download" href="{{route('post.pdf', compact('post', 'lang'))}}">{{__('post_show.download')}}</a>
    </div>
    <div class="download-section">
        <a class="download" href="{{route('post.index', $lang)}}">{{__('post_show.back')}}</a>
    </div>
</div>