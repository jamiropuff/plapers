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
// Home
$routes->get('/', 'Home::index');
//Se cciones
$routes->get('/web/acerca_de', 'Home::acerca_de');
$routes->get('/web/galeria', 'Home::galeria');
$routes->get('/web/faqs', 'Home::faqs');
$routes->get('/web/contacto', 'Home::contacto');

// Tienda
$routes->get('/placas/tienda', 'Placas::tienda');
$routes->get('/placas/americana', 'Placas::americana');
$routes->get('/placas/europea', 'Placas::europea');
$routes->get('/placas/bicicleta', 'Placas::bicicleta');
$routes->get('/placas/euromini', 'Placas::euromini');
$routes->get('/accesorios', 'Placas::accesorios');


// Footer
$routes->get('aviso-de-privacidad', 'Home::aviso_privacidad');


// Contact
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
$routes->get('panel/usuarios/user', 'UserController::ver_usuarios');
$routes->get('panel/usuarios/staff', 'UserController::ver_usuarios');
$routes->post('panel/usuarios/lista', 'UserController::usuariosJSON');
// $routes->get('/users/create', 'UserController::crear_usuario');
// $routes->get('/users/testpass', 'UserController::test_pass');
// $routes->post('/users/update', 'UserController::update');
// $routes->post('/users/delete', 'UserController::delete');

// Ordenes
$routes->get('panel/ordenes/activas', 'OrdenesController::ordenes_activas');
$routes->get('panel/ordenes/lista_activas', 'OrdenesController::ordenes_activasJSON');
$routes->get('panel/ordenes/orden/(:num)', 'OrdenesController::orden/$1');
$routes->get('panel/ordenes/productos/(:num)', 'OrdenesController::productos/$1');
$routes->get('panel/ordenes/finalizadas', 'OrdenesController::ordenes_finalizadas');
$routes->post('panel/ordenes/lista_finalizadas', 'OrdenesController::ordenes_finalizadasJSON');
$routes->post('panel/ordenes/lista_canceladas', 'OrdenesController::ordenes_canceladasJSON');
$routes->get('panel/ordenes/canceladas', 'OrdenesController::ordenes_canceladas');
$routes->get('uploads/(:segment)/(:any)', 'FileController::serveFile/$1/$2');

// Reportes
$routes->get('panel/reportes/ver-reporte', 'ReportesController::ver_reporte');
$routes->get('panel/reportes/lista', 'ReportesController::reporteJSON');

// Clientes
$routes->get('panel/clientes/ver-clientes', 'ClientesController::ver_clientes');
$routes->get('panel/clientes/lista', 'ClientesController::listaJSON');
$routes->get('panel/clientes/info/(:num)', 'ClientesController::info/$1');
$routes->post('panel/clientes/cambiar_tipo_usuario', 'ClientesController::cambiar_tipo_usuario');

// Suscritos al boletín
$routes->get('panel/boletin/suscritos', 'BoletinesController::lista_suscritos');

// Categorias
$routes->get('panel/catalogos/categorias', 'CategoriasController::lista');
$routes->get('panel/catalogos/categorias/lista', 'CategoriasController::listaJSON');
$routes->get('panel/catalogos/categorias/(:num)', 'CategoriasController::busca/$1');
$routes->post('panel/catalogos/categorias/agrega', 'CategoriasController::agrega');
$routes->post('panel/catalogos/categorias/edita', 'CategoriasController::edita');
$routes->post('panel/catalogos/categorias/activa', 'CategoriasController::activa');
$routes->post('panel/catalogos/categorias/desactiva', 'CategoriasController::desactiva');

// Subcategorias
$routes->get('panel/catalogos/subcategorias', 'SubcategoriasController::lista');
$routes->get('panel/catalogos/subcategorias/lista', 'SubcategoriasController::listaJSON');
$routes->get('panel/catalogos/subcategorias/(:num)', 'SubcategoriasController::busca/$1');
$routes->post('panel/catalogos/subcategorias/agrega', 'SubcategoriasController::agrega');
$routes->post('panel/catalogos/subcategorias/edita', 'SubcategoriasController::edita');
$routes->post('panel/catalogos/subcategorias/activa', 'SubcategoriasController::activa');
$routes->post('panel/catalogos/subcategorias/desactiva', 'SubcategoriasController::desactiva');

// Productos
$routes->get('panel/catalogos/productos', 'ProductosController::lista');
$routes->get('panel/catalogos/productos/lista', 'ProductosController::listaJSON');
$routes->get('panel/catalogos/productos/(:num)', 'ProductosController::busca/$1');
$routes->post('panel/catalogos/productos/agrega', 'ProductosController::agrega');
$routes->post('panel/catalogos/productos/edita', 'ProductosController::edita');
$routes->post('panel/catalogos/productos/activa', 'ProductosController::activa');
$routes->post('panel/catalogos/productos/desactiva', 'ProductosController::desactiva');



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
