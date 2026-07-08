<?php

// $menu1 = ''; // inicio
// $menu6 = ''; // becas_convenio
// $menu7 = ''; // planteles
// $menu8 = ''; // contacto

// //echo "<pre>", var_dump($menu_oferta), "</pre>";

// $menu_bachillerato = [];
// $menu_licenciatura = [];
// $menu_maestria = [];
// $menu_doctorado = [];

// foreach ($menu_oferta as $menus){

//   //echo "grado_academico: ".$menus->id_grado_academico."<br>";

//   // Bachillerato
//   if( isset($menus->id_grado_academico) && $menus->id_grado_academico == 1 ){

//     $menu_bachillerato[] = array(
//       'grado_academico'=>'bachillerato', 
//       "oferta_educativa"=>$menus->oferta_educativa,
//       "titulo_menu"=>$menus->titulo_menu
//     );

//   } // end if

//   // Licenciaturas
//   if( isset($menus->id_grado_academico) && $menus->id_grado_academico == 2 ){

//     $menu_licenciatura[] = array(
//       'grado_academico'=>'licenciaturas', 
//       "oferta_educativa"=>$menus->oferta_educativa,
//       "titulo_menu"=>$menus->titulo_menu
//     );

//   } // end if

//   // Maestrías
//   if( isset($menus->id_grado_academico) && $menus->id_grado_academico == 3 ){

//     $menu_maestria[] = array(
//       'grado_academico'=>'maestrias', 
//       "oferta_educativa"=>$menus->oferta_educativa,
//       "titulo_menu"=>$menus->titulo_menu
//     );

//   } // end if

//   // Doctorados
//   if( isset($menus->id_grado_academico) && $menus->id_grado_academico == 4 ){

//     $menu_doctorado[] = array(
//       'grado_academico'=>'doctorados', 
//       "oferta_educativa"=>$menus->oferta_educativa,
//       "titulo_menu"=>$menus->titulo_menu
//     );

//   } // end if


// } // end foreach


// if(isset($menu) && !empty($menu)){

//   switch($menu){

//     case 'inicio':
//       $menu1 = 'active';
//     break;

//     case 'becas_convenios':
//       $menu6 = 'active';
//     break;

//     case 'planteles':
//       $menu7 = 'active';
//     break;

//     case 'contacto':
//       $menu8 = 'active';
//     break;

//   }

// }
?>
<!-- Header area start here -->
<div class="top__header py-3" style="background-color: #000000;">
    <div class="container-fluid px-4 px-lg-5">
        <div class="top__wrapper d-flex justify-content-between align-items-center gap-4">
            <a href="<?= base_url() ?>/index.php" class="brand-logo">
                <img src="<?= base_url() ?>/assets/images/logo-plapers/logo-plapers.svg" alt="logo Plapers" class="navbar-logo-img">
            </a>

            <!-- Centered Desktop Menu -->
            <div class="header-wrapper-desktop d-lg-flex d-none">
                <ul class="main-menu-desktop d-flex align-items-center mb-0 list-unstyled gap-3 gap-xl-4 flex-wrap justify-content-center">
                    <li>
                        <a href="<?= base_url() ?>" class="nav-inicio-link">INICIO</a>
                    </li>
                    <li>
                        <a href="web/tienda">TIENDA</a>
                    </li>
                    <li>
                        <a href="web/acerca_de">NOSOTROS</a>
                    </li>
                    <li>
                        <a href="#">GALERÍA</a>
                    </li>
                    <li>
                        <a href="#">FAQS</a>
                    </li>
                    <li>
                        <a href="#">CONTACTO</a>
                    </li>
                </ul>
            </div>

            <!-- Right Icons -->
            <div class="account__wrap d-flex align-items-center">
                <div class="account d-flex d-lg-none align-items-center">
                    <div class="user__icon">
                        <a href="#0">
                            <i class="fa-regular fa-user"></i>
                        </a>
                    </div>
                </div>
                <div class="d-none d-lg-flex align-items-center gap-4">
                    <div class="user__icon">
                        <a href="#0" class="text-white fs-5">
                            <i class="fa-regular fa-user"></i>
                        </a>
                    </div>
                    <div class="cart__icon position-relative">
                        <a href="#0" class="text-white fs-5">
                            <i class="fa-regular fa-cart-shopping"></i>
                            <span class="cart-badge-dot">0</span>
                        </a>
                    </div>
                </div>
                <div class="cart d-flex d-lg-none align-items-center">
                    <span class="cart__icon position-relative">
                        <i class="fa-regular fa-cart-shopping"></i>
                        <span class="cart-badge-dot">0</span>
                    </span>
                </div>
                <!-- Mobile Hamburger Menu -->
                <div class="header-bar d-lg-none ms-3" style="margin-left: 10px; cursor: pointer;">
                    <i class="fa-regular fa-bars text-white fs-5"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<header class="header-section d-lg-none">
    <div class="container">
        <div class="header-wrapper">
            <!-- header-bar moved to top__header -->
            <ul class="main-menu">
                <li>
                    <a href="#0">TIENDA <i class="fa-regular fa-angle-down"></i></a>
                    <ul class="sub-menu">
                        <li class="subtwohober">
                            <a href="placa-americana.php">
                                Placa Americana
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="#">
                                Placa Europea
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="#">
                                Placa Euromini
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="#">
                                Placa Bicicleta
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="#">
                                Accesorios
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="web/acerca_de">NOSOTROS</a>
                </li>
                <li>
                    <a href="#">GALERÍA</a>
                </li>
                <li>
                    <a href="#">FAQ</a>
                </li>
                <li>
                    <a href="#">CONTACTO</a>
                </li>
            </ul>
        </div>
    </div>

</header>
<!-- Header area end here -->

<!-- Preloader area start -->
<div class="loading">
    <span class="text-capitalize">L</span>
    <span>o</span>
    <span>a</span>
    <span>d</span>
    <span>i</span>
    <span>n</span>
    <span>g</span>
</div>

<div id="preloader">
</div>
<!-- Preloader area end -->

<!-- Mouse cursor area start here -->
<div class="mouse-cursor cursor-outer"></div>
<div class="mouse-cursor cursor-inner"></div>
<!-- Mouse cursor area end here -->

<main>