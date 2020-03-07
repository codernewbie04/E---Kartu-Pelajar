<!--Counter Inbox-->
<?php
    error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$setting['nama_web'];?> | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/icon.png'?>">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">
    <script src="<?php echo base_url().'assets/js/jquery-3.4.1.min.js'?>"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.css'?>"/>
  <script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
  <script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js'?>"></script>
  <script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js'?>"></script>
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datepicker/datepicker3.css'?>">
  <script src="<?php echo base_url().'assets/plugins/datepicker/bootstrap-datepicker.js'?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="<?php echo base_url().'assets/ckeditor/ckeditor.js'?>"></script>

  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <script src="<?php echo base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!--Counter Inbox-->
  <header class="main-header">

      <!-- Logo -->
      <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="<?=base_url().'assets/images/icon.png';?>" height="40" width="50"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg" ><img src="<?=base_url().'assets/images/icon.png';?>" height="40" width="50"><?=$setting['nama_web'];?></span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->


            <?php
                $id_admin=$this->session->userdata('idadmin');
                $q=$this->db->query("SELECT * FROM tbl_users WHERE id='$id_admin'");
                $c=$q->row_array();
            ?>
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url().'assets/images/fp/'.$c['photo'];?>" class="user-image" alt="">
                <span class="hidden-xs"><?php echo $c['nama'];?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo base_url().'assets/images/fp/'.$c['photo'];?>" class="img-circle" alt="">

                  <p>
                    <?=$c['nama'];?>
                    <?php if($c['level'] == "admin"){
                      echo "<small>Admin</small>";
                    } else if($c['level'] == "guru"){
                      echo "<small>Guru</small>";
                    }?>
                  </p>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="<?php echo base_url().'login/logout'?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="<?php echo base_url().''?>" target="_blank" title="Lihat Website"><i class="fa fa-globe"></i></a>
            </li>
          </ul>
        </div>

      </nav>
    </header>


  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu Utama</li>
        <li>
          <a href="<?php echo base_url().'dashboard'?>">
            <i class="fa fa-home"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog"></i>
            <span>Pengaturan Web</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'setting/konfigurasi'?>"><i class="fa fa-wrench"></i> Konfigurasi</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Kesiswaan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'users'?>"><i class="fa fa-users"></i> List Users</a></li>
            <li><a href="<?php echo base_url().'users/list_murid'?>"><i class="fa fa-users"></i> List Murid</a></li>
          </ul>
        </li>
         <li>
          <a href="<?php echo base_url().'login/logout'?>">
            <i class="fa fa-sign-out"></i> <span>Sign Out</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
