<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Hospital Nuestra Señora</b><br>"Nuestra Señora"</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
     <p class="login-box-msg">Ingresar como Administrador</p>

    <form method="post">

      <div class="form-group has-feedback">
       <input type="text" class="form-control" name="usuario-Ing" placeholder="Usuario">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
          <input type="password" class="form-control" name="clave-Ing" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>

      <?php

      $controlador= new UsuarioC();
      $controlador -> LoginUsuarioC(1); // Numero 3 es necesario para el Rol Id

      ?>


    </form>

 

  </div>
  <!-- /.login-box-body -->
</div>