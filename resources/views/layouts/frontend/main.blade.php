<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
        <!-- bootsrap-icon-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <!-- my style -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('images/blogging.png') }}" />
        <title>Z-Blogger</title>
    <body>
        @include('layouts.frontend.partials.navbar')

            <div class="container mt-4">
                @yield('container')
            </div>
        
        <footer class="footer mt-5 py-3 bg-danger">
            <div class="container text-center">
                <span class="text-light">Copyright &copy; Ahmad Zuhril {{ date('Y'); }}</span>
            </div>
        </footer>
        
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        @yield('script')
    </body>
</html>