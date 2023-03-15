@extends('layouts.dashboard.main')
@section('styles')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .profile-card img {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            overflow: hidden;
        }

        .profile-card h2 {
            font-size: 24px;
            font-weight: 700;
            color: #2c384e;
            margin: 10px 0 0 0;
        }

        .profile-card h3 {
            font-size: 18px;
        }

        .profile-edit label {
            font-weight: 600;
            color: rgba(1, 41, 112, 0.6);
        }

        .profile-edit img {
            max-width: 130px;
        }

        .text-title {
            padding: 20px 0 15px 0;
            font-size: 18px;
            font-weight: 500;
            color: #012970;
            font-family: "Poppins", sans-serif;
        }

        .tag {
            font-weight: 600;
            color: rgba(1, 41, 112, 0.6);
        }

        .ctx {
            margin-bottom: 20px;
            font-size: 15px;
        }
    </style>
@endsection

@section('content')
    <h1 class="mt-4">Setting Account</h1>
    <ol class="breadcrumb mb-3">
        <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none text-dark">Dashboard</a></li>
        <li class="breadcrumb-item active">Setting Account</li>
    </ol>

    <div class="col-md-6 my-2">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('fail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('fail') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-xl-4">
            <div class="card my-4 shadow border-0">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    @if ($user->image)
                        <img src="{{ asset('storage/' . $user->image) }}" alt="Profile" class="rounded-circle" />
                    @else
                        <img src="{{ asset('images/default-user.png') }}" alt="Profile" class="rounded-circle" />
                    @endif
                    <h2>{{ $user->name }}</h2>
                    <h3 class="mt-2">{{ $user->work_person ?? '-' }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card my-4 shadow border-0">
                <div class="card-body pt-3">
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                        </li>
                    </ul>

                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active" id="profile-overview">
                            <h5 class="text-title">Tentang Saya</h5>
                            <p class="lead fw-normal fs-6">
                                {{ $user->about_person ?? '-' }}
                            </p>
                            <h5 class="text-title">Profile Details</h5>
                            <div class="row ctx">
                                <div class="col-lg-4 tag">Nama Lengkap</div>
                                <div class="col-lg-8"> : {{ $user->name }}</div>
                            </div>
                            <div class="row ctx">
                                <div class="col-lg-4 tag">Pekerjaan</div>
                                <div class="col-lg-8"> : {{ $user->work_person ?? '-' }}</div>
                            </div>
                            <div class="row ctx">
                                <div class="col-lg-4 tag">Nomor Handphone</div>
                                <div class="col-lg-8"> : {{ sprintf("%s-%s-%s", substr($user->no_hp, 0, 4), substr($user->no_hp, 4, 4), substr($user->no_hp, 8)); }}</div>
                            </div>
                            <div class="row ctx">
                                <div class="col-lg-4 tag">Email</div>
                                <div class="col-lg-8"> : {{ $user->email }}</div>
                            </div>
                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                            <form action="{{ route('dashboard.account.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="image" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                    <div class="col-md-8 col-lg-9">
                                        @if ($user->image)
                                            <img src="{{ asset('storage/' . $user->image) }}" alt="Profile" class="img-preview rounded-2">
                                        @else
                                            <img src="{{ asset('images/default-user.png') }}" alt="Profile" class="img-preview rounded-2">
                                        @endif
                                        <div class="pt-3">
                                            <input type="hidden" name="old_image" value="{{ $user->image }}" />
                                            <input type="file" class="form form-control-file 
                                                form-control-sm @error('image') is-invalid @enderror" name="image"
                                                id="image" onchange="previewImage()" />
                                            @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            value="{{ old('name', $user->name) }}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="username" type="text"
                                            class="form-control @error('username') is-invalid @enderror" id="username"
                                            value="{{ old('username', $user->username) }}" />
                                        @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                                    <div class="col-md-8 col-lg-9">
                                        <textarea name="about_person"
                                            class="form-control @error('about_person') is-invalid @enderror" id="about"
                                            style="height: 100px">{{ $user->about_person }}</textarea>
                                        @error('about_person')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="work_person" class="col-md-4 col-lg-3 col-form-label">Pekerjaan</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="work_person" type="text"
                                            class="form-control @error('work_person') is-invalid @enderror" id="work_person"
                                            value="{{ old('work_person', $user->work_person) }}" />
                                        @error('work_person')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="no_hp" class="col-md-4 col-lg-3 col-form-label">Number Phone</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="no_hp" type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                            value="{{ old('no_hp', $user->no_hp) }}">
                                        @error('no_hp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="Email"
                                            value="{{ old('email', $user->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <form action="{{ route('dashboard.account.change', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="current_password" type="password" 
                                            class="form-control @error('current_password') is-invalid @enderror" id="current_Password" />
                                        @error('current_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="new_password" type="password" 
                                            class="form-control @error('new_password') is-invalid @enderror" id="new_Password" />
                                        @error('new_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="confirm_password" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="confirm_password" type="password" 
                                            class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_Password">
                                        @error('confirm_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function previewImage(){
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection