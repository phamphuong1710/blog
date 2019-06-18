@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form  action="{{ route('users.update', $user->id) }}" method="post">
            @method('put')
            @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">name</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="name" value="{{ $user->name }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
