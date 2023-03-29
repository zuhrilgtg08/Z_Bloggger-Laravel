@extends('layouts.frontend.main')
@section('styles')
    <style>
        .lds-ring {
            position: relative;
            display: inline;
            width: 30px;
            height: 30px;
        }
        .lds-ring div {
            width: 20px;
            height: 20px;
            display: inline;
            margin: 2.5px 0 0 5px;
            box-sizing: border-box;
            position: absolute;
            border: 3.5px solid #dfc;
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: #dfc transparent transparent transparent;
        }
        .lds-ring div:nth-child(1) {
            animation-delay: -0.45s;
        }
        .lds-ring div:nth-child(2) {
            animation-delay: -0.3s;
        }
        .lds-ring div:nth-child(3) {
            animation-delay: -0.15s;
        }
        @keyframes lds-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        img.image-landing{
            animation: bounce 3s linear infinite;;
            transition: all ease-in-out .3s;
        }

        @keyframes bounce {
            0%,
            100% {
                transform: translateY(0rem);
        }
            
            50% {
                transform: translateY(-1rem);
            }
        }
    </style>
@endsection
@section('container')
<div class="row justify-content-center my-5">
    <div class="col-lg-10 mt-4">
        <div class="row justify-content-center">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session()->has('loginErorr'))
                <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
                    {{ session('loginErorr') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="card mb-3 border-0">
            <div class="row my-4">
                <div class="col-xl-5">
                    <img class="image-landing card-img-top img-fluid rounded" 
                        src="images/landing-image.png" alt="landing-image" />
                </div>
                <div class="col-xl-7">
                    <div class="card-body">
                        <h3 class="fw-normal card-title text-center mb-3">Please Login!</h3>

                        <form action="/login" method="POST" class="btn-submit">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="name@example.com" name="email" autofocus required value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                            </div>
                            
                            <div class="text-center mb-3">
                                <button class="btn btn-danger w-25" type="submit">Login 
                                    <div class="lds-ring d-none">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </button>
                            </div>

                            <div class="text-center mb-3">
                                <small>Not Registered ? <a href="/register">Register Now</a></small>
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
        let btnSubmit = document.querySelector('.btn-submit');
        let ldsRing = document.querySelector('.lds-ring');
        btnSubmit.addEventListener('submit', function(event) {
            event.preventDefault();
            setInterval(() => {
                ldsRing.classList.remove('d-none');
            }, 1000);
            setTimeout(() => {
                btnSubmit.submit();
            }, 1500);
        })
    </script>
@endsection