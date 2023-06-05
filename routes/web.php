<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', 'HomeController@index');

Route::get('sitemapxml', 'HomeController@generatesitemap');

Route::get('novedades', "NotaController@index");
Route::get('republica-dominicana/empleos', 'OfertasLaborales@index');
Route::get('auth/validate_account/{email}/{token}', 'Auth\UserController@validate_account');
Route::get('validate/{status}', 'Auth\UserController@validateAccount');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('lista-localidades', ['uses' => 'HomeController@listaLocalidades']);
Route::get('search', 'HomeController@search');
Route::get('filtro-search', 'SearchfiltroController@create');
Route::get('load_search', 'HomeController@search');
Route::get('drop_filtro', 'SearchfiltroController@drop_filtro');
Route::get('categoria/{id}/{slug}', 'CategoryController@index');
Route::get('filtro-category', 'SearchfiltroController@create');
Route::get('contratar/servicios', 'ServiciosController@index');

Route::get('promociones', 'HomeController@buenosprecios');
Route::get("/promociones/{condicion}/{category_id}/{orden}", 'HomeController@buenosprecios');
Route::get("/promociones/condicion/{condicion}", 'HomeController@buenosprecios');
Route::get("/promociones/categoria/{category_id}", 'HomeController@buenosprecios');
Route::get("/promociones/orden/{orden}", 'HomeController@buenosprecios');
Route::get("/promociones/condicion-{condicion}/category-{category_id}", 'HomeController@buenosprecios');
Route::get("/promociones/condicion-{condicion}/orden-{orden}", 'HomeController@buenosprecios');
Route::get("/promociones/orden-{orden}/category-{category_id}", 'HomeController@buenosprecios');

Route::get('tiendas-digitales', 'ComerciosTiendasController@index');

Route::get('contacto','HomeController@contacto');
Route::post('form-contacto','HomeController@fomcontacto');

Route::get('rd-{id}/{cat_name}/{condicion}/{title}', 'PostController@show');

Route::get("/servicios/{name}/{category_id}/{orden}", 'ServiciosController@index');
Route::get("/servicios/name/{name}", 'ServiciosController@index');
Route::get("/servicios/categoria/{category_id}", 'ServiciosController@index');
Route::get("/servicios/orden/{orden}", 'ServiciosController@index');
Route::get("/servicios/name-{name}/category-{category_id}", 'ServiciosController@index');
Route::get("/servicios/name-{name}/orden-{orden}", 'ServiciosController@index');
Route::get("/servicios/orden-{orden}/category-{category_id}", 'ServiciosController@index');
Route::get('empleo/{puesto}/{titulo}/{id}', 'OfertasLaborales@show');
Route::get('postularme/{id}/{titulo}', 'OfertasLaborales@postularme');

Route::get('tienda/{name}/{id}', 'ComerciosTiendasController@show');

Route::get('ventas-similares/{post_id}/{tittle}', 'PostController@simil');
Route::post('get-simil', 'PostController@simil');
Route::get('ayuda-y-soporte', 'LandingController@ayudaysoporte');
Route::get('publicacion-de-avisos-gratis', 'LandingController@publicagratis');
Route::get('nota/{id}/{slug}', 'NotaController@show');
Route::post('reportaraviso', 'PostController@reportes');
Route::get('todas-las-categorias', 'CategoryController@all');

Route::get('auth/{pubId}/order-image', [\App\Http\Controllers\Auth\PostImageController::class, 'order'])->name("post")->middleware('auth');
Route::post('auth/{pubId}/order-image', [\App\Http\Controllers\Auth\PostImageController::class, 'reorder'])->name("post")->middleware('auth');

Route::group(['middleware' => 'auth'], function() {
	Route::get('logout', ['uses' => 'Auth\LoginController@logout']);
	Route::get('dashboard','Auth\UserController@dashboard');
	Route::get('ventas', 'Auth\PostController@ventas');
	Route::get('vender', 'Auth\PostController@vender');
	Route::post('get-subcategory', 'Auth\PostController@lista_subcategoria');
	Route::get('get-tipos-vehiculos', 'Auth\PostController@tiposvehiculos');
	Route::post('store_ventas', 'Auth\PostController@store');
	Route::post('lista_marca', 'Auth\PostController@lista_marca');
	Route::post('getAtributos', 'Auth\PostController@getAtributos'); 
	Route::post('lista_modelos', 'Auth\PostController@lista_modelos');
	Route::get('change_status/{id}/{status}', 'Auth\PostController@change_status');
	Route::get('deletepublication/{post_id}', 'Auth\PostController@detroy');
	Route::get('publicacion/{post_id}/atributos', 'Auth\PostController@publicacionAtributos');
	Route::get('quitAtributo', 'Auth\PostController@quitAtributo');
	Route::get('publicacion/edit/{id}/{title}', 'Auth\PostController@edit');
	Route::post('update_ventas/{publicacion_id}', 'Auth\PostController@update');
	Route::get('delete_image', 'Auth\PostController@delete_image');

 
	Route::get('comercio', 'Auth\ComerciosController@index');
	Route::post('tienda-status/{id}/{status}', 'Auth\ComerciosController@status');
	Route::get('tiendas/nuevo', 'Auth\ComerciosController@create');
	Route::get('tienda-edit/{id}/{titulo}', 'Auth\ComerciosController@edit');
	Route::post('tienda_store_update', 'Auth\ComerciosController@store');
	Route::get('cuenta', 'Auth\UserController@index');

	Route::post('user_edit', 'Auth\UserController@edit');
	Route::get('interesados', 'Auth\InteresadosController@index');
	Route::get('reportar-incidencia', 'Auth\IncidenciasController@index');
	Route::post('store_incidencia', 'Auth\IncidenciasController@store');
	Route::post('interesados-consultas','InteresadosController@store');
	Route::get('autload-consultas/{pubId}','InteresadosController@autoload');
	Route::post('interesados-answered','Auth\InteresadosController@answered');
	

	Route::get('adm/ofertas-laborales', 'Auth\OfertasLaborales@index');
	Route::post('addoferta', 'Auth\OfertasLaborales@addoferta');
	Route::get('adm/oferta/{status}/{id}', 'Auth\OfertasLaborales@status');
	Route::get('adm/edit/{id}/oferta', 'Auth\OfertasLaborales@edit');
	Route::get('adm/{id}/postulantes', 'Auth\OfertasLaborales@postulantes');
	Route::post('update_oferta/{id}', 'Auth\OfertasLaborales@update');
	Route::get('adm/postulante/{postulante_id}/oferta/{oferta_id}', 'Auth\OfertasLaborales@descartar');


	Route::get('first','Auth\UserController@first');
	Route::get('deletestore/{id}/trash', 'Auth\ComerciosController@delete');
	Route::get("validateUser","Auth\UserController@emailvalidate");

	Route::group(['prefix' => 'admin'], function () {
	    Voyager::routes();
	});

});

Route::group(['prefix' => 'auth'], function () {
	Route::get('{provider}', 'Auth\LoginController@redirectToProvider') ;
	Route::get('{provider}/callback', 'Auth\LoginController@handleProviderCallback');
	Route::post('login', 'Auth\LoginController@login');
	Route::get('user/login', 'Auth\LoginController@ingresar');
	Route::get('user/register', 'Auth\RegisterController@showRegistrationForm');
});

Auth::routes();

