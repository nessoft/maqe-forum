<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DateTime;
use DateTimeZone;

class FeedController extends Controller
{
    public function __construct(){
        $this->client = new Client();
        $this->timezone = date_default_timezone_get();
    }

    function getAuthors(){
        $res = $this->client->request('GET', 'http://maqe.github.io/json/authors.json');
        $output = array();
        foreach(json_decode($res->getBody()) as $author){
            $output[$author->id] = $author;
        }
        return $output;
    }

    function convertDateToLocale($utcTime){
        $timestamp = new DateTime($utcTime, new DateTimeZone('UTC'));
        $timestamp->setTimezone(new DateTimeZone($this->timezone));
        return $timestamp->format('l, F j, Y, H:i');
    }

    function getPosts(){
        $res = $this->client->request('GET', 'http://maqe.github.io/json/posts.json');
        return json_decode($res->getBody());
    }

    function renderPosts(){
        $authors = $this->getAuthors();
        $posts = $this->getPosts();
        $results = array();
        foreach($posts as $post){
            $post->author = $authors[$post->author_id];
            $post->postDate = $this->convertDateToLocale($post->created_at);
            $results[] = $post;
        }
        return $results;
    }

    function showFeed(){
        return view('feed', [
            'timezone'=>$this->timezone,
            'posts'=>$this->renderPosts()
        ]);
    }
}
