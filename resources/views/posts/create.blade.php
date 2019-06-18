@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Post') }}</div>

                <div class="card-body">
                    {!! Form::open(['method' => 'POST', 'url' => '/posts', 'files'=>'true']) !!}

                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title','',['class' => 'form-control']) !!}
                    </div>
                    @error('title')
                        <span class="feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group">
                        {!! Form::label('sapo', 'Sapo') !!}
                        {!! Form::text('sapo', '',['class' => 'form-control']) !!}
                    </div>
                    @error('sapo')
                        <span class="feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group">
                        {!! Form::label('content', 'Content') !!}
                        {!! Form::textarea('content', '',['class' => 'form-control editor1','id' => "editor1"]) !!}
                    </div>
                    @error('content')
                        <span class="feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    {!!  Form::select('category_id', $categories, '', ['class' => 'form-control']) !!}
                    <div class="thumbnail">

                        <div class="image">
                            <img src="{{ url('/').'/images/images.png' }} " alt="post-thumbnail" class="img-fluid" id="preview">
                        </div>
                        {!! Form::file("image",["class"=>"form-control","style"=>"display:none", "id"=> "image" ]) !!}

                        <a href="javascript:changeProfile();">Change</a>
                    </div>
                    @error('content')
                        <span class="feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    {!! Form::hidden('user_id', $user_id) !!}
                    {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

