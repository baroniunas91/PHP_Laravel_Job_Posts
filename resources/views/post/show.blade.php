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

<h1>Post: {{$post->title}}</h1>
<div class="container">
    <div class="book-section">
        <p><span>Post title:</span> {{$post->title}}</p>
        <p><span>Post description:</span> {!!$post->description!!}</p>
        <p><span>Post salary:</span> {{$post->salary}}</p>
        <p><span>Post area:</span> {{$post->postAreaTitle}}</p>
    </div>
</div>
<div class="download-section">
    <a class="download" href="{{route('post.pdf', $post)}}">Download</a>
</div>
<div class="download-section">
    <a class="download" href="{{route('post.index')}}">Back to posts</a>
</div>