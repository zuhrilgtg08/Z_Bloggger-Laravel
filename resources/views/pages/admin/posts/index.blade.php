@extends('layouts.dashboard.main', ['sbMaster' => true, 'sbActive' => 'master.posts'])
@section('content')
    <h1 class="mt-4">Data Posts</h1>
    <ol class="breadcrumb mb-3">
        <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none text-dark">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Posts</li>
    </ol>
    <div class="row">
        <div class="col-md-6 my-2">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('deleted'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('deleted') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="col-lg-12 mt-3">
            <div class="card mb-4 shadow border-0">
                <div class="card-header">
                    <i class="fa-solid fa-table"></i>
                    All Posts

                    <a href="{{ route('dashboard.posts.create') }}" class="btn btn-dark mb-3 float-end">
                        <i class="fa-solid fa-square-plus"></i> Create New Post
                    </a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered table-striped">
                        <thead>
                            <tr>    
                                <th>No</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.posts.show', $post->id) }}" class="btn btn-primary"><i class="fa-solid fa-circle-info"></i></a>
                                        <a href="{{ route('dashboard.posts.edit', $post->id) }}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form action="{{ route('dashboard.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger sweet-delete" type="button"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.sweet-delete').click(function(event) {
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
        });
    </script>
@endsection