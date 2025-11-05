<?php
$menu0 = ''; // dashboard
$menu1 = ''; // prospectos
$menu2 = ''; // oferta educativa
$menu3 = ''; // eventos
$menu4 = ''; // cambiar constraseña
$title = '';
switch ($title) {
  /*
  case 'Dashboard':
    $menu0 = 'active';
  break;
  */
  case 'Prospectos de Formularios':
    $menu1 = 'active';
    break;

  case 'Oferta Educativa':
    $menu2 = 'active';
    break;

  case 'Eventos':
    $menu3 = 'active';
    break;

  case 'Eventos':
    $menu3 = 'active';
    break;

  case 'Cambiar Contraseña':
    $menu4 = 'active';
    break;

  default:
    $menu1 = 'active';
    break;
}
?>

<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin6">
  <!-- Sidebar scroll-->
  <div class="scroll-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav mb-5">
      <ul id="sidebarnav">
        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="index.html"
            aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
              class="hide-menu">Dashboard</span></a></li>

        <li class="list-divider"></li>

        <li class="nav-small-cap"><span class="hide-menu">Órdenes</span></li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="ticket-list.html" aria-expanded="false">
            <i class="fa-solid fa-file-invoice"></i></i><span class="hide-menu">Activas</span>
          </a>
        </li>
        <li class="sidebar-item"> 
          <a class="sidebar-link sidebar-link" href="app-chat.html" aria-expanded="false">
            <i class="fa-solid fa-file-import"></i><span class="hide-menu">Finalizadas</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link sidebar-link" href="app-calendar.html" aria-expanded="false">
            <i class="fa-solid fa-file-contract"></i><span class="hide-menu">Canceladas</span>
          </a>
        </li>

        <li class="list-divider"></li>

        <li class="nav-small-cap"><span class="hide-menu">Reportes</span></li>
        <li class="sidebar-item">
          <a class="sidebar-link sidebar-link" href="ui-cards.html" aria-expanded="false">
            <i class="fa-solid fa-file-invoice-dollar"></i></i><span class="hide-menu">Ver Reporte</span>
          </a>
        </li>

        <li class="list-divider"></li>

        <li class="nav-small-cap"><span class="hide-menu">Clientes</span></li>

        <li class="sidebar-item">
          <a class="sidebar-link sidebar-link" href="authentication-login1.html" aria-expanded="false">
            <i class="fa-solid fa-users"></i><span class="hide-menu">Ver Clientes</span>
          </a>
        </li>


        <li class="list-divider"></li>

        <li class="nav-small-cap"><span class="hide-menu">Boletín</span></li>
        <li class="sidebar-item">
          <a class="sidebar-link sidebar-link" href="authentication-login1.html" aria-expanded="false">
            <i class="fa-solid fa-envelope-open-text"></i><span class="hide-menu">Sucritos</span>
          </a>
        </li>

        <li class="list-divider"></li>

        <li class="nav-small-cap"><span class="hide-menu">Catálogos</span></li>
        <li class="sidebar-item">
          <a class="sidebar-link sidebar-link" href="authentication-login1.html" aria-expanded="false">
            <i class="fa-solid fa-list"></i><span class="hide-menu">Categorías</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link sidebar-link" href="authentication-login1.html" aria-expanded="false">
            <i class="fa-solid fa-table-cells"></i><span class="hide-menu">Subcategorías</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link sidebar-link" href="authentication-login1.html" aria-expanded="false">
            <i class="fa-solid fa-layer-group"></i><span class="hide-menu">Productos</span>
          </a>
        </li>

        <li class="list-divider"></li>

        <li class="nav-small-cap"><span class="hide-menu">Usuarios</span></li>
        <li class="sidebar-item">
          <a class="sidebar-link sidebar-link" href="authentication-login1.html" aria-expanded="false">
            <i class="fa-solid fa-users-gear"></i><span class="hide-menu">Ver Usuarios</span>
          </a>
        </li>

      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">