@extends('layouts.frontend.main')
@section('container')
    <h2 class="mb-5 font-semibold text-center">Popular Post Pages</h2>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3 mb-5">
                <div class="card h-100 shadow">
                    <img src="{{ asset('images/404.png') }}" alt="default-post" class="img-fluid card-img-top" />

                    <div class="card-body">
                        <h5 class="card-title">tes</h5>
                        <p>Rate
                            <i class="fa-solid fa-star"></i>
                        </p>
                        <p class="card-text">tes</p>
                        <a href="">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection