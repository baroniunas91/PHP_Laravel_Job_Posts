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

<h1>Area: {{$area->title}}</h1>
<div class="container">
@foreach ($area->postsList as $post)
    <div class="book-section">
        <p><span>Post title:</span> {{$post->title}}</p>
        <p><span>Post description:</span> {!!$post->description!!}</p>
        <p><span>Salary:</span> {{$post->salary}}</p>
        <p><span>Area ID:</span> {{$post->area_id}}</p>
    </div>
@endforeach
</div>