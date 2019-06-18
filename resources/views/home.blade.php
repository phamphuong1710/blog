@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <table class="table">
                <tr>
                    <td>id</td>
                    <td>name</td>
                    <td>email</td>
                    <td>action</td>

                </tr>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="home/{{ $user->id }}/edit">Edit</a>
                        <form action="/home/{{ $user->id }}">
                            <input type="hidden" value="delete" name="_method">
                            {{ csrf_field() }}
                            <input type="submit" value="delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
