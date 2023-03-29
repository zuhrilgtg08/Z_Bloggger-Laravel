@extends('layouts.frontend.main')

@section('container')
    <div class="row justify-content-center">
        <div class="col-md-6 mb-2">
            <h2 class="fw-normal mb-3 text-center">Search Post For Your Like!</h2>
            <form action="/" method="GET">
                @csrf

                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif

                <div class="input-group mb-3 rounded">
                    <input type="text" class="form-control" name="keyword" placeholder="Search Post.." id="keyword">
                    <button class="btn btn-outline-danger" type="submit" id="search-btn">
                        <i class="fa-solid fa-search"></i> Search
                    </button>
                </div>
            </form>
            <h6 class="fw-normal mb-3 text-end">Total Data : <span class="total-data">0</span></h6>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center data-row">
            @if ($data->count())
                <div class="col-md-9 mb-5">
                    <div class="card h-100 shadow">
                        @if ($data[0]->image)
                            <img src="{{ asset('storage/' . $data[0]->image) }}" alt="default-post" class="img-fluid card-img-top" />
                        @else
                            <img src="{{ asset('images/404.png') }}" alt="default-post" class="img-fluid card-img-top" />
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $data[0]->title }}</h5>
                            <p>By.
                                <small class="text-muted">
                                    <a href="/?author={{ $data[0]->author->username }}"
                                        class="text-decoration-none">{{ $data[0]->author->name }}</a> in
                                    <a href="/?category={{ $data[0]->category->slug }}"
                                        class="text-decoration-none">{{ $data[0]->category->name }}</a>
                                    {{ $data[0]->created_at->diffForHumans() }}
                                </small>
                            </p>
                            <p class="card-text">{{ $data[0]->excerpt }}</p>
                            <a href="{{ url('/home/post/detail/' . $data[0]->id) }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>

                @foreach ($data->skip(1) as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow">
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="default-post" class="img-fluid card-img-top" 
                                    style="max-height: 200px; overflow: auto"/>
                            @else
                                <img src="{{ asset('images/404.png') }}" alt="default-post" class="img-fluid card-img-top" />
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p>By.
                                    <small class="text-muted">
                                        <a href="/?author={{ $item->author->username }}"
                                            class="text-decoration-none">{{ $item->author->name }}</a> in
                                        <a href="/?category={{ $item->category->slug }}"
                                            class="text-decoration-none">{{ $item->category->name }}</a>
                                        {{ $item->created_at->diffForHumans() }}
                                    </small>
                                </p>
                                <p class="card-text">{{ $item->excerpt }}</p>
                                <a href="{{ url('/home/post/detail/' . $item->id) }}" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow">
                        <img src="{{ asset('images/404.png') }}" alt="default-post" class="img-fluid card-img-top" />
                        <div class="card-body">
                            <h4 class="card-title text-center fw-bold">Data Post Not Found!</h4>
                        </div>
                    </div>
                </div>
            @endif

            <div class="d-flex justify-content-end">
                {!! $data->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let debounceTimer;

        const debounce = (args, time) => {
            window.clearTimeout(debounceTimer);
            debounceTimer = window.setTimeout(args, time);
        } 

        $('#keyword').on('keyup', function() {
            let keyVal = $(this).val();

            $.ajax({
                type: "GET",
                url: "{{ url('/home') }}",
                data: {'keyword': keyVal},
                dataType:'json',
                success: function (data) {
                    const debounceValue = () => {
                        $('.data-row').html(data.output);
                    }

                    debounce(debounceValue, 500);
                    $('.total-data').text(data.total);
                }
            });
        });

        $.ajaxSetup({ headers: {'csrftoken' : '{{ csrf_token() }}'}});
    </script>
@endsection