@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="/posts/create">Create Post</a>

            <table class="table">
                <tr>
                    <td>id</td>
                    <td>title</td>
                    <td>sapo</td>
                    <td>slug</td>
                    <td>action</td>
                </tr>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>

                    <td>{{ $post->title }}</td>
                    <td>{{ $post->sapo }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>
                        <a href="/posts/{{ $post->id }}/edit">Edit</a>
                        <form action="{{ route('posts.update', $post->id) }}" method="post" class="form-delete">
                            @method('delete')
                            {{ csrf_field() }}
                            <input type="submit" value="delete" class="delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            {!! $posts->fragment('foo')->links() !!}
        </div>
    </div>
</div>
@endsection
