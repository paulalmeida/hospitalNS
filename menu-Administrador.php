  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="http://localhost:8080/hospitalns/Vistas/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Administrador</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Activo</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU DE NAVEGACION</li>
      <li>
        <a href="http://localhost:8080/hospitalns/inicio">
          <i class="fa fa-home"></i>
          <span>Inicio</span>
        </a>
      </li>

       <li>
        <a href="http://localhost:8080/hospitalns/doctores">
          <i class="fa fa-user-md"></i>
          <span>Doctores</span>
        </a>
      </li>

       <li>
        <a href="http://localhost:8080/hospitalns/especialidadDoctor">
          <i class="fa fa-medkit"></i>
          <span>Citas</span>
        </a>
      </li>

       <li>
        <a href="http://localhost:8080/hospitalns/pacientes">
          <i class="fa fa-users"></i>
          <span>Pacientes</span>
        </a>
      </li>

      <li>
        <a href="http://localhost:8080/hospitalns/especialidades">
          <i class="fa fa-shirtsinbulk"></i>
          <span>Especialidades</span>
        </a>
      </li>

      <li>
         <?php
            echo '<a href="http://localhost:8080/hospitalns/historial/'.$_SESSION["usuario_id"].'">';
          ?>
          <i class="fa fa-history"></i>
          <span>Historial de Citas</span>
        </a>
      </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>