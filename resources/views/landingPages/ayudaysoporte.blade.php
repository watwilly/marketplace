@extends('layouts.app')
@section('content')




    @section('meta')

    <meta  name=title content="{{Voyager::setting('title')}}" >
    <meta  name=description content="marketplace donde comprar y vender es mucho mas barato">
    <meta  name=keywords content="compra venta, ventas en tucuman" >
    <meta  property=og:locale content="es_ar" >
    <meta  property=og:description content="{{Voyager::setting('description')}}" >
    <meta  property=og:site_name content="{{Voyager::setting('title')}}" >
    
    <title>Ayuda y Soporte | Ventas Tucuman</title>
    <link rel="stylesheet" href="https://blackrockdigital.github.io/startbootstrap-new-age/device-mockups/device-mockups.min.css">
    <link href="https://blackrockdigital.github.io/startbootstrap-new-age/css/new-age.min.css" rel="stylesheet">
    @append


    <header class="masthead " style="color:black;">
      <div class="container h-100">
        <div class="row">
          <div class="col-md-12  ayuda">
            <span>Ayuda</span>
          </div>

            <div class="col-md-12">
              <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#registro">Como registrarte</a>
                    </h4>
                  </div>
                  <div id="registro" class="panel-collapse collapse ">
                    <div class="panel-body black">
                      <ul>
                        <li>En ventas tucuman te puedes registrar en distintas formas</li>
                        <br>
                        <li>Registro con Facebook: Hace click en el icono de Facebook, te redirigiremos a la pagina de Facebook donde vincularas tu cuenta cno ventas tucumán</li>
                        <li>Registro con Google: Hace lick en <b>Registrarme</b> una vez adentro click en el icono de Google y listo</li>
                        <li>Registro sin redes sociales: entra donde dice <b>Registrarme</b> y llena el formulario con tus datos</li>
                      </ul>

                    </div>
                  </div>
                </div>

                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#isessionormal">Como iniciar session</a>
                    </h4>
                  </div>
                  <div id="isessionormal" class="panel-collapse collapse">
                    <div class="panel-body">
                      <p>En la parte superior del sitio web, Hay una leyenda que dice <b>Ingresar</b> Se abrira una nueva ventana, hay podras, poner tus credenciales o iniciar con tu cuenta de google o facebook</p>
                    </div>
                  </div>
                </div>

                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#comovender">Como vender</a>
                    </h4>
                  </div>
                  <div id="comovender" class="panel-collapse collapse">
                    <div class="panel-body">
                      <ul>
                        <li>Para vender primero tienes que estar <b>Registrado</b></li>
                        <li>Una vez registrado, ingresas al sistema, en la parte derecha veras todas las opciones  hacer click en <b>Publicar</b> Llena los datos de tu publicacion y listo</li>
                        <li>Ya estas vendiendo</li>
                      </ul>
                    </div>
                  </div>
                </div>


                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#pservicio">Publicar Servicios</a>
                    </h4>
                  </div>
                  <div id="pservicio" class="panel-collapse collapse">
                    <div class="panel-body">
                      <ul>
                        <li>En tu panel donde dice <b>Administrador de servicios</b> Hay podras agregar, modificar y eliminar tus servicios.</li>
                        <li><small>Todos los servicios estaran sujetos a moderacion antes de ser publicado</small></li>
                      </ul>
                    </div>
                  </div>
                </div>


                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#restablecerpassword">Cambiar o restablecer Contraseña</a>
                    </h4>
                  </div>
                  <div id="restablecerpassword" class="panel-collapse collapse">
                    <div class="panel-body">
                      <ul>
                        <li>Si tienes una session iniciada, la puedes cambiar desde la cofiguracion de tu cuenta.</li>
                        <li>Si la olvidaste puedes hacer click en <b>ingresar</b> y luego click donde dice he olvidado mi contraseña, se enviara un email con un link a tu correo, para restablecer tu contraseña</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#creartienda">Crear una tienda</a>
                    </h4>
                  </div>
                  <div id="creartienda" class="panel-collapse collapse">
                    <div class="panel-body">
                      <ul>
                        <li>Ingresar a tu <b>Cuenta</b> hacer click donde dice <b>Tienda</b></li>
                        <li>Una ves hay cargas, el banner de tu tienda, el logo y le pones el nombre de tu tienda</li>
                        <li><small>Todas las tiendas estan sujetas a moderacion antes de ser aprobada</small></li>
                      </ul>
                    </div>
                  </div>
                </div>









              </div> 
            </div>
          </div>

        <div class="row">
        <div class="col-md-12  ayuda">
          <span>Soporte</span>
        </div>
        </div>
        <div class="col-md-12 b-white">
            <h4>Cualquien duda, consulta o reclamo que quieras realizarnos, envianos un email a <b>soporte@ventastucuman.com</b> respondemos en 15 minutos aproximadamente. </h4>
        </div>

        </div>

    </header>



@endsection