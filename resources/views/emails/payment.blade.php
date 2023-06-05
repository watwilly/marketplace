<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
    @include("emails.style")
</head>

<body class="container my-6 bg-light">

    <main class="card shadow">
        <header class="text-center p-3">
            <img src="https://{{$_SERVER['HTTP_HOST']}}/storage/{{Voyager::setting('site.logo')}}" alt="{{Voyager::setting('site.title')}}">
            <hr>
        </header>
        <div class="card-body">
            <section class="text-center mb-5">
                <h1 class="section__lead--2">{{$title}}</h1>
                <h4 class="lead">{{$subtitle}}</h4>
            </section>
            <section class="fs-5 mb-3">
                <div class="card card-hover mx-2">
                    <div class="card-body">
                        <h5 class="card-title">{{$cardtitle}}</h5>
                        <ul class="list-group list-group-flush ">
                            <li class="list-group-item">
                                <b>Artículo</b><br>
                                <span><a href="posts.show.php" class="link-success">{{$item->titulo}}</a></span>
                            </li>
                            <li class="list-group-item">
                                <b>Cantidad</b>
                                <span class="float-right-lg">{{$item->cantidad}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Precio</b>
                                <span class="float-right-lg">ARS ${{$item->precio}}</span>
                            </li>
                            <?php $total = $item->precio * $item->cantidad; ?>
                            <li class="list-group-item list-group-item-info">
                                <b>Total</b>
                                <span class="float-right-lg">ARS ${{$total}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--<div class="card card-hover mx-2 mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Detalles del vendedor</h5>
                        <ul class="list-group list-group-flush ">
                            <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                <b>Nombre y Apellido</b>
                                <span>Lorem ipsum dolor sit.</span>
                            </li>
                            <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                <b>DNI</b>
                                <span>45789123</span>
                            </li>
                            <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                <b>Teléfono</b>
                                <span>123456789</span>
                            </li>
                            <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                <b>Domicilio</b>
                                <span>Lorem ipsum dolor sit amet 123 B.</span>
                            </li>
                            <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                <b>Provincia</b>
                                <span>Tucumán</span>
                            </li>
                            <li class="list-group-item d-flex flex-column flex-md-row justify-content-between">
                                <b>Localidad</b>
                                <span>Yerba Buena - 4000</span>
                            </li>
                        </ul>
                    </div>
                </div> -->
            </section>
            <section class="fs-5 text-center">
                <p>Ponte en contacto con el vendedor para concretar la entrega del producto</p>
            </section>
        </div>
        <footer class="card-footer bg-dark p-3 text-center">
            <h6 class="text-light m-0">Atentamente, el equipo de <a href="https://ventastucuman.com/">ventastucuman.com</a></h6>
        </footer>
    </main>
</body>

</html>
