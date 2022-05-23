@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
    <div class="col-lg-5 mt-4">
        <main class="form-registration text-center">
            <h1 class="mb-3 fw-normal">Registration Form</h1>
            <img class="mb-3" src="images/undraw_mobile_development_re_wwsn.svg" alt="" width="180" height="180">
            <form action="/register" method="post">

                @csrf

                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" required value="{{ old('name') }}">
                    <label for="name">Name</label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" name="username" required value="{{ old('username') }}">
                    <label for="username">Username</label>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" name="email" required {{ old('email') }}>
                    <label for="email">Email address</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" required>
                    <label for="password">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button class="w-100 btn btn-lg btn-danger mb-3" type="submit">Register Now</button>
            </form>
            <small>All Ready Registered ? <a href="/login">Login</a></small>
        </main>
    </div>
</div>
@endsection