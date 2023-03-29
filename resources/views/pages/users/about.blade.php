@extends('layouts.frontend.main')

@section('container')
    <h2 class="text-center font-semibold mb-4">About Z-Blogger This</h2>
    <div class="col-lg my-3">
        <div class="my-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-8 m-auto p-auto">
                    <p class="fw-normal">
                        Z-Blogger is a content management platform designed to help individuals create personalized blogs to write, edit and
                        publish posts online. Users can sign in or switch between multiple accounts to view, follow and comment on blogs.
                        <br>
                        The web-based service allows bloggers to include specific pages and sections related to contact details or about us as
                        tabs, add links to external websites and use preview functionality to edit pages or posts before publishing. The
                        application stores uploaded videos and photos.
                    </p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/blog-gif.gif') }}" alt="about"
                        class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 text-center">
        <div class="card-body">
            <h6 class="mb-3">For business you can contact via: : </h6>
            <a href="https://www.facebook.com/ahmad.z.fahrizal.35/" class="btn btn-primary" target="blank">
                <i class="fab fa-fw fa-facebook"></i>
                Facebook
            </a>
            <a href="https://www.instagram.com/zuhrillfilm/" class="btn btn-danger" target="blank">
                <i class="fab fa-fw fa-instagram"></i>
                Instagram
            </a>
            <a href="https://wa.me/085843960995" class="btn btn-success" target="blank">
                <i class="fab fa-fw fa-whatsapp"></i>
                Whatsapp
            </a>
            <a href="https://www.linkedin.com/in/zuhril-fahrizal-b6a627245/" class="btn btn-dark" target="blank">
                <i class="fab fa-fw fa-linkedin"></i>
                Linkedin
            </a>
        </div>
    </div>
@endsection
