<?php 
$id = $_GET['id'];
$conexion = conectar();

if (isset($_POST['btnEliminar'])) {
  
  $sql = "delete from productos where idProducto = $id";
  if (mysqli_query($conexion, $sql)) {
    echo "<script>location.href='index.php?p=inicio&elim=1';</script>";
    echo "<script>alert('Producto eliminado con éxito')</script>";
    
  }else{
   echo "<script>alert('Error al eliminar el producto')</script>";
  }
}

if (isset($_POST['btnModificar'])) {
  $producto = $_POST['producto'];
  $costo = $_POST['precio'];
  $proveedor = $_POST['proveedor'];
  $medida = $_POST['medida'];
  
  $sql = "update productos set nombre = '$producto', precio = $costo, idProveedor = $proveedor, medida = '$medida' where idProducto = $id";
  if (mysqli_query($conexion, $sql)) {
    echo "<script>alert('Producto modificado correctamente')</script>";
  }else{
   echo "<script>alert('Error al modificar el producto')</script>";
  }
}
?>
    <!-- Page Content -->
    <div class="container">
       <?php 
        $prod;$prodID;
        $conexion = conectar();
        $sqlProvs = "SELECT * FROM productos where idProducto = $id";
        $resp = mysqli_query($conexion,$sqlProvs);  
        while ($producto = mysqli_fetch_array($resp)):
          $prod=$producto['nombre'];
          $prodID=$producto['idProducto'];
          $prov=$producto['idProveedor'];
          $precio=$producto['precio'];
          $cantidad=$producto['cantidad'];
          $medida=$producto['medida'];
       ?>
      <p class="h2 mt-3">Producto: <?php echo ucfirst($producto['nombre']) . " con ID: " . $producto['idProducto']; ?></p>
      <a href="index.php?p=salidas&id=<?php echo $producto['idProducto']; ?>" class="float-right">Ver las Salidas de este producto</a>
      <p class="h5">Cantidad Actual: <?php echo $producto['cantidad']; ?></p>
      <a href="index.php?p=entradas&id=<?php echo $producto['idProducto']; ?>" class="float-right">Ver las Entradas de este producto</a>
      <p class="h5">Costo Actual: <?php echo "$" . $producto['precio']; ?></p>
      <p class="h5 mb-3">Costo Total: <?php echo "$" . $producto['precio'] * $producto['cantidad']; ?></p>
      <?php endwhile ?>
      <form action="" class="jumbotron p-4" method="POST">
        <div class="row justify-content-center">
          <div class="col-md-4">
            <div class="form-group">
              <label for="id">ID producto:</label>
              <input id="id" type="text" class="form-control" readonly value="<?php echo $prodID; ?>">
            </div>
          </div>
           <div class="col-md-4">
              <div class="form-group">
                <label for="producto">Producto:</label>
                <input id="producto" name="producto" type="text" class="form-control" value="<?php echo $prod; ?>">
              </div>
           </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-4">
            <div class="form-group">
              <label for="id">Cantidad:</label>
              <input id="id" type="text" readonly class="form-control" value="<?php echo $cantidad; ?>">
            </div>
          </div>
           <div class="col-md-4">
              <div class="form-group">
                <label for="precio">Costo:</label>
                <input id="precio" name="precio" type="text" class="form-control" value="<?php echo $precio; ?>">
              </div>
           </div>
        </div>  
        <div class="row  justify-content-center">
          <div class="col-md-4">
            <div class="form-group">
              <label for="proveedor">Proveedor:</label>
              <select name="proveedor" class="form-control" id="proveedor">
                <?php 
                  $sqlProvs = "SELECT * FROM proveedores";
                  $resp = mysqli_query($conexion,$sqlProvs);  
                  while ($provee = mysqli_fetch_array($resp)):
                ?>
                <?php 
                  if ($provee['idProveedor'] == $prov):
                 ?>
                 <option value="<?php echo $provee['idProveedor'] ?>" selected="true"><?php echo $provee['nombre']; ?></option>
               <?php else: ?>
                  <option value="<?php echo $provee['idProveedor'] ?>"><?php echo $provee['nombre']; ?></option>
                <?php endif ?>
                <?php endwhile ?>
                 ?>
              </select>
            </div>
          </div>
           <div class="col-md-4">
              <div class="form-group">
                <label for="medida">Unidad de Medida:</label>
                <input id="medida" name="medida" type="text" class="form-control" value="<?php echo $medida; ?>">
              </div>
           </div>
        </div>
        <div class="row  justify-content-center">
          <div class="col-md-8">
            <div class="form-group text-center">
              <button type="submit" name="btnModificar" class="btn btn-success"><span class="icon-pencil"></span> Modificar</button>
              <button type="submit" name="btnEliminar" class="btn btn-danger"><span class="icon-trash"></span> Eliminar</button>
            </div>
           </div>
        </div>       
      </form>         
    </div>