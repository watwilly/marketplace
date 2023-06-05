<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Ventas Tucumán</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
    <style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Roboto:400,700);
    a:hover { text-decoration: none !important; }
    ul li {margin-bottom:25px}
    p {line-height:25px; margin-bottom: 10px;color: #333; font-size: 14px; font-family: 'Roboto', sans-serif;}
    </style>
</head>
    <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f3f3f3;" leftmargin="0">
        <table cellspacing="0" border="0" cellpadding="0" width="100%" align="center">
            <tr>
                <td>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td valign="middle" align="center" height="50"></td>
                        </tr>
                    </table>
                    <table width="660" border="0" cellpadding="0" cellspacing="0" align="center">
                        <tr>
                            <td valign="middle" align="left">
                                <img src="https://{{$_SERVER['HTTP_HOST']}}/storage/{{Voyager::setting('site.logo')}}" alt="{{Voyager::setting('title')}}">
                            </td>
                        </tr>
                    </table>
                    <table width="660" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                        <tr>
                            <td valign="middle" style="padding: 20px 35px;">
                                <h3>Estimado Moderador se ha recibido un nuevo reporte con los siguientes datos.</h3>

                                <p>Id de la publicacion: {{$post_id}}</p>
                                <p>Id del usuario: {{$user_id}}</p>
                                <p>Detalle del reporte: {{$detalle_reporte}}</p>

                                <b>Se recomienda revisar la publicacion y tomar las acciones necesarias</b>

                                <p>Att: Equipo de Soporte de saldeello.com</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>