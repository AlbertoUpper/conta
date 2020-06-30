<?php 
$id = $_GET['id'];
//Modificar proveedor
if (isset($_POST['btnModififcarProveedor'])) {
  $prov = $_POST['nombre'];
  $desc = $_POST['descripcion'];

  $conexion = conectar();
  $sql = "update proveedores set nombre = '$prov', descripcion = '$desc' where idProveedor = $id";
  if (mysqli_query($conexion, $sql)) {
    echo "<script>alert('Proveedor Modificado con Éxito')</script>";
    echo "<script>location.href='index.php?p=proveedores';</script>";
  }else{
   echo "<script>alert('Error al modificar el proveedor')</script>";
  }
}
?>
    <!-- Page Content -->
    <?php 
      $conexion = conectar();
      $sqlDatos = "Select * from proveedores where idProveedor = $id";
      $resp = mysqli_query($conexion,$sqlDatos);  
    ?>
    <div class="container">
      <h2 class="my-3"><span class="icon-edit"></span> Editar proveedor.</h2>
      <form action="" method="POST">
       <div class="row">
        <?php 
        while ($proveedor = mysqli_fetch_array($resp)): ?>
           <div class="col-md-6">
              <label for="nombre">Nombre:</label>
              <input id="nombre" class="form-control" type="text" name="nombre"  value="<?php echo $proveedor['nombre'] ?>" required>
            </div>
          <div class="col-md-6">
              <label for="descripcion">Descripción:</label>
              <textarea id="descripcion" name="descripcion" rows="1" style="width: 100%"> <?php echo $proveedor['descripcion'] ?>
              </textarea>
          </div>
        <?php endwhile ?>
        </div> 
        <div class="row mt-4">
           <div class="col-md-6">
             <input type="submit" name="btnModififcarProveedor" class="btn btn-primary" value="Modificar" />
             <a type="button" class="btn btn-dark" data-dismiss="modal" href="index.php?p=proveedores">Cancelar</a>
            </div>
        </div> 
        </form>    
    </div>
</div>     