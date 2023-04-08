@extends('layouts.frontend.main')
@section('container')
    <h1 class="mb-5 font-semibold text-center">Popular Posts</h1>

    <div class="container">
        <div class="row justify-content-center mb-5">
            @if ($datas->count())
                @foreach ($datas as $key => $item)
                     <div class="col-md-4 col-xl-4 mb-5">
                        <div class="card h-100 shadow">
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="post-image" class="img-fluid card-img-top" />
                            @else
                                <img src="{{ asset('images/404.png') }}" alt="default-post" class="img-fluid card-img-top" />
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <h6 class="card-text">Category : <span class="badge bg-success">{{ $item->category->name }}</span></h6>
                                <p class="lead text-danger text-center">
                                   @for ($i=0; $i < $item->like_value; $i++) 
                                        <i class="fa-solid fa-heart"></i>
                                   @endfor
                                </p>
                                <p class="card-text">{{ $item->excerpt }}</p>
                                <a href="{{ url('/home/post/detail/' . $item->id) }}" class="btn btn-success">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-7 col-xl-7 mb-5">
                    <h4 class="text-center fw-normal mb-5">Posts is Not Found!</h4>
                    <div class="card border-0" style="max-width: 40rem;">
                        <img src="{{ asset('images/not-404.gif') }}" alt="not-found" 
                            class="card-img-top img-fluid"/>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection