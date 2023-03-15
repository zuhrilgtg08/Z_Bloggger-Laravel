@extends('layouts.dashboard.main', ['sbMaster' => true, 'sbActive' => 'master.categories'])
@section('content')
<h1 class="mt-4">Edit Category</h1>
<ol class="breadcrumb mb-3">
    <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none text-dark">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/dashboard/categories" class="text-decoration-none text-dark">Data Categories</a></li>
    <li class="breadcrumb-item active">Edit Category</li>
</ol>

    <div class="row justify-content-center">
        <div class="col-lg-6 mt-3">
            <div class="card mb-4 shadow border-0">
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.categories.update', $category->slug) }}">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" required autofocus value="{{ old('name', $category->name) }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                name="slug" required value="{{ old('slug', $category->slug) }}">
                            @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <button type="submit" class="btn btn-primary sweet-submit"><i class="fa-solid fa-floppy-disk"></i>
                            Update Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.sweet-submit').click(function(event){
            var form = $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: 'Sudah Yakin?',
                text: "Simpan Perubahan Data Category!",
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
            
            const name = document.querySelector('#name');
            const slug = document.querySelector('#slug');

            name.addEventListener('change', function(){
                fetch('/dashboard/categories/checkSlug?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
            });
    </script>
@endsection