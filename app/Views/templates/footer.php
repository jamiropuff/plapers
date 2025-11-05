</main>

<?php
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
?>

    <!-- Footer area start here -->
    <footer class="footer-area bg-image" data-background="<?= base_url() ?>/assets/images/footer/footer-bg.jpg">
        <div class="container">
            <div class="footer__wrp pt-65 pb-65 bor-top bor-bottom">
                <div class="row g-4">
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="1.1s" data-wow-delay=".1s">
                        <div class="footer__item">
                            <h4 class="footer-title">Customer Service</h4>
                            <ul>
                                <li><a href="contact.html"><span></span>Help Portal</a></li>
                                <li><a href="contact.html"><span></span>Contact Us</a></li>
                                <li><a href="error.html"><span></span>Delivery Information</a></li>
                                <li><a href="error.html"><span></span>Click and Collect</a></li>
                                <li><a href="error.html"><span></span>Refunds and Returns</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">
                        <div class="footer__item">
                            <h4 class="footer-title">Get to Know Us</h4>
                            <ul>
                                <li><a href="about.html"><span></span>About Us</a></li>
                                <li><a href="blog-grid.html"><span></span>News & Blog</a></li>
                                <li><a href="error.html"><span></span>Careers</a></li>
                                <li><a href="error.html"><span></span>Investors</a></li>
                                <li><a href="contact.html"><span></span>Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="1.3s" data-wow-delay=".3s">
                        <div class="footer__item">
                            <h4 class="footer-title">vapes new collections</h4>
                            <ul>
                                <li><a href="shop.html"><span></span>E-Cigarettes</a></li>
                                <li><a href="shop.html"><span></span>Vape Pens</a></li>
                                <li><a href="shop.html"><span></span>Pod Systems</a></li>
                                <li><a href="shop.html"><span></span>Disposable Vapes</a></li>
                                <li><a href="shop.html"><span></span>Nicotine Salt Devices</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s">
                        <div class="footer__item newsletter">
                            <h4 class="footer-title">get newsletter</h4>
                            <div class="subscribe">
                                <input type="email" placeholder="Your Email">
                                <button><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                            <div class="social-icon mt-40">
                                <a href="#0"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#0"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#0"><i class="fa-brands fa-linkedin-in"></i></a>
                                <a href="#0"><i class="fa-brands fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__copy-text pt-50 pb-50">
                <a href="index.html" class="logo d-block">
                    <img src="<?= base_url() ?>/assets/images/logo/logo.svg" alt="logo">
                </a>
                <p>&copy; Copyright 2023 <a href="#0" class="primary-hover">odor</a> All Rights Reserved</p>
                <a href="#0" class="payment d-block image">
                    <img src="<?= base_url() ?>/assets/images/icon/payment.png" alt="icon">
                </a>
            </div>
        </div>
    </footer>
    <!-- Footer area end here -->

    <!-- Back to top area start here -->
    <div class="scroll-up">
        <svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Back to top area end here -->

    <!-- Jquery 3. 7. 1 Min Js -->
    <script src="<?= base_url() ?>/assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap min Js -->
    <script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
    <!-- Swiper bundle min Js -->
    <script src="<?= base_url() ?>/assets/js/swiper-bundle.min.js"></script>
    <!-- Counterup min Js -->
    <script src="<?= base_url() ?>/assets/js/jquery.counterup.min.js"></script>
    <!-- Wow min Js -->
    <script src="<?= base_url() ?>/assets/js/wow.min.js"></script>
    <!-- Magnific popup min Js -->
    <script src="<?= base_url() ?>/assets/js/magnific-popup.min.js"></script>
    <!-- Nice select min Js -->
    <script src="<?= base_url() ?>/assets/js/nice-select.min.js"></script>
    <!-- Pace min Js -->
    <script src="<?= base_url() ?>/assets/js/pace.min.js"></script>
    <!-- Isotope pkgd min Js -->
    <script src="<?= base_url() ?>/assets/js/isotope.pkgd.min.js"></script>
    <!-- Waypoints Js -->
    <script src="<?= base_url() ?>/assets/js/jquery.waypoints.js"></script>
    <!-- Script Js -->
    <script src="<?= base_url() ?>/assets/js/script.js"></script>