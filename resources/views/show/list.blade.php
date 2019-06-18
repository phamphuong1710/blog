@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" id="post-data">

       @foreach( $posts as $post )
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <a href="/show/{{ $post->id }}">
                        <img class="card-img-top" src="{{ url('/').'/'.$post->image }}" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <h3 class="card-title">{{ $post->title }}</h3>
                        <p class="card-text">{{ $post->sapo }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="/show/{{ $post->id }}" class="btn btn-sm btn-outline-secondary">Read More</a>

                            </div>
                            <small class="text-muted">{{ ($post->created_at)->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

<div class="ajax-load text-center" style="display:none">
<p>Loading...</p>
</div>


</div>
@endsection


<script>
var page = 1;
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            loadMoreData(page);
        }
    });
function loadMoreData(page){
    $.ajax(
    {
        url: '?page=' + page,
        type: "get",
        beforeSend: function()
        {
            $('.ajax-load').show();
        }
    })
    .done(function(data)
    {

        if(data.length == 0){

            $('.ajax-load').html("No more records!");
            return;
        }
        $('.ajax-load').hide();
        $("#post-data").append(data);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            $('.ajax-load').hide();
        alert('server not responding...');

        });
}

</script>









