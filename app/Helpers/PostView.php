<?php

use App\Post;

if ( ! function_exists( 'countView' ) ) {
    function countView($post)
    {
        $minutes = 5;
        $cookieKey = 'post-'.$post->id;
        $cookie = Cookie::get( $cookieKey );

        if ( !$cookieKey ) {
            $response = new Response('View');
            $response->withCookie(cookie($cookieKey, 1, $minutes));
        }
        else {
            $post->increment('views');
            Cookie::queue($cookieKey, $post->views, $minutes);
        }

        return $post;
    }
}


