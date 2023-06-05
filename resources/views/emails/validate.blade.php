<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-mail: Validar correo electrónico</title>

    @include("emails.style")

</head>

<body class="container my-6 bg-light">

    <main class="card shadow">
        <header class="text-center">
          <img src="https://{{$_SERVER['HTTP_HOST']}}/storage/{{Voyager::setting('site.logo')}}" alt="{{Voyager::setting('site.title')}}">
            <hr>
        </header>
        <div class="card-body">
            <section class="text-center mb-5">
                <h1 class="section__lead--2">¡Gracias por registrarte en saldeello.com!</h1>
                <h4 class="lead">Por favor valida tu correo electrónico para empezar de publicar y vender en el portal</h4>
            </section>
            <section class="fs-5 text-center">
                <p>Estimado/a {{$data["name"]}} {{$data["apellido"]}}, hace click en el botón validar para seguir con tu registro</p>
                <a href="https://{{$_SERVER['HTTP_HOST']}}/auth/validate_account/{{$data['email']}}/{{$data['_token']}}" class="btn btn-primary">Validar</a>
            </section>
        </div>
        <footer class="card-footer bg-dark p-3 text-center">
            <h6 class="text-light m-0">Atentamente, el equipo de <a href="https://www.saldeello.com">saldeello.com</a></h6>
        </footer>
    </main>
</body>

</html>
