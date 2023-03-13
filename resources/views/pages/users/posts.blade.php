@extends('layouts.frontend.main')

@section('container')
    <h1 class="mb-3 text-center">Halo posts</h1>

    {{-- <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/blog" method="GET">

                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                    <button class="btn btn-danger" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div> --}}

    {{-- @if ($posts->count())
        <div class="card mb-3">
            @if ($posts[0]->image)
                <div style="overflow:hidden; max-height:400px;" >
                    <img src="{{ asset('storage/' . $posts[0]->image) }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
                </div>
            @else
                <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
            @endif

            <div class="card-body text-center">
                <h3 class="card-title">
                    <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a>
                </h3>
                <p>By. 
                    <small class="text-muted">
                        <a href="/blog?author={{ $posts[0]->author->username }}" class="text-decoration-none">{{ $posts[0]->author->name }}</a> in 
                        <a href="/blog?category={{ $posts[0]->category->slug }}" class="text-decoration-none">{{ $posts[0]->category->name }}</a>
                        {{ $posts[0]->created_at->diffForHumans() }}
                    </small>
                </p>

                <p class="card-text">{{ $posts[0]->excerpt}}</p>

                <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-danger">Read More</a>
            </div>
        </div>


        <div class="container">
            <div class="row">
                @foreach ( $posts->skip(1) as $post)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="position-absolute px-3 py-2" style="background-color: rgba(226, 173, 25, 0.7);"><a href="/blog?category={{ $post->category->slug }}" class="text-white text-decoration-none">{{ $post->category->name }}</a></div>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->category->name }}">
                            @else
                                <img src="https://source.unsplash.com/400x300?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p>By. 
                                    <small class="text-muted">
                                        <a href="/blog?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> 
                                        {{ $post->created_at->diffForHumans() }}
                                    </small>
                                </p>
                                <p class="card-text">{{ $post->excerpt }}</p>
                                <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @else 
        <p class="text-center fs-4">No Post Found.</p>
    @endif --}}

    {{-- <div class="d-flex justify-content-end">
        {{ $posts->links() }}
    </div> --}}

    {{-- @foreach ($posts->skip(1) as $post)
    <article class="mb-5 border-bottom pb-4">   
        <a href="/posts/{{ $post->slug }}" class="text-decoration-none">
            <h2>{{ $post->title }}</h2>
        </a>

        <h5>By. <a href="/authors/{{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/categories/{{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></h5>

        <p>{{ $post->excerpt }}</p>

        <a href="/posts/{{ $post->slug }}" class="text-decoration-none">Read More</a>
    </article>
    @endforeach --}}
@endsection



