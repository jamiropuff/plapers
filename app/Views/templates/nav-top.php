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
<div class="top__header pt-30 pb-30">
    <div class="container">
        <div class="top__wrapper">
            <a href="index.html" class="main__logo">
                <img src="<?= base_url() ?>/assets/images/logo/logo.svg" alt="logo__image">
            </a>
            <div class="search__wrp">
                <input placeholder="Search for" aria-label="Search">
                <button><i class="fa-solid fa-search"></i></button>
            </div>
            <div class="account__wrap">
                <div class="account d-flex align-items-center">
                    <div class="user__icon">
                        <a href="#0">
                            <i class="fa-regular fa-user"></i>
                        </a>
                    </div>
                    <a href="#0" class="acc__cont">
                        <span>
                            My Account
                        </span>
                    </a>
                </div>
                <div class="cart d-flex align-items-center">
                    <span class="cart__icon">
                        <i class="fa-regular fa-cart-shopping"></i>
                    </span>
                    <a href="#0" class="c__one">
                        <span>
                            $0.00
                        </span>
                    </a>
                    <span class="one">
                        0
                    </span>
                </div>
                <div class="flag__wrap">
                    <div class="flag">
                        <img src="<?= base_url() ?>/assets/images/flag/us.png" alt="flag">
                    </div>
                    <select name="flag">
                        <option value="0">
                            Usa
                        </option>
                        <option value="1">
                            Canada
                        </option>
                        <option value="2">
                            Australia
                        </option>
                        <option value="3">
                            Germany
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<header class="header-section">
    <div class="container">
        <div class="header-wrapper">
            <div class="header-bar d-lg-none">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="main-menu">
                <li>
                    <a href="#0">Home <i class="fa-regular fa-angle-down"></i></a>
                    <ul class="sub-menu">
                        <li class="subtwohober">
                            <a href="index.html">
                                Home One
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="index-light.html">
                                Home One Light
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="index-2.html">
                                Home Two
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="index-2-light.html">
                                Home Two Light
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="about.html">About Us</a>
                </li>
                <li>
                    <a href="#0">Pages <i class="fa-regular fa-angle-down"></i></a>
                    <ul class="sub-menu">
                        <li class="subtwohober">
                            <a href="shop.html">
                                Shop Leftbar
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="shop-2.html">
                                Shop Rightbar
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="shop-single.html">
                                Shop Single
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="cart.html">
                                Cart Page
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="checkout.html">
                                Checkout Page
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="register.html">
                                Register
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="login.html">
                                Login
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="error.html">
                                404 Error
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#0">Blog <i class="fa-regular fa-angle-down"></i></a>
                    <ul class="sub-menu">
                        <li class="subtwohober">
                            <a href="blog.html">
                                Blog Stander
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="blog-grid.html">
                                Blog Grid
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="blog-list.html">
                                Blog List
                            </a>
                        </li>
                        <li class="subtwohober">
                            <a href="blog-single.html">
                                Blog Single
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="contact.html">Contact Us</a>
                </li>
            </ul>
            <div class="shipping__item d-none d-sm-flex align-items-center">
                <div class="menu__right d-flex align-items-center">
                    <div class="thumb">
                        <img src="<?= base_url() ?>/assets/images/flag/picking.png" alt="image">
                    </div>
                    <div class="content">
                        <p>
                            Picking up?
                        </p>
                        <div class="items">
                            <select class="form__select p-0">
                                <option value="1">
                                    Select Store
                                </option>
                                <option value="2">
                                    Store One
                                </option>
                                <option value="3">
                                    Store Two
                                </option>
                                <option value="3">
                                    Store Three
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="menu__right d-flex align-items-center">
                    <div class="thumb">
                        <img src="<?= base_url() ?>/assets/images/flag/shipping.png" alt="image">
                    </div>
                    <div class="content">
                        <p>
                            Free Shipping <br> on order <strong>over $100</strong>
                        </p>
                    </div>
                </div>
            </div>
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