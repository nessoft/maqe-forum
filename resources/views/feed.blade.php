<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('css/app.css')}}">
        <!-- <link rel="stylesheet" href=""> -->
    </head>
    <body>
    <div class="feed">
        <div class="feed-top">
            <span><h1>MAQE Forum</h1></span>
            <span>Your current timezone is: {{$timezone}}</span>
        </div>
        @foreach($posts as $post)
            <div class="post">
                <div class="author">
                    <img src="{{$post->author->avatar_url}}">
                    <span class="author-name">{{$post->author->name}}</span> <span>posted on {{$post->postDate}}</span>
                </div>
                <div class="detail">
                    <div class="image"><img src="{{$post->image_url}}"></div>
                    <div class="content">
                        <span class="post-header">{{$post->title}}</span>
                        <p>{{$post->body}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </body>
</html>
