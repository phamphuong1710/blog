@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="post-content ">
            <h1>{{ $post->title }}</h1>
            <p>In: {{ $post->category_id }}</p>


            <img src="{{ url('/').'/'.$post->image }}" alt="{{ $post->title }}" class="img-fluid">

            <div class="content">
               {!! $post->content !!}
            </div>
        </div>

        @if ( Auth::id() !== null )

        <div id="comment">


        <div id="rating" class="post-rating">
            <h2>Rating</h2>
            <div class='rating-stars'>
            @if ( $post->rating )
                    <ul id='stars' class="rating">
                        @for( $i=1; $i<6 ; $i++ )
                            @if($i <= (int)$post->rating)
                             <li class="item-star selected">
                                <span class="fa fa-star"></span>
                              </li>
                            @endif
                            @if($i > (int)$post->rating)
                             <li class="item-star">
                                <span class="fa fa-star"></span>
                              </li>
                            @endif
                          @endfor
                    </ul>
            @endif
            @if ( ! $post->rating )
                {!! Form::open([ 'method' => 'POST', 'url' => 'rating', 'id'=> 'form-rating' ]) !!}
                    <ul id='stars' class="rating">
                        @for( $i=1; $i<6 ; $i++ )
                         <li class="item-star">
                            {!! Form::radio( 'number', $i ) !!}
                            <span class="fa fa-star"></span>
                          </li>
                          @endfor
                    </ul>
                    {!! Form::hidden( 'post_id', $post->id ) !!}
                {!! Form::close() !!}
            @endif

            </div>
        </div>
        <h2 class="comment-title">Comment</h2>
            <div id="form-comment">
                <div class="form-comment-wrapper">
                    {!! Form::open([ 'method' => 'POST', 'url' => 'comment', 'class'=> 'form-comment' ]) !!}
                    <div class="form-group">
                        {!! Form::textarea( 'content','',[ 'placeholder' => 'Comment', 'class' => 'comment' ] ) !!}
                    </div>
                    {!! Form::hidden( 'user_id', Auth::id() ) !!}
                    {!! Form::hidden( 'post_id', $post->id ) !!}
                    {!! Form::hidden( 'parent_id', 0, [ 'class' => 'parent-id' ] ) !!}
                    {!! Form::submit( 'Comment', [ 'class' => 'btn-comment' ] ) !!}
                    {!! Form::close() !!}
                </div>
            </div>
                <div class="comment-list col-md-12">
                   {!! listComment($post->id) !!}
                </div>

        </div>

        @endif



    </div>

</div>
@endsection


