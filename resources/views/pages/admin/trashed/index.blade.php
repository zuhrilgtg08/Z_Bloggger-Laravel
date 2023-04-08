@extends('layouts.dashboard.main', ['sbMaster' => true, 'sbActive' => 'master.postTrashed'])
@section('content')
    <h1 class="mt-4">All Corrupted Post Data</h1>
    <ol class="breadcrumb mb-3">
        <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none text-dark">Dashboard</a></li>
        <li class="breadcrumb-item active">All Corrupted Post Data</li>
    </ol>

    <div class="row">
        <div class="col-md-6 my-2">
            @if (session()->has('deleted'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('deleted') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    
        <div class="col-lg-12 mt-3">
            <div class="card mb-4 shadow border-0">
                <div class="card-header">
                    <i class="fa-solid fa-archive"></i>
                    All Corrupted Post Data

                    @if (!$posts_trash->isEmpty())
                        <div class="float-end">
                            <a href="{{ route('dashboard.trashed.restore.all') }}" class="btn btn-dark mb-3">
                                <i class="fa-solid fa-window-restore"></i> Restore All Post
                            </a>

                            <form action="{{ route('dashboard.trashed.destroy.all') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger mb-3 all-delete">
                                    <i class="fa-solid fa-trash"></i> Delete All Post
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Deleted At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($posts_trash as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->deleted_at }}</td>
                                <td>
                                    <a href="{{ route('dashboard.trashed.restore', $item->id) }}" class="btn btn-success">
                                        <i class="fa-solid fa-trash-arrow-up"></i> Restore
                                    </a>
                                    <form action="{{ route('dashboard.trashed.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger single-delete" type="button">
                                            <i class="fa-solid fa-trash"></i>
                                            Delete 
                                        </button>
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
            $('.single-delete').click(function(event) {
                var form = $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                    title: 'Yakin Hapus?',
                    text: "Postingan Ini Akan Dihapus Secara Permanen!",
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
                    }, 200);
                });
            });

            $('.all-delete').click(function(event) {
                var form = $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                    title: 'Yakin Hapus?',
                    text: "Hapus Semua Postingan Secara Permanen!",
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
                    }, 200);
                });
            });
        });
    </script>
@endsection