@extends('layouts.frontend.main')
@section('styles')
    <style>
        .scroll {
            max-height: 22rem;
            overflow-y: auto
        }

        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            display: none;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
    </style>
@endsection

@section('container')
    <a href="/" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    <div class="col-lg float-end">
        <button type="button" class="btn btn-dark {{ (auth()->user() == false ) ? 'd-none' : '' }}"><i class="fa-solid fa-heart" style="color: #fc20ba;"></i> Add Favorite</button>
        <button type="button" class="btn btn-success {{ (auth()->user() == false ) ? 'd-none' : '' }}" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-star text-warning"></i> Add Rating
        </button>
    </div>

    <!-- Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Rating This Post!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('rating.comment') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $data->id }}" name="post_id"/ >
                    
                    <div class="modal-body">
                        @if (!$reviews->isEmpty())
                            @foreach ($reviews as $item)
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <div class="rate">
                                            <input type="radio" id="star5" class="rate" name="rating" value="5"
                                                {{ $item->like_value == 5 ? 'checked' : null }} />
                                            <label for="star5">5 stars</label>
                                            <input type="radio" id="star4" class="rate" name="rating" value="4"
                                                {{ $item->like_value == 4 ? 'checked' : null }} />
                                            <label for="star4">4 stars</label>
                                            <input type="radio" id="star3" class="rate" name="rating" value="3"
                                                {{ $item->like_value == 3 ? 'checked' : null }} />
                                            <label for="star3">3 stars</label>
                                            <input type="radio" id="star2" class="rate" name="rating" value="2"
                                                {{ $item->like_value == 2 ? 'checked' : null }} />
                                            <label for="star2">2 stars</label>
                                            <input type="radio" id="star1" class="rate" name="rating" value="1"
                                                {{ $item->like_value == 1 ? 'checked' : null }} />
                                            <label for="star1">1 star</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" name="comment" rows="6" placeholder="Comment" maxlength="200"
                                        required>{{ old('comment', $item->comment) }}</textarea>
                                </div>
                            @endforeach
                        @else
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="rate">
                                        <input type="radio" id="star5" class="rate" name="rating" value="5" />
                                        <label for="star5">5 stars</label>
                                        <input type="radio" id="star4" class="rate" name="rating" value="4" />
                                        <label for="star4">4 stars</label>
                                        <input type="radio" id="star3" class="rate" name="rating" value="3" />
                                        <label for="star3">3 stars</label>
                                        <input type="radio" id="star2" class="rate" name="rating" value="2" />
                                        <label for="star2">2 stars</label>
                                        <input type="radio" id="star1" class="rate" name="rating" value="1" />
                                        <label for="star1">1 star</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="comment" rows="6" maxlength="200" required
                                    placeholder="Add Comments">{{ old('comment') }}</textarea>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark">Save Rating</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-xl-4 col-md-4 mt-4">
            <div class="card shadow border-0 my-3">
                @if ($data->image)
                    <img src="{{ asset('storage/' . $data->image) }}" alt="blog-post" class="card-img-top img-fluid" />
                @else
                    <img src="{{ asset('images/404.png') }}" alt="blog-post" class="card-img-top img-fluid" />
                @endif
            </div>
        </div>
        <div class="col-xl-8 col-md-8 mt-4">
            <div class="card shadow border-0 my-3">
                <div class="card-body scroll">
                    <h2 class="card-title fw-normal text-center mb-3">{{ $data->title }}</h2>
                    <h5 class="fw-normal mb-3">By.
                        <small class="text-muted">
                            <span class="badge bg-success">{{ $data->author->name }}</span> in
                            <span class="badge bg-primary">{{ $data->category->name }}</span>
                        </small>
                    </h5>
                    <h6 class="lead fw-normal">{!! $data->body !!}</h6>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        
    </script>
@endsection