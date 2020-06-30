<?php 
$id = $_GET['id'];
//Modificar proveedor
if (isset($_POST['btnAgregarEntrada'])) {
  $idProducto = $_POST['idProducto'];
  $precio = $_POST['precio'];
  $cantidad = $_POST['cantidad'];

  $conexion = conectar();
  $sql = "insert into entradas values(null,$idProducto,$cantidad,$precio,null)";
  if (mysqli_query($conexion, $sql)) {
    echo "<script>alert('Entrada registrada con Éxito')</script>";
    
  }else{
   echo "<script>alert('Error al registrar la entrada')</script>";
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
       ?>
      <p class="h2 mt-3">Entradas del producto: <?php echo ucfirst($producto['nombre']) . " con ID: " . $producto['idProducto']; ?></p>
      <a href="index.php?p=salidas&id=<?php echo $producto['idProducto']; ?>" class="float-right">Ver las Salidas de este producto</a>
      <p class="h5">Cantidad Actual: <?php echo $producto['cantidad']; ?></p>
      <p class="h5 mb-3">Costo Actual: <?php echo "$" . $producto['precio']; ?></p>
      <?php endwhile ?>
      <div class="row my-2">
        <div class="col-6">
          <button class="btn btn-outline-primary"  data-toggle="modal" data-target="#NuevaEntrada"><span class="icon-login"></span> Nueva Entrada</button>
          <a href="paginas/php/reporteEntradas.php?id=<?php echo $prodID ?>" target="_blank" class="ml-1 btn btn-outline-danger" title="Ver como PDF"><span class="icon-file-pdf"> PDF</span></a>
          <!-- Modal -->
          <div class="modal fade bd-example-modal-lg" id="NuevaEntrada" tabindex="-1" role="dialog" aria-labelledby="NuevaEntrada" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><span class="icon-login"></span> Nueva entrada</h5>
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
                          <input id="precio" class="form-control" type="text" name="precio"  value="" required>
                        </div>
                      <div class="col-md-6">
                          <label for="cantidad">Cantidad Entrante:</label>
                          <input id="cantidad" class="form-control" type="text" name="cantidad"  value="" required>
                      </div>
                    </div>                  
                </div>
                <div class="modal-footer">
                  <input type="submit" name="btnAgregarEntrada" class="btn btn-primary"value="Agregar" />
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
            <input class="form-control mr-sm-1" type="text" placeholder="ID Entrada" name="buscarEntrada" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" title="Buscar por fecha" name="btnBuscarEntrada" type="submit"><span class="icon-search"></span> Buscar</button>
          </form>
        </div>
      </div>
      <div class="row">
        <table class="table table-hover">
          <tr>
            <th>ID Entrada</th>            
            <th>Costo</th>
            <th>Cantidad Entrante</th>
            <th>Costo Total</th>
            <th>Fecha</th>
          </tr>
          <?php
            $conexion = conectar();
            if (isset($_POST['btnBuscarEntrada'])) {
              $busqueda = $_POST['buscarEntrada'];
                $sqlEntradas = "SELECT entradas.idEntrada, productos.nombre, entradas.precio, entradas.cantidadEntrante, entradas.fecha FROM productos inner join entradas on productos.idProducto = entradas.idProducto where productos.idProducto = $id and entradas.idEntrada like '%$busqueda%' order by entradas.fecha DESC";  
            }else{
              $sqlEntradas = "SELECT entradas.idEntrada, productos.nombre, entradas.precio, entradas.cantidadEntrante, entradas.fecha FROM productos inner join entradas on productos.idProducto = entradas.idProducto where productos.idProducto = $id order by entradas.fecha DESC";  
            }
            $res = mysqli_query($conexion,$sqlEntradas);  
            $n = mysqli_num_rows($res);
            if ($n == 0){
              echo "<td colspan='5' class='text-center'>No se encontraron Entradas</td>";
            }else{
              while ($most = mysqli_fetch_array($res)):          
          ?>
          <tr>
            <td><?php echo $most['idEntrada']; ?></td>            
            <td><?php echo "$ ".number_format($most['precio'],2); ?></td>
            <td><?php echo $most['cantidadEntrante']; ?></td>
            <td><?php echo "$ ".number_format(($most['precio'] * $most['cantidadEntrante']),2); ?></td>
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