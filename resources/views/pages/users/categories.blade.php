@extends('layouts.frontend.main')

@section('styles')
    <style>
        .kartu-categories:hover {
            transform: scale(1.1);
            transition: all ease .3s;
        }
    </style>
@endsection

@section('container')
    <h2 class="my-4 text-center font-semibold fw-normal">
        Post Categories
    </h2>

    <div class="container mt-4">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-4 mb-4">
                    <a href="/?category={{ $category->slug }}">
                        <div class="card text-white kartu-categories rounded shadow-sm">
                            <img src="{{ asset('images/category-post.jpg') }}" class="card-img" alt="{{ $category->name }}">
                            <div class="card-img-overlay d-flex align-items-center p-0">
                                <h5 class="card-title text-center flex-fill p-4 fs-3" 
                                    style="background-color: rgba(253, 78, 136, 0.644);">
                                        {{ $category->name }}
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection



