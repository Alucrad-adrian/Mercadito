<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mercadito Friki | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url();?>adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url();?>adminlte/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>adminlte/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url();?>adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>adminlte/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url();?>adminlte/plugins/summernote/summernote-bs4.min.css">

</head>
<body class="hold-transition login-page"  style="background-color: rgb(39,132,171);" >
 
<div class="login-box">
  
  <div class="login-logo">
    <a href="../../index2.html" style="color:black"><b>Bienvenidos al Mercadito Friki
    </a>
  </div>
  <div id="validado"></div>
  <!-- /.login-logo -->
  <div class="card">
    
    <div class="card-body login-card-body" style="background-color:rgb(39,132,171)">
      <div>
        <img src="<?php echo base_url();?>img/friki.jpg" width="120" height="120" style="align-items: center; margin-left: 100px;">
      </div>
      <p class="login-box-msg" style="color:black">Ingresar sesion</p>

      <?php
echo form_open_multipart("usuarios/validarusuario");
?>

<input type="text" class="form-control" name="usuario" placeholder="Escribe login" required>
<input type="password" class="form-control" name="password" placeholder="Escribe password" required>
<button type="submit" class="btn btn-success">Ingresar</button>
	
<?php
echo form_close();
?>

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="<?php echo base_url();?>adminlte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src=".<?php echo base_url();?>adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>dist/js/adminlte.js"></script>
</body>
</html>