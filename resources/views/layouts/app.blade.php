<!DOCTYPE html>
<html lang="es-DO">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"   content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta  name=robots      content="index, follow" >
    <link rel="icon" href="/storage/{{Voyager::setting('site.admin_icon_image')}}">
    <meta property="og:type"  content="website" />
    <meta name="Locality" content="Santo Domingo, Republica Dominicana" />
    <meta name="distribution" content="global" />
    <meta name="rating" content="general" />
    <meta name="language" content="es_DO" />
    <meta name=copyright content="https://idedicado.com.ar" >
    <meta name="url" content="https://{{$_SERVER['HTTP_HOST']}}{{$_SERVER['REQUEST_URI']}}">
    <meta property="og:url" content="https://{{$_SERVER['HTTP_HOST']}}{{$_SERVER['REQUEST_URI']}}" />
    <link rel="canonical" href="https://{{$_SERVER['HTTP_HOST']}}{{$_SERVER['REQUEST_URI']}}" />
    <meta name="twitter:card" content="summary" />
    @yield('meta')

    <link rel="stylesheet" href="{{asset('assets/vendor/fontawesome/css/all.min.css')}}" >
    <link rel="stylesheet" href="{{asset('assets/vendor/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    @yield('jsheader')

    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-69941808-15');
    </script>


    <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "WebSite",
          "url": "https://www.{{$_SERVER['HTTP_HOST']}}{{$_SERVER['REQUEST_URI']}}"
        }
    </script>

</head>
<body id="body">
    <?php 
        $user=null;
        if (Auth::check()) {
            $user=Auth::user();
        }
    ?>

    @include('layouts.sidebarmenu')
    <main class="bg-light main">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <div class="loader" id="cargando" style="display: none; z-index: 900; ">
            <div class="loading">
                <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i>
                <span class="">Por favor espere...</span>
            </div>|
        </div>

        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')
    </main>

    <script src="{{asset('assets/vendor/jquery/jquery.slim.min.js')}}"></script>
    <script src="{{asset('assets/vendor/slick/slick.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/toastr.js')}}"></script>
    <script rel="preconnect" src='https://www.google.com/recaptcha/api.js'></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-69941808-15"></script>

    @if(Session::get("status"))
        <script>
            toastr('{{Session::get("status")}}','{{Session::get("msg")}}');
        </script>
    @endif
    @yield('jsfooter')
</body>
</html>