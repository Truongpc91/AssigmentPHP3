<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title-page')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    {{-- <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}

    <!-- Favicon -->
    <link href="{{ asset('theme/clients/eshopper/img/icon-thiet-ke-linh-vuc-logo-thuong-hieu-thoi-trang-my-pham-lam-dep-spa-baa-brand-1.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('theme/clients/eshopper/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('theme/clients/eshopper/css/style.css') }}" rel="stylesheet">
    {{-- <link href="" rel="icon"> --}}

</head>

<body>

    @include('clients.layouts.header')

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    @yield('content')


    @include('clients.layouts.footer')

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('theme/clients/eshopper/lib/easing/easing.min.js') }}" rel="icon">
    <link href="{{ asset('theme/clients/eshopper/lib/owlcarousel/owl.carousel.min.js') }}" rel="icon">

    <!-- Contact Javascript File -->
    <link href="{{ asset('theme/clients/eshopper/mail/jqBootstrapValidation.min.js') }}" rel="icon">
    <link href="{{ asset('theme/clients/eshopper/mail/contact.js') }}" rel="icon">

    <!-- Template Javascript -->
    <link href="{{ asset('theme/clients/eshopper/js/main.js') }}" rel="icon">
</body>

</html>
