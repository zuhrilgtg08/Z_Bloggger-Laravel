@extends('dashboard.layouts.main')
@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
                <h1 class="mb-3">{{ $post->title }}</h1>

                <a href="/dashboard/posts" class="btn btn-primary"><span data-feather="arrow-left"></span> Back to ALL My Post</a>
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit-2"></span> Edit Post</a>
                <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf

                    <button class="btn btn-danger" onclick="return confirm('Are You Sure?')"><span data-feather="trash" class="text-white"></span> Delete Post</button>
                </form>

                    
                @if ($post->image)
                    <div style="max-height:350px; overflow:hidden;" >
                        {{-- <img src="{{ asset('storage/' . $post->images) }}" class="img-fluid mt-3"> --}}
                        <img src="{{ asset('storage/' . $post->image) }}" alt="images-post" class="img-fluid mt-3">
                    </div>
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
                @endif

                <article class="my-3 fs-5">
                    {{-- tidak melakukan escaping memasukkan variable bila ada tag html --}}
                    {!! $post->body !!}
                </article>
                {{-- <a href="/blog" class="d-block mt-3">Back To Post</a>    --}}
            </div>
        </div>
    </div>
@endsection