@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {!! Form::open(['method' => 'POST', 'url' => '/categories']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', '',['class' => 'form-control']) !!}
            </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="form-group">
                {!! Form::label('slug', 'Slug') !!}
                {!! Form::text('slug', '',['class' => 'form-control']) !!}
            </div>
            @error('slug')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection

