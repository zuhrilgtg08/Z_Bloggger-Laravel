@extends('layouts.dashboard.main', ['sbMaster' => true, 'sbActive' => 'master.rating'])
@section('content')
    <h1 class="mt-4">Data Rating Posts</h1>
    <ol class="breadcrumb mb-3">
        <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none text-dark">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Rating Posts</li>
    </ol>

    <div class="row">
        <div class="col-md-6 my-2">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('delete') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    
        <div class="col-lg-12 mt-3">
            <div class="card mb-4 shadow border-0">
                <div class="card-header">
                    <i class="fa-solid fa-table"></i>
                    Your Rating Posts
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Like</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($data as $item)
                                <tr class="text-center">
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        @if ($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="post-image" 
                                                class="img-fluid" style="width: 80px; height: 80px; "/>
                                        @else
                                            <img src="{{ asset('images/404.png') }}" alt="post-image" class="img-fluid"
                                                style="width: 80px; height: 80px; " />
                                        @endif
                                    </td>
                                    <td><h5 class="fw-normal">{{ $item->title }}</h5></td>
                                    <td><h5 class="fw-normal">{{ $item->category->name }}</h5></td>
                                    <td>{{ $item->like_value }} <i class="fa-solid fa-heart text-danger"></i></td>
                                    <td>
                                        <a href="{{ route('dashboard.ratings.show', $item->id) }}" class="btn btn-primary"><i class="fa-solid fa-circle-info"></i></a>
                                        <form action="{{ route('dashboard.ratings.destroy', $item->id) }}" method="POST" class="d-inline">
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
                    text: "Ingin Menghapus Rating Ini!",
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