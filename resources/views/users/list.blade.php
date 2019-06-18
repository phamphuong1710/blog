@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="/users/create">Create User</a>
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
                        <a href="/users/{{ $user->id }}/edit">Edit</a>
                        <form action="{{ route('users.update', $user->id) }}" method="post">
                            @method('delete')
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
