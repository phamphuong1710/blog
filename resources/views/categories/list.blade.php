@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="/categories/create">Create New Category</a>
            <table class="table">
                <tr>
                    <td>id</td>
                    <td>name</td>
                    <td>slug</td>
                    <td>action</td>

                </tr>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        <a href="/categories/{{ $category->id }}/edit">Edit</a>
                        <form action="{{ route('categories.update', $category->id) }}" method="post" class="form-delete">
                            @method('delete')
                            {{ csrf_field() }}
                            <input type="submit" value="delete" class="delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
