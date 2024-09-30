 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url();?>index.php/usuarios/ventanaAdmin" class="brand-link">
      <img src="<?php echo base_url();?>img/friki.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Mercadito Friki</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url();?>img/friki.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">

       

          <a href="<?php echo base_url();?>index.php/usuarios/ventanaAdmin" class="d-block">Administrador</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="socios.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Socios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/estudiante/agregar" class="nav-link">
                  <i class="fas fa-user"></i>
                  <p>Insertar Socio</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/usuarios/socios" class="nav-link">
                  <i class="fas fa-file"></i>
                  <p>Listar Socios</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                productos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/producto/agregar" class="nav-link">
                  <i class="fas fa-user"></i>
                  <p>Insertar productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/producto/lista" class="nav-link">
                  <i class="fas fa-file"></i>
                  <p>Listar productos</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Cobros
             
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Reportes
               
              </p>
            </a>
           
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>index.php/usuarios/logout">
            <button type="button" class="btn btn-primary">Cerrar sesión</button>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- 