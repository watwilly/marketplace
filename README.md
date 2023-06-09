Marketplace Laravel
Este es un marketplace desarrollado en Laravel, un framework de PHP popular y potente. El marketplace permite a los usuarios registrarse y acceder a la plataforma utilizando sus cuentas de Google y Facebook. A continuación, se detallan los pasos para configurar y ejecutar el proyecto en tu entorno local.

Requisitos
Asegúrate de tener los siguientes requisitos antes de comenzar:

PHP >= 7.4
Composer
MySQL o cualquier otro motor de base de datos compatible
Cuentas de desarrollador de Google y Facebook para configurar la autenticación
Pasos de configuración
Clonar el repositorio

Clona este repositorio en tu máquina local utilizando el siguiente comando:

bash
Copy code
git clone https://github.com/tu-usuario/marketplace-laravel.git
Instalar dependencias

Accede al directorio del proyecto y ejecuta el siguiente comando para instalar las dependencias necesarias:

Copy code
composer install
Configurar archivo .env

Renombra el archivo .env.example a .env y configura los detalles de tu base de datos:

makefile
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_de_datos
DB_USERNAME=usuario
DB_PASSWORD=contraseña
Además, deberás agregar las credenciales de autenticación de Google y Facebook en el archivo .env:

makefile
Copy code
GOOGLE_CLIENT_ID=tu_client_id
GOOGLE_CLIENT_SECRET=tu_client_secret
GOOGLE_REDIRECT=http://localhost:8000/login/google/callback

FACEBOOK_CLIENT_ID=tu_client_id
FACEBOOK_CLIENT_SECRET=tu_client_secret
FACEBOOK_REDIRECT=http://localhost:8000/login/facebook/callback
Asegúrate de obtener las credenciales adecuadas al configurar las APIs de autenticación en las plataformas de Google y Facebook.

Generar clave de la aplicación

Ejecuta el siguiente comando para generar una clave única de la aplicación:

vbnet
Copy code
php artisan key:generate
Ejecutar migraciones y seeders

A continuación, deberás ejecutar las migraciones de la base de datos y los seeders para crear las tablas y los datos iniciales necesarios:

css
Copy code
php artisan migrate --seed
Iniciar el servidor de desarrollo

Finalmente, puedes iniciar el servidor de desarrollo de Laravel ejecutando el siguiente comando:

Copy code
php artisan serve
El servidor se ejecutará en http://localhost:8000. Puedes acceder a esta URL en tu navegador para ver el marketplace en acción.

¡Listo! Ahora tienes el marketplace Laravel funcionando en tu entorno local. Puedes personalizar y expandir el proyecto según tus necesidades específicas.