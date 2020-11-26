<style>
    @font-face {
      font-family: 'Roboto';
      font-weight: bold;
      font-style: normal;
      src: url({{asset('fonts/Roboto-Bold.ttf')}});
    }
    @font-face {
      font-family: 'Roboto';
      font-weight: normal;
      font-style: normal;
      src: url({{asset('fonts/Roboto-Regular.ttf')}});
    }
    body,
        body * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    * {
        font-family: 'Roboto';
        text-align: center;
    }
    .container {
        display: block;
        width: 100%;
    }
    h1 {
        margin-top: 40px;
    }
    .book-section {
        display: block;
        /* background-color: #eee; */
        color: black;
        margin-bottom: 20px;
        padding: 20px;
        width: 100%;
        border-radius: 20px;
        border-bottom: 1px solid #eee;
    }
    .book-section p {
        text-align: left;
        font-size: 16px;
    }
    .book-section p span {
        font-weight: bold;
    }
</style>

<h1>{{__('post_show.main_title')}} {{$post->title}}</h1>
<div class="container">
    <div class="book-section">
        <p><span>{{__('post_show.post_title')}}</span> {{$post->title}}</p>
        <p><span>{{__('post_show.post_description')}}</span> {!!$post->description!!}</p>
        <p><span>{{__('post_show.salary')}}</span> {{$post->salary}} Eur</p>
        <p><span>{{__('post_show.area')}}</span> {{$post->postAreaTitle}}</p>
    </div>
</div>