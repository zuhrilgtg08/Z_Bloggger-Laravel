@extends('layouts.dashboard.main', ['sbMaster' => true, 'sbActive' => 'master.users'])

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
    <h1 class="mt-4">Detail User</h1>
    <ol class="breadcrumb mb-3">
        <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none text-dark">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/dashboard/users" class="text-decoration-none text-dark">Data Users</a></li>
        <li class="breadcrumb-item active">Detail User</li>
    </ol>

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
                <div class="card-body">
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
                                <div class="col-lg-8"> :
                                    {{ sprintf("%s-%s-%s", substr($user->no_hp, 0, 4), substr($user->no_hp, 4, 4), substr($user->no_hp, 8)); }}
                                </div>
                            </div>
                            <div class="row ctx">
                                <div class="col-lg-4 tag">Email</div>
                                <div class="col-lg-8"> : {{ $user->email }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection