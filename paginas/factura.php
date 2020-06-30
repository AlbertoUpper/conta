<?php 
if (isset($_POST['btnProcesar'])) {
  $cantidad = $_POST['cantidad'];
  $producto = $_POST['producto'];

 if (!empty($_POST['nit'])) {
   $nit = $_POST['nit'];
 }

  if (!empty($_POST['empresa'])) {
   $empresa = $_POST['empresa'];
 }

  $focf = ((!empty($_POST['nit']) && (!empty($_POST['empresa'])))? 'Comprobante de crédito fiscal.' : 'Factura consumidor final.');
  $conexion = conectar();
  // para pooner numero de factura
  $sqlCount = "SELECT COUNT(idSalida) as num FROM `salidas` ";
  $resp = mysqli_query($conexion,$sqlCount);  
  $n = mysqli_fetch_array($resp);

  //para calcular el precio de venta de la gasolina
  $sqlProducto = "SELECT * from productos where idProducto = $producto";
  $resp2 = mysqli_query($conexion, $sqlProducto);
  $rProducto = mysqli_fetch_array($resp2);
  $precioGanancia = $rProducto['precio'] * 1.10;
  $precioVenta = $precioGanancia * 1.13 + 0.3;//ganancia del 10%, iva y cot+fov agregado
  
  //galones vendidos
  $cantidadGalones = $cantidad / $precioVenta;
  //ventas grabadas
  $ventasGrabadas = $cantidadGalones * $precioGanancia;
  //iva
  $iva = $ventasGrabadas * 0.13;
  //fovial + cotrans
  $fmasc = ($cantidadGalones * 0.1) + ($cantidadGalones * 0.2);
  //total
  $total = $ventasGrabadas+$iva+$fmasc;
  
}
?>  
<!-- Page Content -->
<div class="container">         
  <form action="index.php?p=guardarFactura" class="jumbotron p-3 mt-4" method="POST">
    <input type="hidden" name="idProduct" value="<?php echo $producto ?>">
    <input type="hidden" name="cant" value="<?php echo $cantidadGalones ?>">
    <input type="hidden" name="prec" value="<?php echo $precioGanancia ?>">
    <div class="row justify-content-center">
      <h4>Factura</h4>
    </div>
    <div class="row justify-content-center">
      <div class="col-8">
        <table class="table table-sm">          
            <tr>
              <td >N° Factura: <?php echo ($n['num'] +1); ?></td>                            
              <td rowspan="4" class="h2 text-center">ESTACIÓN <br> DE <br> SERVICIO JJS</td>
              <td rowspan="2" class="h5 text-right"><?php echo $focf; ?></td>

            </tr>
            <tr>
              <td>Fecha: <?php echo date("d/m/Y"); ?></td>                          
            </tr>
            <tr>
              <td>NIT.: 0614 - 230577 -117 -2</td>            
              <?php if (!empty($_POST['empresa']) && !empty($_POST['nit'])):                                
              ?>
                <td class="text-right"><small><?php echo "Empresa: " . $_POST['empresa']; ?><br><?php echo "NIT: " . $_POST['nit']; ?></small></td>
            <?php endif; ?>   
            </tr>
            <tr>
              <td>NRC.: 130949 - 6</td>  
              <td rowspan="2" class="text-right">Formulario único.</td>            
            </tr>                                  
          </table>
          <table class="table table-sm">
            <tr>
              <th>Cantidad.</th>
              <th class="text-center">Descripción.</th>
              <th class="text-right">Precio Unitario.</th>
              <th class="text-right">Ventas grabadas.</th>
            </tr>
            <tr>
              <td><?php echo number_format($cantidadGalones,3); ?></td>
              <td class="text-center"><?php echo $rProducto['nombre']; ?></td>
              <td class="text-center"><?php echo "$ " . number_format($precioGanancia,3) ?></td>
              <td class="text-right"><?php echo "$" . number_format($ventasGrabadas,2);; ?></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>              
            </tr>
            <tr>
              <td></td>              
            </tr>
            <tr>
              <td></td>              
            </tr>
            <tr>
              <td></td>              
            </tr>
            <tr>
              <td>sumas:</td>              
              <td></td>              
              <td class="text-right"><small>13% IVA</small></td><td class="text-right"><?php echo "$ " . number_format($iva,2); ?></td>
            </tr>
            <tr>
              <td></td>              
              <td></td>              
              <td class="text-right"><small>FOVIAL + COTRANS</small></td><td class="text-right"><?php echo "$ " . number_format($fmasc,2); ?></td>
            </tr>
            <tr>
              <td></td>              
              <td></td>              
              <td class="text-right"><small>Venta Total</small></td><td class="text-right"><?php echo "$ " . number_format($total,2); ?></td>
            </tr>
          </table>        
      </div>    
    </div>            
    <div class="row  justify-content-center mt-5">
      <div class="col-md-8">
        <div class="form-group text-center">
          <button type="submit" name="btnProcesar" class="btn btn-primary"><span class="icon-save"></span> Guardar</button>
          <a href="index.php?p=inicio" type="submit" name="btnCancelar" class="btn btn-dark"><span class="icon-cancel-circle"></span> Cancelar</a>
        </div>
       </div>
    </div>       
  </form>         
</div>


  