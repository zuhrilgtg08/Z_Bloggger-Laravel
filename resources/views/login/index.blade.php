@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
    <div class="col-lg-5 mt-4">

        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session()->has('loginErorr'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginErorr') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <main class="form-signin text-center">
            <h1 class="mb-3 fw-normal">Please Login</h1>
            <img class="mb-3" src="images/undraw_mobile_development_re_wwsn.svg" alt="" width="180" height="180">
            <form action="/login" method="post">

                @csrf

                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" name="email" autofocus required value="{{ old('email') }}">
                    <label for="email">Email address</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                    <label for="password">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-danger mb-3" type="submit">Login</button>
            </form>
            <small>Not Registered ? <a href="/register">Register Now</a></small>
        </main>
    </div>
</div>
@endsection