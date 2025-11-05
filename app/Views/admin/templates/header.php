<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>/admin/assets/images/favicon.png">
    <title>Plapers Admin - Dashboard</title>
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>/admin/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/admin/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/admin/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Fontawesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>/admin/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div> -->
    
    <!-- <div id="loading1" class="loading-invisible" style="display:none;">
      <div class="loading-spinner">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background:none;display:block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
        <path fill="none" stroke="#191642" stroke-width="8" stroke-dasharray="32.07361602783203 32.07361602783203" d="M24.3 30C11.4 30 5 43.3 5 50s6.4 20 19.3 20c19.3 0 32.1-40 51.4-40 C88.6 30 95 43.3 95 50s-6.4 20-19.3 20C56.4 70 43.6 30 24.3 30z" stroke-linecap="round" style="transform:scale(0.8);transform-origin:50px 50px">
        <animate attributeName="stroke-dashoffset" repeatCount="indefinite" dur="1.5873015873015872s" keyTimes="0;1" values="0;256.58892822265625"></animate>
        </path>
        </svg>
        <span id="loadig-text-1" class="loading-text c-white">Procesando, espere un momento....</span>
      </div>
    </div>

    <div id="loading2" class="loading-invisible" style="display:none;">
      <div class="loading-spinner">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="204px" height="204px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
        <circle cx="50" cy="50" r="0" fill="none" stroke="#013369" stroke-width="3">
          <animate attributeName="r" repeatCount="indefinite" dur="1.282051282051282s" values="0;40" keyTimes="0;1" keySplines="0 0.2 0.8 1" calcMode="spline" begin="0s"></animate>
          <animate attributeName="opacity" repeatCount="indefinite" dur="1.282051282051282s" values="1;0" keyTimes="0;1" keySplines="0.2 0 0.8 1" calcMode="spline" begin="0s"></animate>
        </circle><circle cx="50" cy="50" r="0" fill="none" stroke="#00263d" stroke-width="3">
          <animate attributeName="r" repeatCount="indefinite" dur="1.282051282051282s" values="0;40" keyTimes="0;1" keySplines="0 0.2 0.8 1" calcMode="spline" begin="-0.641025641025641s"></animate>
          <animate attributeName="opacity" repeatCount="indefinite" dur="1.282051282051282s" values="1;0" keyTimes="0;1" keySplines="0.2 0 0.8 1" calcMode="spline" begin="-0.641025641025641s"></animate>
        </circle>
        </svg>
        <span id="loadig-text-2" class="loading-text c-white">Procesando, espere un momento....</span>
      </div>
    </div> -->

    
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">