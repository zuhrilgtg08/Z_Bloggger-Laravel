@extends('layouts.dashboard.main', ['sbMaster' => true, 'sbActive' => 'master.archived'])

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
        <a href="{{ route('dashboard.bookmarks.index') }}" class="btn btn-primary">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>
    <div class="row my-3 justify-content-center">
        <div class="col-lg-5 col-xl-5">
            <div class="card shadow border-0 my-4">
                @if ($row->image)
                    <img src="{{ asset('storage/' . $row->image) }}" alt="images-post" class="img-fluid card-img-top" />
                @else
                    <img src="{{ asset('images/404.png') }}" alt="{{ $row->category->name }}" class="img-fluid card-img-top" />
                @endif
                <div class="card-body">
                    <h5 class="fw-bolder card-title text-success">{{ $row->title }}</h5>
                    <h6 class="text-base">By : <span class="text-primary">{{ $row->author->name }}</span></h6>
                    <h6 class="text-base">Category : <span class="text-danger">{{ $row->category->name }}</span></h6>
                    <p class="card-text">
                        {!! $row->body !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-xl-7">
            <div class="card shadow border-0 my-4">
                <div class="card-body scroll">
                    <h3 class="fw-normal text-danger">Comments Section : </h3>
                    @php $no = 1; @endphp
                    @if (!$row->rating_comments->isEmpty())
                        @foreach ($row->rating_comments as $data)
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