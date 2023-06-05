<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Saldeello.com</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
    <style type="text/css">
    @import  url(http://fonts.googleapis.com/css?family=Roboto:400,700);
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
                                <img style="width: 150px;" src="https://<?php echo e($_SERVER['HTTP_HOST']); ?>/storage/<?php echo e(Voyager::setting('site.logo')); ?>" alt="<?php echo e(Voyager::setting('title')); ?>">
                            </td>
                        </tr>
                    </table>
                    <table width="660" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                        <tr>
                            <td valign="middle" style="padding: 20px 35px;">
                                <h3>¡Hola! se ha recibido un nuevo postulante a tu oferta <b><?php echo e($oferta->titulo); ?></b>.</h3>
                                <p><b>Datos del Interesado</b></p>
                                <ul>
                                    <li>Nombre: <?php echo e($user->name); ?></li>
                                    <li>Apellido: <?php echo e($user->apellido); ?></li>
                                    <li>E-mail: <?php echo e($user->email); ?></li>
                                    <li>Teléfono: <?php echo e($user->telefono); ?></li>
                                </ul>
                
                                <p><b>Oferta laboral a la que se postulo</b></p>
                                <ul>
                                    <li>Titulo:<?php echo e($oferta->titulo); ?></li>
                                    <li>Vacantes:<?php echo e($oferta->vacantes); ?></li>
                                    <li>Puesto:<?php echo e($oferta->puesto); ?></li>
                                    <li><a href="https://www.saldeello.com/empleo/<?php echo e($oferta->puesto); ?>/<?php echo e($oferta->titulo); ?>/<?php echo e($oferta->id); ?>">Click aqui para ver</a></li>
                                </ul>
                                <b>Ponte en contacto con esta persona para evaluar su perfil</b>
                                <small>Si nunca has publicado una oferta laboral en nuestro sitio web, y te llego este mensaje significa que publicaste en otro sitio y nuestro robot la rastreo y la re publico en saldeello.com</small>
                                <p>Att: Equipo de Saldeello.com</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html><?php /**PATH /var/www/saldeello.com/www/html/resources/views/emails/postulante.blade.php ENDPATH**/ ?>