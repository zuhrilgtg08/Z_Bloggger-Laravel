@extends('layouts.dashboard.main', ['sbMaster' => true, 'sbActive' => 'master.posts'])
@section('content')
    <div class="row my-3 justify-content-center">
        <div class="col-lg-9">
            <a href="{{ route('dashboard.posts.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
            <div class="col-lg float-end mb-3">
                <a href="{{ route('dashboard.posts.edit', $post->id) }}" class="btn btn-success"><i
                        class="fa-solid fa-pen-to-square"></i> Edit Post</a>
                <form action="{{ route('dashboard.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger sweet-delete" type="button"><i class="fa-solid fa-trash"></i> Delete Post</button>
                </form>
            </div>
            <div class="card shadow border-0 my-4">
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="images-post" class="img-fluid card-img-top">
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid card-img-top">
                @endif
                <div class="card-body">
                    <h2 class="fw-normal text-center card-title">{{ $post->title }}</h2>
                    <article class="my-3 fs-5">
                        {!! $post->body !!}
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.sweet-delete').click(function(event){
            var form = $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: 'Yakin Hapus?',
                text: "Ingin Menghapus Postingan Ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                setTimeout(() => {
                    if(result.isConfirmed) {
                        form.submit();
                    }
                }, 100);
            });
        });
    </script>
@endsection