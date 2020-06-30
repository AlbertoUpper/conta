<?php
//verificar si han eliminado productos
 if (isset($_GET['elim']) && $_GET['elim'] == 1) {
    echo "<script>alert('Producto eliminado con éxito')</script>";
    echo "<script>location.href='index.php?p=inicio';</script>";
  } 
//agregar productos
if (isset($_POST['btnAgregarProducto'])) {
  $prov = $_POST['proveedor'];
  $nombre = $_POST['nombre'];
  $precio = $_POST['precio'];
  $cantidad = $_POST['cantidad'];
  $medida = $_POST['medida'];

  $conexion = conectar();
  $sql = "insert into productos values(null,$prov,'$nombre',$precio,$cantidad,'$medida')";
  if (mysqli_query($conexion, $sql)) {
    echo "<script>alert('Producto Agregado con Éxito')</script>";
  }else{
   echo "<script>alert('Error al agregar el producto')</script>";
  }
}
?>
    <!-- Page Content -->
    <div class="container">
      <h2 class="my-3"><span class="icon-text-document"></span>Inventario de productos.</h2>
      <div class="row my-2">
        <div class="col-6">
          <button class="btn btn-outline-primary"  data-toggle="modal" data-target="#NuevoProducto"><span class="icon-circle-with-plus"></span> Nuevo producto</button><a href="paginas/php/reporteProductos.php" target="_blank" class="ml-1 btn btn-outline-danger" title="Ver como PDF"><span class="icon-file-pdf"> PDF</span></a>
          <!-- Modal -->
          <div class="modal fade bd-example-modal-lg" id="NuevoProducto" tabindex="-1" role="dialog" aria-labelledby="NuevoProducto" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="" method="POST">
                    <div class="row">
                       <div class="col-md-6">
                          <div class="form-group">
                            <label for="nombre">Nombre:</label>
                          <input id="nombre" class="form-control" type="text" name="nombre"  value="" required>
                          </div>
                        </div>
                      <div class="col-md-6">
                          <label for="proveedor">Proveedor:</label>
                          <select name="proveedor" class="form-control">
                            <?php 
                              $conexion = conectar();
                              $sqlProvs = "SELECT * FROM proveedores";
                              $resp = mysqli_query($conexion,$sqlProvs);  
                              while ($proveedor = mysqli_fetch_array($resp)):
                             ?>
                             <option value="<?php echo $proveedor['idProveedor'] ?>"><?php echo $proveedor['nombre']; ?></option>
                             <?php endwhile ?>
                          </select>
                      </div>
                    </div>
                    <div class="row">
                       <div class="col-md-6">
                          <label for="precio">Precio:</label>
                          <input id="precio" class="form-control" type="text" name="precio"  value="" required>
                        </div>
                      <div class="col-md-6">
                          <label for="cantidad">Cantidad inicial:</label>
                          <input id="cantidad" class="form-control" type="text" name="cantidad"  value="" required>
                      </div>
                    </div>
                      <div class="row">
                        <div class="col-md-6">
                          <label for="medida">Medida:</label>
                          <input id="medida" class="form-control" type="text" name="medida"  value="" required>
                        </div>
                    </div>                   
                </div>
                <div class="modal-footer">
                  <input type="submit" name="btnAgregarProducto" class="btn btn-primary"value="Agregar" />
                  <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- finModal -->
        </div>
        <div class="col-6">
          <form class="form-inline float-right" action="" method="POST">
            <input class="form-control mr-sm-1" type="search" placeholder="Nombre del producto" name="buscarProducto" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" name="btnBuscarProducto" type="submit"><span class="icon-search"></span> Buscar</button>
          </form>
        </div>
      </div>
      <div class="row">
        <table class="table table-hover">
          <tr>
            <th>ID Producto</th>
            <th>ID Proveedor</th>
            <th>Producto</th>
            <th>Costo unitario</th>
            <th>Cantidad</th>
            <th>Costo total</th>
            <th class="text-center">Ver</th>
          </tr>
          <?php
            $conexion = conectar();
            if (isset($_POST['btnBuscarProducto'])) {
              $busqueda = $_POST['buscarProducto'];
              $sqlProductos = "SELECT * FROM productos where nombre like '%$busqueda%'";
            }else{
              $sqlProductos = "SELECT * FROM productos";  
            }
            $res = mysqli_query($conexion,$sqlProductos);  
            while ($most = mysqli_fetch_array($res)):          
          ?>
          <tr>
            <td><?php echo $most['idProducto']; ?></td>
            <td><?php echo $most['idProveedor']; ?></td>
            <td><?php echo $most['nombre']; ?></td>
            <td><?php echo "$ ".$most['precio']; ?></td>
            <td><?php echo $most['cantidad']; ?></td> 
            <td><?php echo "$ " . number_format($most['cantidad'] * $most['precio'],2); ?></td> 
            <td class="text-center">
              <a class="btn btn-outline-secondary btn-sm" title="Entradas" href="index.php?p=entradas&id=<?php echo $most['idProducto']; ?>"><span class="icon-login"></span></a>
              <a class="btn btn-outline-secondary btn-sm" title="Salidas" href="index.php?p=salidas&id=<?php echo $most['idProducto']; ?>"><span class="icon-log-out"></span></a>
              <a class="btn btn-outline-secondary btn-sm" title="Ver" href="index.php?p=producto&id=<?php echo $most['idProducto']; ?>"><span class="icon-eye2"></span></a>
            </td>
          </tr>
          <?php endwhile;              
          ?>
        </table>
      </div>            
    </div>
