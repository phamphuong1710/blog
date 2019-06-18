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
