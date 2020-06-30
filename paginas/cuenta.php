<?php 
  include('paginas/php/seguridadCuenta.php');
  $conexion = conectar();
  $sql = "SELECT login.id_usuario, login.usuario, login.correo, login.tipo, usuarios.nombre_usuario, usuarios.apellido_usuario, usuarios.departamento, login.fecha_creacion, usuarios.telefono, usuarios.foto_usuario FROM login INNER JOIN usuarios ON login.id_usuario = usuarios.id_usuario WHERE login.usuario = '".$_SESSION["usuarioactual"]."'";
  $resultado = mysqli_query($conexion, $sql);

  // $conexion = conectar();
  $sql2 = "CALL proc_mostrarCategoriasUsuaio('". $_SESSION['usuarioactual']."')";
  $resultado2 = mysqli_query($conexion, $sql2);
 ?>
<div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Bienvenido a tu cuenta
        <small><?php echo ucfirst($_SESSION["usuarioactual"]); ?></small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="?p=inicio">Inicio</a>
        </li>
        <li class="breadcrumb-item active">Tu cuenta</li>
      </ol>

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          <!-- Blog Post -->
          <div class="card mb-4">
            
            <div class="card-body">
              <h2 class="card-title">Datos de tu cuenta</h2>
              <hr>              
                <div class="row">
                  <div class="col-md-8 ">
                    <?php while($ver = mysqli_fetch_array($resultado)): 
                      $id = $ver['id_usuario'];
                    ?>
                    <label>Nombre: <?php echo ucfirst($ver['nombre_usuario']) ." ". ucfirst($ver['apellido_usuario']); ?></label><br>                  
                    <label>Usuario: <?php echo ucfirst($ver['usuario']); ?></label><br>                                  
                    <label>Telefono: <?php echo isset($ver['telefono']) ?$ver['telefono'] :'Sin completar'; ?></label><br> 
                    <label>Correo: <?php echo $ver['correo']; ?></label><br>
                    <label>Departamento: <?php echo ucfirst($ver['departamento']); ?></label><br>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".modicarAnuncio"><i class="icon-pencil"></i> Editar Datos</button><br>
                  </div>
                  <div class="col-md-4">
                  <div id="preview" class="thumbnail" style="border:1px solid lightblue; border-radius: 3px">
                    <a href="#" id="file-select" class="btn btn-secondary">Elegir archivo</a>               
                    <img style="border-radius: 3px" id="imagenPrevia" src="img/imgCuentas/<?php echo $ver['foto_usuario'] ?>" width="100%" height="100%" class="img-responsive" alt="foto de perfil">
                   </div>
                  <form id="file-submit" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?php echo $ver['id_usuario'] ?>">
                      <input id="file" name="imagen" type="file"/>
                  
                    <button class="btn btn-warning btn-sm" id="btnModificarFoto" type="submit" style="width: 100%"><i class="icon-pencil"></i>Cambiar foto</button>
                    </form>
                  </div> 
                </div>                                  
            </div>
            <div class="card-footer text-muted">
              Inicio de Actividad: <?php 
              $fecha = date_create($ver['fecha_creacion']);
              echo date_format($fecha,'d/m/y'); ?>

              <!-- modal -->
              <div class="modal fade bd-example-modal-lg modicarAnuncio" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="color: black">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Modifica tus datos</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                       <div class="container-fluid">
                         <form id="formModificar">
                          <input type="hidden" name="id" value="<?php echo $ver['id_usuario']; ?>">
                          <input type="hidden" name="tipo" value="<?php echo $ver['tipo']; ?>">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="n" class="col-form-label">Nombre:</label>
                                <input id="n" class="form-control" type="text" name="nombre"  value="<?php echo $ver['nombre_usuario'] ?>" required>
                              </div>
                            </div>
                            <div class="col-md-6 ml-auto">
                              <div class="form-group">
                                <label for="a" class="col-form-label">Apellido:</label>
                                <input id="a" class="form-control" type="text" name="apellido" value="<?php echo $ver['apellido_usuario'] ?>" required>
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-6" ">
                              <div class="form-group">
                                <label for="d" class="col-form-label">Departamento:</label>
                                <select name="departamento" id="d" class="form-control" required>
                                  <?php 
                                    if (isset($ver['departamento'])) {
                                      echo "<option value='".$ver['departamento']."' selected>".$ver['departamento']."</option>";
                                    }else {
                                      echo "<option value=''>---Seleccione----</option>";
                                    }
                                   ?>
                                  <option value="santa ana">Santa ana</option>
                                  <option value="sonsonate">Sonsonate</option>
                                  <option value="ahuachapan">Ahuachapan</option>
                                  <option value="chalatenango">Chalatenango</option>
                                  <option value="cabañas">Cabañas</option>
                                  <option value="cuscatlan">Cuscatlan</option>
                                  <option value="san salvador">San salvador</option>
                                  <option value="la libertad">La libertad</option>
                                  <option value="san vicente">San vicente</option>
                                  <option value="la paz">La paz</option>
                                  <option value="usulutan">Usulutan</option>
                                  <option value="morazan">Morazan</option>
                                  <option value="san miguel">San miguel</option>
                                  <option value="La unión">La unión</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6 ml-auto">
                              <div class="form-group">
                                <label for="t" class="col-form-label">Telefono:</label>
                                <input id="t" maxlength="8" class="form-control" type="text" name="telefono" value="<?php echo $ver['telefono'] ?>" required>
                              </div>
                            </div>
                          </div>  
                         </form>
                       </div>                                                              
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross2"></i> Cancelar</button>
                      <button type="button" id="btnModificarUsuario" class="btn btn-warning" data-toggle="modal"><i class="icon-pencil"></i> Modificar</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- fin modal -->
              <!-- inicio modal cambiar contra -->
              <div class="modal fade" id="cambioPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: black">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Cambio de Contraseña</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="formCambiarPass">
                        <input type="hidden" name="ide" value="<?php echo $ver['id_usuario']; ?>">
                        <div class="form-group">
                          <label for="vieja" class="col-form-label">Contraseña actual:</label>
                          <input type="password" name="vieja" class="form-control" id="vieja">
                        </div>
                         <div class="form-group">
                          <label for="nueva" class="col-form-label">Nueva Contraseña:</label>
                          <input type="password" name="nueva" class="form-control" id="nueva">
                        </div>
                        <div class="form-group">
                          <label for="rnueva" class="col-form-label">Repite:</label>
                          <input type="password" name="rnueva" class="form-control" id="rnueva">
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross2"></i> Cerrar</button>
                      <button type="button" id="btnCambiarContra" class="btn btn-primary"><i class="icon-refresh"></i> Cambiar</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- final modal cambiar contra -->

              <?php endwhile; ?>              
            </div>
          </div>                
        </div>        
        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
          <!-- Categories Widget -->
          <div class="card mb-4">
            <h5 class="card-header">Categorias Seleccionadas.</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <?php 
                      $conta = 0;
                      while($vergustos = mysqli_fetch_array($resultado2)): 
                    ?>
                    <li>
                      <?php 
                        if (($conta >= 0 && $conta <= 3) || ($conta >= 7 && $conta <= 9)):                                                  
                       ?>
                       <a href="index.php?p=busquedaCategoria&c=<?php echo $vergustos['nombre_categoria']; ?>"><?php echo ucfirst($vergustos['nombre_categoria']); ?></a>
                     <?php                                        
                      endif;
                       if (($conta == 3) || ($conta == 9)) {
                        break;
                        }                                            
                      $conta +=1;
                      endwhile;                      
                     ?>
                    </li>                   
                  
                  </ul>
                </div>
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <?php 

                      $conta = 4;
                      while($vergustos = mysqli_fetch_array($resultado2)): 
                    ?>
                     <li>
                      <?php                       
                        if (($conta >= 4 && $conta <= 6) || ($conta >= 10 && $conta <= 12)):                                                  
                       ?>
                       <a href="index.php?p=busquedaCategoria&c=<?php echo $vergustos['nombre_categoria']; ?>"><?php echo ucfirst($vergustos['nombre_categoria']); ?></a>
                     <?php endif;   
                      if (($conta == 6) || ($conta == 12)) {
                        break;
                        }                    
                      $conta +=1;
                      endwhile;
                      mysqli_close($conexion);
                     ?>
                    </li>                     
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">Otras opciones</h5>
            <div class="card-body">
              <form id="formModCates" method="POST" action="paginas/php/eliminarGustos.php">
                <input type="hidden" name="idUser" value="<?php echo $id ?>">
                <a href="#" id="btnModCates" class="text-danger" style="cursor: pointer;"><i class=" icon-refresh"></i> Reiniciar mis categorias.</a>
              </form>
               <form id="" method="POST" action="">
                <input type="hidden" name="idUserr" value="<?php echo $id ?>">
                <a href="" data-toggle="modal" data-target="#cambioPass" class="text-danger" style="cursor: pointer;"><i class=" icon-refresh"></i> Cambiar contraseña.</a>
              </form>
            </div>
          </div>

        </div>

      </div>
      <!-- /.row -->
      
      <?php 
      $con = conectar();
      $us = $_SESSION["usuarioactual"];
      $consulta = "Call proc_mostrarAnunciosxUsuario('$us')";
      $result = mysqli_query($con, $consulta);
      if (mysqli_num_rows($result) > 0) {
        echo "<h1 class='mt-4 mb-3'>Tus Anuncios...</h1>";
      }          
      while ($anuncio = mysqli_fetch_array($result)):      
      ?>
      <input id="idAnuncio" type="hidden" value="<?php echo $anuncio['id_anuncio'] ?>">
      <div class="card mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-5">
                <img class="img-fluid rounded" src="img/imgAnuncios/<?php echo $anuncio['imagen_anuncio'] ?>" style=" border:1px solid lightblue;width:550px; height:210px;" alt="">
            </div>
            <div class="col-lg-6 offset-1">
              <div class="row ">
                <div class="col-lg-6"><h2 class="card-title"><?php echo ucfirst($anuncio['nombre_anuncio']); ?></h2></div>
              <div class="col-lg-6 col-sm-3 col-xs-3"><h2 class="card-title text-right"><?php echo "$".$anuncio['precio_anuncio']; ?></h2></div>
              </div>
              
              <p class="card-text"><?php echo ucfirst($anuncio['descripcion']); ?></p>               
              <p class="card-text text-secondary"><?php echo ucfirst($anuncio['nombre_categoria']) . " > " . ucfirst($anuncio['nombre_subCategoria']); ?></p> 
              <button class="btn btn-warning" data-toggle="modal" data-target="#<?php echo $anuncio['id_anuncio'] ?>"><i class="icon-pencil"></i> Editar</button>
              <button class="btn btn-danger" onclick="eliminarAnuncio(<?php echo $anuncio['id_anuncio'] ?>);"><i class="icon-trash"></i> Eliminar</button>
            </div>
          </div>
        </div>
        <div class="card-footer">
          Fecha de Publicación: 
          <?php $fecha = date_create($anuncio['publicacion']);
              echo date_format($fecha,'d/M/Y'); ?>
        </div>
      </div>

      <!-- modal modificar anuncios -->
      <div class="modal fade bd-example-modal-lg" data-target="<?php echo $anuncio['id_anuncio'] ?>" tabindex="-1" role="dialog" aria-labelledby="anunciomod" id="<?php echo $anuncio['id_anuncio'] ?>" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modifica tu Anuncio.</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
             <div class="container-fluid">
               <form id="formModificarAnuncio<?php echo $anuncio['id_anuncio']; ?>">                
               <input type="hidden" name="idAnuncio" value="<?php echo $anuncio['id_anuncio']; ?>">                        
               <input type="hidden" name="imgActualAnuncio" value="<?php echo $anuncio['imagen_anuncio']; ?>">                        
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nomA" class="col-form-label">Nombre de tu anuncio</label>
                      <input id="nomA" class="form-control" type="text" name="nomA" value="<?php echo $anuncio['nombre_anuncio'] ?>" placeholder="ej: computadora lenovo">
                    </div>
                  </div>
                  <div class="col-md-6 ml-auto">
                    <div class="form-group">
                      <label for="precA" class="col-form-label">Precio de tu anuncio:</label>
                      <input id="precA" class="form-control" type="text" name="precA" value="<?php echo $anuncio['precio_anuncio']?>" placeholder="00.00">
                    </div>
                  </div>
                </div>
                 <div class="row">
                  <input type="hidden" name="idSub" value="<?php echo $anuncio['id_subCategoria'] ?>">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="col-form-label">Categoria Actual: <p class="text-info"><?php echo ucfirst($anuncio['nombre_categoria']). " > ". ucfirst($anuncio['nombre_subCategoria']) ?></p></label> <input name="cambiar" type="checkbox" value="si"> Cambiar
                    </div>
                  </div>                  
                </div>  
                <div class="row" >
                  <div class="col-md-6" ">
                    <div class="form-group">
                      <label for="categ" class="col-form-label">Selecciona una Categoria:</label>  
                      <select name="categ" id="categ" class="form-control" >
                        <option value="0">------Seleccione-----</option>
                        <?php 
                        $conexion = conectar();
                        $sql = "CALL proc_mostrarCategorias()";
                        $cates = mysqli_query($conexion, $sql);
                        while($mostrarCat = mysqli_fetch_array($cates)): ?>
                          <option value="<?php echo $mostrarCat['id_categoria']; ?>"><?php echo $mostrarCat['nombre_categoria']; ?></option>
                        <?php endwhile;  ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6 ml-auto">
                    <div class="form-group">
                      <label for="subcateg" class="col-form-label">Selecciona Sub Categoria:</label>
                      <select name="subcateg" id="subcateg" class="form-control" >
                        
                      </select>
                    </div>
                  </div>
                </div> 
                <div class="row">
                  <div class="col-md-6" >
                    <div class="form-group">
                      <label for="desc" class="col-form-label">Descripción de tu producto:</label>
                      <textarea name="desc" id="desc" rows="5" style="resize:none; width: 100%;" placeholder="Describe tu anuncio..."><?php echo $anuncio['descripcion']; ?></textarea>
                    </div>
                  </div>
                   <div class="col-md-4">
                     <div class="form-group">
                      <label for="desc" class="col-form-label">Foto actual:</label>               
                      <img class="form-control" src="img/imgAnuncios/<?php echo $anuncio['imagen_anuncio'] ?>" style="width: 100%; height: 50%;" alt="foto del anuncio">
                        
                    </div>
                  </div>
                  <div class="col-md-2">
                      <div class="form-group my-2">             
                      Cambiar <input name="cambiarImg" type="checkbox" value="si">
                      <label for="f<?php echo $anuncio['id_anuncio'] ?>">
                          <img style=" width: 90%;cursor: pointer;" src="img/anu.png" alt ="Click aquí para subir tu foto" title ="Click aquí para subir tu foto" > 
                      </label>
                      <input id="f<?php echo $anuncio['id_anuncio'] ?>" type="file" name="imagenMod" style="display: none;">
                    </div>
                  </div>                                    
                </div>   
               </form>
             </div>                                                              
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross2"></i> Cancelar</button>
            <button type="button" class="btn btn-warning" onclick="modificarAnuncio(<?php echo $anuncio['id_anuncio'] ?>)"><i class="icon-pencil"></i> Modificar</button>
          </div>
        </div>
      </div>
    </div>
    <?php  endwhile; ?>
    </div>  
      <!-- modal cambi de pass -->
