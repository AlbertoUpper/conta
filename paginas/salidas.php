<?php 
$id = $_GET['id'];
//Modificar proveedor
if (isset($_POST['btnAgregarSalida'])) {
  $idProducto = $_POST['idProducto'];
  $cantidad = $_POST['cantidad'];
  $precio = $_POST['precio'];

  $conexion = conectar();
  $sqlVerificarCantidad = "SELECT cantidad from productos where idProducto = $id";
  $sql = "insert into salidas values(null,$idProducto,$cantidad,$precio,null)";
  $resp = mysqli_query($conexion, $sqlVerificarCantidad);
  while ($valor = mysqli_fetch_array($resp)) {
    $stock = $valor['cantidad'];
  }
 if ($cantidad > $stock) {
   echo "<script>alert('La cantidad saliente es mayor al stock actual')</script>";
 }else{
  if (mysqli_query($conexion, $sql)) {
    echo "<script>alert('Salida registrada con Éxito')</script>";
  }else{
   echo "<script>alert('Error al registrar la Salida')</script>";
  }
 }
}
?>
    <!-- Page Content -->
    <div class="container">
       <?php 
        $conexion = conectar();
        $sqlProvs = "SELECT * FROM productos where idProducto = $id";
        $resp = mysqli_query($conexion,$sqlProvs);  
        while ($producto = mysqli_fetch_array($resp)):
          $prod = $producto['nombre'];$prodID = $producto['idProducto'];
          $precioActual = $producto['precio'];
       ?>
      <p class="h2 mt-3">Salidas del producto: <?php echo ucfirst($producto['nombre']) . " con ID: " . $producto['idProducto']; ?> </p><a href="index.php?p=entradas&id=<?php echo $producto['idProducto']; ?>" class="float-right">Ver las Entradas de este producto</a>
      <p class="h5">Cantidad Actual: <?php echo $producto['cantidad']; ?></p>
      <p class="h5 mb-3">Costo Actual: <?php echo "$" . $producto['precio']; ?></p>
      <?php endwhile ?>
      <div class="row my-2">
        <div class="col-6">
          <button class="btn btn-outline-primary"  data-toggle="modal" data-target="#NuevaSalida"><span class="icon-log-out"></span> Nueva Salida</button><a href="paginas/php/reporteSalidas.php?id=<?php echo $prodID ?>" target="_blank" class="ml-1 btn btn-outline-danger" title="Ver como PDF"><span class="icon-file-pdf"> PDF</span></a>
          <!-- Modal -->
          <div class="modal fade bd-example-modal-lg" id="NuevaSalida" tabindex="-1" role="dialog" aria-labelledby="NuevaSalida" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><span class="icon-log-out"></span> Nueva Salida</h5>
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
                          <input id="nombre" readonly type="text" class="form-control" value="<?php echo $prod ?>">
                          </div>
                        </div>
                      <div class="col-md-6">
                          <label for="id">ID producto:</label>
                          <input id="id" name="idProducto" readonly type="text" class="form-control" value="<?php echo $prodID ?>">
                      </div>
                    </div>
                    <div class="row">
                       <div class="col-md-6">
                          <label for="precio">Costo:</label>
                          <input id="precio" name="precio" readonly type="text" class="form-control" value="<?php echo $precioActual ?>">
                        </div>
                      <div class="col-md-6">
                          <label for="cantidad">Cantidad Saliente:</label>
                          <input id="cantidad" class="form-control" type="text" name="cantidad"  value="" required>
                      </div>
                    </div>                  
                </div>
                <div class="modal-footer">
                  <input type="submit" name="btnAgregarSalida" class="btn btn-primary"value="Agregar" />
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
            <input class="form-control mr-sm-1" type="text" placeholder="ID Salida" name="buscarSalida" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" title="Buscar por fecha" name="btnBuscarSalida" type="submit"><span class="icon-search"></span> Buscar</button>
          </form>
        </div>
      </div>
      <div class="row">
        <table class="table table-hover">
          <tr>
            <th>ID Salida</th>
            <th>Cantidad</th>
            <th>Costo</th>
            <th>Costo Total</th>
            <th>Fecha</th>
          </tr>
          <?php
            $conexion = conectar();
            if (isset($_POST['btnBuscarSalida'])) {
              $busqueda = $_POST['buscarSalida'];
              $sqlSalidas = "SELECT salidas.idSalida, productos.nombre, salidas.cantidad, salidas.precio, salidas.fecha FROM productos inner join salidas on productos.idProducto = salidas.idProducto where productos.idProducto = $id and salidas.idSalida like '%$busqueda%' order by salidas.fecha DESC";
            }else{
              $sqlSalidas = "SELECT salidas.idSalida, productos.nombre, salidas.cantidad, salidas.precio, salidas.fecha FROM productos inner join salidas on productos.idProducto = salidas.idProducto where productos.idProducto = $id order by salidas.fecha DESC";  
            }
            $res = mysqli_query($conexion,$sqlSalidas);
            $n = mysqli_num_rows($res);
            if ($n == 0){
              echo "<td colspan='5' class='text-center'>No se encontraron Salidas</td>";
            }else{  
            while ($most = mysqli_fetch_array($res)):          
          ?>
          <tr>
            <td><?php echo $most['idSalida']; ?></td>
            
            <td><?php echo $most['cantidad']; ?></td>
            <td><?php echo "$ ".$most['precio']; ?></td>
            <td><?php echo "$ ".number_format(($most['precio'] * $most['cantidad']),2); ?></td>
            <td><?php 
            $fecha = date_create($most['fecha']);
              echo date_format($fecha,'d/m/Y');
            ?></td> 
          </tr>
          <?php endwhile;
          }              
          ?>
        </table>
      </div>            
    </div>