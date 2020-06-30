<?php 
$id = $_GET['id'];
//Modificar proveedor
if (isset($_POST['btnEliminarProveedor'])) {
  $conexion = conectar();
  $sql = "delete from proveedores where idProveedor = $id";
  if (mysqli_query($conexion, $sql)) {
    echo "<script>alert('Proveedor Eliminado con Éxito')</script>";
    echo "<script>location.href='index.php?p=proveedores';</script>";
  }else{
   echo "<script>alert('Error al eliminar el proveedor')</script>";
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
      <h2 class="my-3"><span class="icon-trash"></span> Eliminar proveedor.</h2>
      <form action="" method="POST">
       <div class="row">
        <?php 
        while ($proveedor = mysqli_fetch_array($resp)): ?>
           <div class="col-md-6">
              <p>¿Está seguro de eliminar el proveedor?</p>
              <p><?php echo $proveedor['nombre'] . " con ID: " . $proveedor['idProveedor']; ?></p>
            </div>
        <?php endwhile ?>
        </div> 
        <div class="row mt-4">
           <div class="col-md-6">
             <input type="submit" name="btnEliminarProveedor" class="btn btn-primary" value="Eliminar" />
             <a type="button" class="btn btn-dark" data-dismiss="modal" href="index.php?p=proveedores">Cancelar</a>
            </div>
        </div> 
        </form>    
    </div>
</div>     