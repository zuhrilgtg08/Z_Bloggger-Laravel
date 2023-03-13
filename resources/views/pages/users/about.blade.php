@extends('layouts.frontend.main')

@section('container')
    <h1>Halaman About</h1>
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow">
            <img src="{{ asset('images/default-post.png') }}" alt="default-post" class="img-fluid card-img-top" />
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                    content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <h3>{{ $name }}</h3>
    <p>{{ $email }}</p>
@endsection
