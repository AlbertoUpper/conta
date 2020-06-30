<?php 
//agregar proveedor
if (isset($_POST['btnAgregarProveedor'])) {
  $prov = $_POST['nombre'];
  $desc = $_POST['descripcion'];

  $conexion = conectar();
  $sql = "insert into proveedores values(null,'$prov','$desc')";
  if (mysqli_query($conexion, $sql)) {
    echo "<script>alert('Proveedor Agregado con Éxito')</script>";
  }else{
   echo "<script>alert('Error al agregar el proveedor')</script>";
  }
}
?>
    <!-- Page Content -->
    <div class="container">
      <h2 class="my-3"><span class="icon-text-document"></span>Lista de proveedores.</h2>
      <div class="row my-2">
        <div class="col-6">
          <button class="btn btn-outline-primary"  data-toggle="modal" data-target="#NuevoProducto">Nuevo proveedor</button>
          <!-- Modal -->
          <div class="modal fade" id="NuevoProducto" tabindex="-1" role="dialog" aria-labelledby="NuevoProducto" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Nuevo Proveedor</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="" method="POST">
                    <div class="row">
                       <div class="col-md-12">
                          <div class="form-group">
                            <label for="nombre">Nombre:</label>
                          <input id="nombre" class="form-control" type="text" name="nombre"  value="" required>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="descripcion">Descripción:</label>
                              <textarea id="descripcion" name="descripcion" rows="3" style="width: 100%"></textarea>
                            </div>
                          </div>
                        </div>
                </div>
                <div class="modal-footer">
                  <input type="submit" name="btnAgregarProveedor" class="btn btn-primary"value="Agregar" />
                  <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- finModal -->
        </div>
        <div class="col-6">
          <form class="form-inline float-right" method="POST" action="">
            <input class="form-control mr-sm-1" type="search" placeholder="Nombre del proveedor" name="buscarProveedor" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="btnBuscarProveedor"><span class="icon-search"></span> Buscar</button>
          </form>
        </div>
      </div>
      <div class="row">
        <table class="table table-hover">
          <tr>
            <th>ID Proveedor</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
          </tr>
          <?php
            $conexion = conectar();
            if (isset($_POST['btnBuscarProveedor'])) {
              $busqueda = $_POST['buscarProveedor'];
              $sqlProductos = "SELECT * FROM proveedores where nombre like '%$busqueda%'";
            }else{
              $sqlProductos = "SELECT * FROM proveedores";  
            }
            $res = mysqli_query($conexion,$sqlProductos);  
            while ($most = mysqli_fetch_array($res)):          
          ?>
          <tr>
            <td><?php echo $most['idProveedor']; ?></td>
            <td><?php echo $most['nombre']; ?></td>
            <td><?php echo $most['descripcion']; ?></td>
            <td><a class="btn btn-warning" title="Modificar" href="index.php?p=editarproveedor&id=<?php echo $most['idProveedor']; ?>"><span class="icon-pencil"></span></a>
            <a class="btn btn-danger" title="Eliminar" href="index.php?p=eliminarProveedor&id=<?php echo $most['idProveedor']; ?>"><span class="icon-trash"></span></a></td>
          </tr>
          <?php endwhile;              
          ?>
        </table>
      </div>            
    </div>
</div>     