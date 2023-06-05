<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
    @include("emails.style")
</head>

<body class="container my-6 bg-light">

    <main class="card shadow">
        <header class="text-center">
            <img src="https://www.ventastucuman.com/storage/{{Voyager::setting('site.logo')}}" alt="">
            <hr>
        </header>
        <div class="card-body">
            <section class="text-center mb-5">
                <h1 class="section__lead--2">Nueva consulta</h1>
                <h4 class="lead">Alguien está interesado en una publicación tuya y tiene una consulta para vos</h4>
            </section>
            <section class="fs-5 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h6><small class="text-muted">DD/MM/AAAA</small></h6>
                        <h6 class="mb-4">
                            Artículo: <a href="#" class="link-success">{{$post->title}}</a>
                        </h6>
                        <h5 class="card-title">{{$mensaje}}</h5>
                    </div>
                </div>
            </section>
            <section class="fs-5 text-center">
                <p>Ingresá a tu cuenta para responder esta consulta</p>
                <a href="https://{{$_SERVER['HTTP_HOST']}}/auth/user/login" class="btn btn-primary mb-3">Iniciar Sesión</a>
            </section>
        </div>
        <footer class="card-footer bg-dark p-3 text-center">
            <h6 class="text-light m-0">Atentamente, el equipo de <a href="https://www.saldeello.com">saldeello.com</a></h6>
        </footer>
    </main>
</body>

</html>
