<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
/**********************************************************************/
/* Website */
/**********************************************************************/
$routes->get('/', 'Home::index');
$routes->post('solicitar_informacion', 'Home::solicitar_informacion');
$routes->post('contador_visitas', 'Home::contador_visitas');
$routes->get('promociones', 'Home::promociones');

$routes->get('list_degree', 'AdminDegreeController::list_degree');

// Footer
$routes->get('sitios-interes', 'Home::sitios_interes');
$routes->get('terminos-y-condiciones', 'Home::terminos_condiciones');
$routes->get('aviso-de-privacidad', 'Home::aviso_privacidad');
$routes->get('clinica-psicoterapeutica', 'Home::clinica_psicoterapeutica');

// Educative offer
$routes->get('oferta-educativa', 'DegreeController::oferta_educativa');

// Degree Programs
$routes->get('licenciaturas', 'DegreeController::licenciaturas');
$routes->get('maestrias', 'DegreeController::maestrias');
$routes->get('doctorados', 'DegreeController::doctorados');
$routes->get('bachillerato', 'DegreeController::bachillerato');

// Scholarship & Agreements
$routes->get('becas-y-convenios', 'Home::becasconvenios');

// School Campus
$routes->get('planteles', 'Home::planteles');

// Parkinson
$routes->get('parkinson', 'Home::parkinson');

// Magazine Thanatos
$routes->get('revista-thanatos', 'Home::revista_thanatos');
$routes->get('revista-thanatos/revista/(:any)', 'Home::revista_show/$1');

// Contact
$routes->get('contacto', 'Home::contacto');
$routes->post('enviar_contacto', 'Home::enviar_contacto');



/**********************************************************************/
/* Admin */
/**********************************************************************/
$routes->get('panel', 'Home::admin');
$routes->get('panel/home', 'Home::dashboard');

// Login
$routes->post('admin/login', 'UserController::login');
$routes->get('admin/logout', 'UserController::logout');

// Users
// $routes->get('/users/create', 'UserController::crear_usuario');
// $routes->get('/users/testpass', 'UserController::test_pass');
// $routes->post('/users/update', 'UserController::update');
// $routes->post('/users/delete', 'UserController::delete');

// Ordenes
$routes->get('panel/ordenes/activas', 'OrdenesController::ordenes_activas');
$routes->get('panel/ordenes/finalizadas', 'OrdenesController::ordenes_finalizadas');
$routes->get('panel/ordenes/canceladas', 'OrdenesController::ordenes_canceladas');
$routes->get('uploads/(:segment)/(:any)', 'FileController::serveFile/$1/$2');

// Reportes
$routes->get('panel/reportes/ver-reporte', 'ReportesController::ver_reporte');

// Categorias
$routes->get('categorias', 'CategoriasController::lista');
$routes->get('categorias/(:num)', 'CategoriasController::busca/$1');
$routes->post('categorias/agrega', 'CategoriasController::agrega');
$routes->post('categorias/edita', 'CategoriasController::edita');
$routes->post('categorias/activa', 'CategoriasController::activa');
$routes->post('categorias/desactiva', 'CategoriasController::desactiva');

// Subcategorias
$routes->get('subcategorias', 'SubcategoriasController::lista');
$routes->get('subcategorias/(:num)', 'SubcategoriasController::busca/$1');
$routes->post('subcategorias/agrega', 'SubcategoriasController::agrega');
$routes->post('subcategorias/edita', 'SubcategoriasController::edita');
$routes->post('subcategorias/activa', 'SubcategoriasController::activa');
$routes->post('subcategorias/desactiva', 'SubcategoriasController::desactiva');

// Clientes
$routes->get('panel/clientes/ver-clientes', 'ClientesController::ver_clientes');
$routes->get('panel/clientes/info/(:num)', 'ClientesController::info/$1');
$routes->post('panel/clientes/cambiar_tipo_usuario', 'ClientesController::cambiar_tipo_usuario');



// Degree 
$routes->post('panel/degree/list', 'AdminDegreeController::list');
$routes->post('panel/degree/academic_degree', 'AdminDegreeController::academic_degree');

// Events
$routes->get('panel/events', 'AdminEventsController::events');
$routes->post('panel/events/add', 'AdminEventsController::add');
$routes->post('panel/events/upd', 'AdminEventsController::upd');
$routes->post('panel/events/del', 'AdminEventsController::del');

// Events
$routes->post('panel/events/list', 'AdminEventsController::list');

// Password
$routes->get('panel/password', 'UserController::password');
$routes->post('panel/password/upd', 'UserController::upd_pass');

$routes->get('(:any)', 'DegreeController::oferta_show');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
