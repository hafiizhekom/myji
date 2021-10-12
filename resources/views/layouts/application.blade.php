<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Permanent+Marker&display=swap" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <!-- Additional CSS -->
    <link rel="stylesheet" href="{{asset('/assets/css/vertilcal-carousel.css')}}">
    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/slick-theme.css')}}"/>

    @yield('additionalCss')
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/assets/images/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/assets/images/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/assets/images/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('/assets/images/favicons/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('/assets/images/favicons/safari-pinned-tab.svg')}}" color="#f49102">
    <meta name="msapplication-TileColor" content="#f49102">
    <meta name="theme-color" content="#f49102">

    <title>MYJI - @yield('pagetitle')</title>
  </head>
  @if(\Request::is('site'))
  <body>
  @else
  <body class="bg-cream">
  @endif
    <!-- Navbar -->
    @include('layouts.partials.navbar')
    <!-- End Navbar -->

    @yield('content')

    <!-- Footer -->
    @include('layouts.partials.footer-index')
    <!-- End Footer -->

    
    @yield('modals')
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('/assets/javascripts/slick.min.js')}}"></script>

    {{-- <script type="text/javascript" src="{{asset('/assets/javascripts/jquery.scrollify.min.js')}}"></script> --}}

    @yield('additionalJs')

    <script>
        $(document).ready(function () {
            $('.carousel').carousel()
            $(document).scroll(function () {
                if(window.location.pathname === '/site'){
                    var $nav = $(".navbar.fixed-top");
                    
                    if($(this).scrollTop() < $("#our-story").height())  $nav.css("background", "none")
                    if($(this).scrollTop() + 100 > $("#our-story").offset().top) $nav.css("background", "#FCC349")
                    if($(this).scrollTop() + 100 > $("#our-most-wanted").offset().top) $nav.css("background", "#fff")
                    if($(this).scrollTop() + 100 > $("#testimony").offset().top) $nav.css("background", "#229F77")   

                    var btnBack = $('#backToTopLink-wrapper')[0];

                    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                        if(btnBack) btnBack.style.opacity = "1"
                    } else {
                        if(btnBack) btnBack.style.opacity = "0"
                    }
                }    
            });

            $('.carousel-slick').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3,
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: [
                    {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                    },
                    {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                    },
                    {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                    }
                ]
            });

            $.scrollify({
                section : ".section-scrollify",
                interstitialSection:"#footer-home"
            });

            @yield('js')
        });

        function scrollToTop() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        }

    </script>


  </body>
</html>