<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Freelancer - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" />
    </head>
    <body id="page-top">

        @include('includes.header')

        @yield('content')

        @include('includes.footer')
        
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright © Your Website 2020</small></div>
        </div>
        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
      
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
        <script src="{{ URL::asset('assets/mail/jqBootstrapValidation.js') }}"></script>
        <script src="{{ URL::asset('assets/mail/contact_me.js') }}"></script>
        <!-- Core theme JS-->
        <script src="{{ URL::asset('js/scripts.js') }}"></script>
    </body>
</html>
