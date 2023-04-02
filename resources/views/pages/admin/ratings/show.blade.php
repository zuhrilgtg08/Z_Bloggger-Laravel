@extends('layouts.dashboard.main', ['sbMaster' => true, 'sbActive' => 'master.rating'])

@section('styles')
    <style>
        .scroll {
            max-height: 22rem;
            overflow-y: auto
        }
    </style>
@endsection

@section('content')
    <div class="col-lg m-3">
        <a href="{{ route('dashboard.ratings.index') }}" class="btn btn-primary">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>
    <div class="row my-3 justify-content-center">
        <div class="col-lg-4 col-xl-4">
            <div class="card shadow border-0 my-4 h-100">
                <div class="row">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="images-post" 
                            class="img-fluid card-img-top" />
                    @else
                        <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}"
                            class="img-fluid card-img-top" />
                    @endif
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="fw-bolder card-title text-success">{{ $post->title }}</h5>
                            <p class="my-3 card-text">
                                {{ $post->excerpt }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-8">
            <div class="card shadow border-0 my-4">
                <div class="card-body scroll">
                    <h3 class="fw-normal text-danger">Comments Section : </h3>
                    @php $no = 1; @endphp
                    @if (!$rating->isEmpty())
                        @foreach ($rating as $data)
                            <div class="border border-1 border-secondary mb-2"></div>
                            <p class="card-text text-success fw-normal">User : {{ $data->user->email }} ({{ $no++ }})</p>
                            <p class="card-text">Rating : {{ $data->like_value }}
                                <i class="fas fa-fw fa-heart text-danger"></i>
                            </p>
                            <p class="card-text text-secondary fw-bold">Comments : {{ $data->comment }}</p>
                        @endforeach
                    @else
                        <p class="card-text">Review Not Found!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection