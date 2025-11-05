<?php 

$menu1 = ''; // inicio

$menu2 = ''; // oferta educativa

$menu2_1 = ''; // licenciatura
$menu2_1_1 = ''; // lic_psicopedagogia
$menu2_1_2 = ''; // lic_gerontologia
$menu2_1_3 = ''; // lic_psicologia
$menu2_1_4 = ''; // lic_trabajosocial
$menu2_1_5 = ''; // lic_derecho
$menu2_1_6 = ''; // lic_administracionfinanzas
$menu2_1_7 = ''; // lic_informaticaadministrativa
$menu2_1_8 = ''; // lic_cienciascomunicacion

$menu2_2 = ''; // maestrías
$menu2_2_1 = ''; // mae_tanatologia
$menu2_2_2 = ''; // mae_psicoterapia
$menu2_2_3 = ''; // mae_psicooncologia
$menu2_2_4 = ''; // mae_derechofamiliar
$menu2_2_5 = ''; // mae_derechopenal
$menu2_2_6 = ''; // mae_comercioexterior
$menu2_2_7 = ''; // mae_educacion
$menu2_2_8 = ''; // mae_evaluacioneducativa
$menu2_2_9 = ''; // mae_estudiossuicidio

$menu2_3 = ''; // doctorados
$menu2_3_1 = ''; // doc_tanatologia

$menu2_4 = ''; // bachilleratos
$menu2_4_1 = ''; // bac_administracionrh
$menu2_4_2 = ''; // bac_contabilidad
$menu2_4_3 = ''; // bac_trabajosocial
$menu2_4_4 = ''; // bac_programacion

$menu3 = ''; // bacas y convenios
$menu4 = ''; // planteles
$menu5 = ''; // parkinson
$menu6 = ''; // revista thanatos
$menu7 = ''; // acceso alumnos
$menu8 = ''; // contacto
$menu9 = ''; // promociones

if(isset($menu) && !empty($menu)){

  switch($menu){

    case 'inicio':
      $menu1 = 'active';
    break;

    case 'lic_psicopedagogia':
      $menu2 = 'active';
      $menu2_1 = 'active';
      $menu2_1_1 = 'active';
    break;

    case 'lic_gerontologia':
      $menu2 = 'active';
      $menu2_1 = 'active';
      $menu2_1_2 = 'active';
    break;

    case 'lic_psicologia':
      $menu2 = 'active';
      $menu2_1 = 'active';
      $menu2_1_3 = 'active';
    break;

    case 'lic_trabajosocial':
      $menu2 = 'active';
      $menu2_1 = 'active';
      $menu2_1_4 = 'active';
    break;

    case 'lic_derecho':
      $menu2 = 'active';
      $menu2_1 = 'active';
      $menu2_1_5 = 'active';
    break;

    case 'lic_administracionfinanzas':
      $menu2 = 'active';
      $menu2_1 = 'active';
      $menu2_1_6 = 'active';
    break;

    case 'lic_informaticaadministrativa':
      $menu2 = 'active';
      $menu2_1 = 'active';
      $menu2_1_7 = 'active';
    break;

    case 'lic_cienciascomunicacion':
      $menu2 = 'active';
      $menu2_1 = 'active';
      $menu2_1_8 = 'active';
    break;


    case 'mae_tanatologia':
      $menu2 = 'active';
      $menu2_2 = 'active';
      $menu2_2_1 = 'active';
    break;

    case 'mae_psicoterapia':
      $menu2 = 'active';
      $menu2_2 = 'active';
      $menu2_2_2 = 'active';
    break;

    case 'mae_psicooncologia':
      $menu2 = 'active';
      $menu2_2 = 'active';
      $menu2_2_3 = 'active';
    break;

    case 'mae_derechofamiliar':
      $menu2 = 'active';
      $menu2_2 = 'active';
      $menu2_2_4 = 'active';
    break;

    case 'mae_derechopenal':
      $menu2 = 'active';
      $menu2_2 = 'active';
      $menu2_2_5 = 'active';
    break;

    case 'mae_comercioexterior':
      $menu2 = 'active';
      $menu2_2 = 'active';
      $menu2_2_6 = 'active';
    break;

    case 'mae_educacion':
      $menu2 = 'active';
      $menu2_2 = 'active';
      $menu2_2_7 = 'active';
    break;

    case 'mae_evaluacioneducativa':
      $menu2 = 'active';
      $menu2_2 = 'active';
      $menu2_2_8 = 'active';
    break;

    case 'mae_estudiossuicidio':
      $menu2 = 'active';
      $menu2_2 = 'active';
      $menu2_2_9 = 'active';
    break;


    case 'doc_tanatologia':
      $menu2 = 'active';
      $menu2_3 = 'active';
      $menu2_3_1 = 'active';
    break;


    case 'bac_administracionrh':
      $menu2 = 'active';
      $menu2_4 = 'active';
      $menu2_4_1 = 'active';
    break;

    case 'bac_contabilidad':
      $menu2 = 'active';
      $menu2_4 = 'active';
      $menu2_4_2 = 'active';
    break;

    case 'bac_trabajosocial':
      $menu2 = 'active';
      $menu2_4 = 'active';
      $menu2_4_3 = 'active';
    break;

    case 'bac_programacion':
      $menu2 = 'active';
      $menu2_4 = 'active';
      $menu2_4_4 = 'active';
    break;


    case 'becas_convenios':
      $menu3 = 'active';
    break;

    case 'planteles':
      $menu4 = 'active';
    break;

    case 'parkinson':
      $menu5 = 'active';
    break;

    case 'revista_thanatos':
      $menu6 = 'active';
    break;

    case 'alumnos':
      $menu7 = 'active';
    break;

    case 'contacto':
      $menu8 = 'active';
    break;

    case 'promociones':
      $menu9 = 'active';
    break;

    default:
      $menu1 = 'active';
    break;
  }

}
?>
<!--Start Top Header Area-->
<div class="top-header-area">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-lg-8 col-md-8">
        <div class="header-left-content">
         
        </div>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="header-right-content">
          <div class="list">
            <div class="row">
              <div class="col-12">
                <ul>
                  <li class="d-block m-0"><a href="tel:5563931100">Plantel Montevideo: (55) 6393 1100</a></li>
                  <li class="d-block m-0"><a href="tel:5568192000">Plantel Tláhuac: (55) 6819 2000</a></li>
                  <li class="d-block m-0 pb-3"><a href="tel:5563932000">Plantel Tlalpan: (55) 6393 2000</a></li>
                </ul>
              </div>
            </div>

          </div>
          <div class="list">
            <ul>
              <li><a href="https://www.facebook.com/IMPoOficial/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
              <li><a href="https://www.instagram.com/impooficial/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
              <li><a href="https://www.youtube.com/channel/UCCmxYMZSLn7QGoyo1qFPl9A" target="_blank" title="Youtube"><img src="<?= base_url() ?>/assets/images/brands/youtube-2.png" alt="YouTube" width="16"></a></li>
              <li><a href="https://twitter.com/IMPo_Oficial/" target="_blank" title="X"><img src="<?= base_url() ?>/assets/images/brands/x-twitter.svg" width="16" alt="X" class="img-fluid filter-white"></a></li>
              <li><a href="https://radioimpo.com.mx/" target="_blank" title="Radio Impo"> <i class="fas fa-microphone"></i> <span class="fs-075">RADIO IMPo</span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--End Top Header Area-->

<!-- Start Navbar Area -->
<div class="navbar-area nav-bg-2">
  <div class="mobile-responsive-nav">
    <div class="container">
      <div class="mobile-responsive-menu">
        <div class="logo">
          <a href="/">
            <img src="<?= base_url() ?>/assets/images/logo_impo_web.webp" class="main-logo img-fluid" alt="logo" width="180">
            <img src="<?= base_url() ?>/assets/images/logo_impo_web.webp" class="white-logo img-fluid" alt="logo" width="180">
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="desktop-nav">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-md navbar-light">
        <a class="navbar-brand" href="/">
          <img src="<?= base_url() ?>/assets/images/logo_impo_web.webp" class="main-logo img-fluid" alt="logo" width="180">
          <img src="<?= base_url() ?>/assets/images/logo_impo_web.webp" class="white-logo img-fluid" alt="logo" width="180">
        </a>
        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a href="/" class="nav-link <?= $menu1; ?>">Inicio</a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link dropdown-toggle <?= $menu2; ?>">
                Oferta Educativa
              </a>

              <ul class="dropdown-menu">
                <li class="nav-item">
                  <a href="#" class="nav-link dropdown-toggle <?= $menu2_1; ?>">
                    Licenciaturas
                  </a>

                  <ul class="dropdown-menu">
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/licenciatura-en-psicopedagogia" class="nav-link <?= $menu2_1_1; ?>">Psicopedagogía</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/licenciatura-en-gerontologia" class="nav-link <?= $menu2_1_2; ?>">Gerontología</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/licenciatura-en-psicologia" class="nav-link <?= $menu2_1_3; ?>">Psicología</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/licenciatura-en-trabajosocial" class="nav-link <?= $menu2_1_4; ?>">Trabajo Social</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/licenciatura-en-derecho" class="nav-link <?= $menu2_1_5; ?>">Derecho</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/licenciatura-en-administracion-y-finanzas" class="nav-link <?= $menu2_1_6; ?>">Administración y Finanzas</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/licenciatura-en-informatica-administrativa" class="nav-link <?= $menu2_1_7; ?>">Informática Administrativa</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/licenciatura-en-ciencias-de-la-comunicacion" class="nav-link <?= $menu2_1_8; ?>">Ciencias de la Comunicación</a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item">
                  <a href="#" class="nav-link dropdown-toggle <?= $menu2_2; ?>">
                    Maestrías
                  </a>

                  <ul class="dropdown-menu">
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/maestria-en-tanatologia" class="nav-link <?= $menu2_2_1; ?>">Tanatología</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/maestria-en-psicoterapia-transpersonal-integrativa" class="nav-link <?= $menu2_2_2; ?>">Psicoterapia Transpersonal Integrativa</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/maestria-en-psicooncologia" class="nav-link <?= $menu2_2_3; ?>">Psicooncología</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/maestria-en-derecho-familiar" class="nav-link <?= $menu2_2_4; ?>">Derecho Familiar</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/maestria-en-derecho-penal" class="nav-link <?= $menu2_2_5; ?>">Derecho Penal</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/maestria-en-comercio-exterior" class="nav-link <?= $menu2_2_6; ?>">Comercio Exterior</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/maestria-en-educacion" class="nav-link <?= $menu2_2_7; ?>">Educación</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/maestria-en-evaluacion-educativa" class="nav-link <?= $menu2_2_8; ?>">Evaluación Educativa</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/maestria-en-estudios-del-suicidio" class="nav-link <?= $menu2_2_9; ?>">Estudios del Suicidio</a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item">
                  <a href="#" class="nav-link dropdown-toggle <?= $menu2_3; ?>">
                    Doctorado
                  </a>

                  <ul class="dropdown-menu">
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/doctorado-en-tanatologia" class="nav-link <?= $menu2_3_1; ?>">Tanatología</a>
                    </li>
                 </ul>
                </li>

                <li class="nav-item">
                  <a href="#" class="nav-link dropdown-toggle <?= $menu2_4; ?>">
                    Bachillerato 
                  </a>

                  <ul class="dropdown-menu">
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/tecnico-en-administracion-de-recursos-humanos" class="nav-link <?= $menu2_4_1; ?>">Técnico en Administración de Recursos Humanos</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/tecnico-en-contabilidad" class="nav-link <?= $menu2_4_2; ?>">Técnico en Contabilidad</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/tecnico-en-trabajo-social" class="nav-link <?= $menu2_4_3; ?>">Técnico en Trabajo Social</a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url() ?>/tecnico-en-programacion" class="nav-link <?= $menu2_4_4; ?>">Técnico en Programación</a>
                    </li>
                 </ul>
                </li>

              </ul>
            </li>

            <li class="nav-item">
              <a href="<?= base_url() ?>/becas-y-convenios" class="nav-link <?= $menu3; ?>">Becas por Convenio</a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url() ?>/planteles" class="nav-link <?= $menu4; ?>">Planteles</a>
            </li>

            <!--
            <li class="nav-item">
              <a href="<?= base_url() ?>/parkinson" class="nav-link <?= $menu5; ?>">Parkinson</a>
            </li>
            -->
            <!--
            <li class="nav-item">
              <a href="#" class="nav-link dropdown-toggle <?= $menu6; ?>">
                Revista Thanatos
              </a>

              <ul class="dropdown-menu">
                <li class="nav-item">
                  <a href="<?= base_url() ?>/revista-thanatos" class="nav-link <?= $menu6; ?>">Revista Thanatos</a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url() ?>/catalogo_revista/Catalogo_Revista_Thanatos.pdf" class="nav-link" target="_blank">Catálogo Revista Thanatos</a>
                </li>
              </ul>
            </li>
            -->

            <li class="nav-item">
              <a href="<?= base_url() ?>/promociones" class="nav-link <?= $menu9; ?>">Promociones</a>
            </li>

            <!--
            <li class="nav-item">
              <a href="#" class="nav-link <?= $menu7; ?>">Acceso Alumnos</a>
            </li>
            -->

            <li class="">
              <a href="<?= base_url() ?>/contacto" class="nav-link">
                <div class="btn btn-secondary bg-green border-green <?= $menu8; ?>">Contacto</div>
              </a>
            </li>
          </ul>

          <div class="others-options">
            <div class="icon">
              <i class="ri-menu-3-fill" onclick="modalGetInfo('sidebarModal','get')"></i>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </div>

  <div class="others-option-for-responsive">
    <div class="container">
      <div class="dot-menu">
        <div class="inner">
          <div class="icon">
            <i class="ri-menu-3-fill" onclick="modalGetInfo('sidebarModal','get')"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Navbar Area -->