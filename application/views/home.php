<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Welcome to - Hawas App</title>
    <link rel="apple-touch-icon" href="<?=base_url()?>theme-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/img/logo-kotak-persegi.png">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>theme-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>theme-assets/vendors/css/charts/chartist.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>theme-assets/css/app-lite.css">
    <!-- END CHAMELEON  CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>theme-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>theme-assets/css/pages/dashboard-ecommerce.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <!-- END Custom CSS-->
    <script src="<?=base_url()?>assets/js/jquery-3.4.0.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"/>
 
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <style type="text/css">
      .swal-text {
        text-align: center !important;
      }
    </style>
  </head>
  <style type="text/css">
     #pageloader
    {
      background: rgba( 255, 255, 255, 0.8 );
      display: none;
      height: 100%;
      position: fixed;
      width: 100%;
      z-index: 9999;
    }

    #pageloader img {
        left: 51%;
        margin-left: -70px;
        margin-top: -100px;
        position: absolute;
        top: 50%;
    }

    ft-rotate-cw {
      display: none;
    }
  </style>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.ft-rotate-cw').hide();
    });
  </script>
  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">

    <div id="pageloader">
        <img src="<?=base_url()?>assets/img/pageloader2.gif" alt="processing..." />
    </div>

    <!-- fixed-top-->
      <?php $this->load->view('header') ?>
    <!-- ////////////////////////////////////////////////////////////////////////////-->    


    <!-- fixed-top-->
      <?php $this->load->view('sidebar') ?>
    <!-- ////////////////////////////////////////////////////////////////////////////-->




<div class="app-content content">
<div class="content-wrapper">
  <div class="content-wrapper-before"></div>
  <div class="content-header row">
  </div>
  <div class="content-body"><!-- Chart -->
        <!-- menu -->
          <?php $this->load->view($page) ?>
        <!-- ////////////////////////////////////////////////////////////////////////////-->
  </div>
</div>
</div>


    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
      <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2020  &copy; Copyright <?=config_item('company_name')?></span>
       <!--  <ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
          <li class="list-inline-item"><a class="my-1" href="https://themeselection.com/" target="_blank"> More themes</a></li>
          <li class="list-inline-item"><a class="my-1" href="https://themeselection.com/support" target="_blank"> Support</a></li>
          <li class="list-inline-item"><a class="my-1" href="https://themeselection.com/products/chameleon-admin-modern-bootstrap-webapp-dashboard-html-template-ui-kit/" target="_blank"> Purchase</a></li>
        </ul> -->
      </div>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="<?=base_url()?>theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?=base_url()?>theme-assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CHAMELEON  JS-->
    <script src="<?=base_url()?>theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
    <script src="<?=base_url()?>theme-assets/js/core/app-lite.js" type="text/javascript"></script>
    <!-- END CHAMELEON  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?=base_url()?>theme-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    <script src="<?=base_url()?>assets/js/sweetalert.min.js"></script>
  </body>
</html>