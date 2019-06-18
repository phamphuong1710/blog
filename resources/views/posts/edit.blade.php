@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Post') }}</div>

                <div class="card-body">

                    {!! Form::model($post,['method' => 'PUT', 'route' => ['posts.update', $post->id ], 'files'=>'true']) !!}

                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title',null,['class' => 'form-control']) !!}
                    </div>
                    @error('title')
                        <span class="feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group">
                        {!! Form::label('sapo', 'Sapo') !!}
                        {!! Form::text('sapo', $post->sapo,['class' => 'form-control']) !!}
                    </div>
                    @error('sapo')
                        <span class="feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group">
                        {!! Form::label('content', 'Content') !!}
                        {!! Form::textarea('content', $post->content,['class' => 'form-control editor1','id' => "editor1"]) !!}
                    </div>
                    @error('content')
                        <span class="feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    {!!  Form::select('category_id', $categories, '', ['class' => 'form-control']) !!}

                    @error('image')
                        <span class="feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="thumbnail">
                        <img src="{{ url('/').'/'.$post->image }} " alt="post-thumbnail" class="img-fluid" id="preview">
                        {!! Form::file("image",["class"=>"form-control","style"=>"display:none", "id"=> "image", "data-image" => $post->image ]) !!}
                        <a href="javascript:changeProfile();">Change</a>
                    </div>

                    {!! Form::hidden('user_id', Auth::id()) !!}
                    {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

