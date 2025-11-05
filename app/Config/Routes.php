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
$routes->post('/login', 'UserController::login');
$routes->get('/logout', 'UserController::logout');

// Users
// $routes->get('/users/create', 'UserController::crear_usuario');
// $routes->get('/users/testpass', 'UserController::test_pass');
// $routes->post('/users/update', 'UserController::update');
// $routes->post('/users/delete', 'UserController::delete');

// Prospectives
$routes->get('panel/prospectives', 'ProspectiveController::prospectives');
$routes->post('panel/prospectives/search', 'ProspectiveController::search');

// Degree
$routes->get('panel/degree', 'AdminDegreeController::degree');
$routes->post('panel/degree/add', 'AdminDegreeController::add');
$routes->get('panel/degree/edit/(:num)', 'AdminDegreeController::edit/$1');

$routes->post('panel/degree/update_info_general', 'AdminDegreeController::update_info_general');
$routes->post('panel/degree/update_banners', 'AdminDegreeController::update_banners');
$routes->post('panel/degree/update_video', 'AdminDegreeController::update_video');

$routes->post('panel/degree/insert_inscripcion', 'AdminDegreeController::insert_inscripcion');
$routes->post('panel/degree/update_inscripcion', 'AdminDegreeController::update_inscripcion');
$routes->post('panel/degree/delete_inscripcion', 'AdminDegreeController::delete_inscripcion');

$routes->post('panel/degree/insert_inversion', 'AdminDegreeController::insert_inversion');
$routes->post('panel/degree/update_inversion', 'AdminDegreeController::update_inversion');
$routes->post('panel/degree/delete_inversion', 'AdminDegreeController::delete_inversion');

$routes->post('panel/degree/insert_plantel', 'AdminDegreeController::insert_plantel');
$routes->post('panel/degree/update_plantel', 'AdminDegreeController::update_plantel');
$routes->post('panel/degree/delete_plantel', 'AdminDegreeController::delete_plantel');

$routes->post('panel/degree/insert_info_plantel', 'AdminDegreeController::insert_info_plantel');
$routes->post('panel/degree/update_info_plantel', 'AdminDegreeController::update_info_plantel');
$routes->post('panel/degree/delete_info_plantel', 'AdminDegreeController::delete_info_plantel');

$routes->post('panel/degree/insert_promocion', 'AdminDegreeController::insert_promocion');
$routes->post('panel/degree/update_promocion', 'AdminDegreeController::update_promocion');
$routes->post('panel/degree/delete_promocion', 'AdminDegreeController::delete_promocion');

$routes->post('panel/degree/insert_evento', 'AdminDegreeController::insert_evento');
$routes->post('panel/degree/update_evento', 'AdminDegreeController::update_evento');
$routes->post('panel/degree/delete_evento', 'AdminDegreeController::delete_evento');

$routes->post('panel/degree/insert_instalacion', 'AdminDegreeController::insert_instalacion');
$routes->post('panel/degree/update_instalacion', 'AdminDegreeController::update_instalacion');
$routes->post('panel/degree/delete_instalacion', 'AdminDegreeController::delete_instalacion');

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

// Promotions
//$routes->get('panel/promotions', 'PromotionsController::promotions');

$routes->get('(:any)', 'DegreeController::oferta_show');

// Brackets
// $routes->get('/brackets', 'BracketsController::brackets');
// $routes->get('/brackets/list', 'BracketsController::list_brackets');
// $routes->get('/brackets/list_phase1/(:num)', 'BracketsController::list_phase1/$1');
// $routes->post('/brackets/save', 'BracketsController::save');
// $routes->post('/brackets/update', 'BracketsController::update');
// $routes->post('/brackets/delete', 'BracketsController::delete');

//$routes->get('/login/pools', 'dashboard\LoginController::pools');

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
