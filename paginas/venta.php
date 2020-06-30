    <!-- Page Content -->
<div class="container">         
  <form action="index.php?p=factura" class="jumbotron p-4 mt-5" method="POST">
    <div class="row justify-content-center">
      <h4>Formulario de venta</h4>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="form-group">
          <label for="cantidad">Cantidad:</label>
          <input id="cantidad" type="text" class="form-control" name="cantidad" required>
        </div>
      </div>
       <div class="col-md-4">
          <div class="form-group">
            <label for="producto">Producto:</label>
           <select name="producto" class="form-control" id="producto" required>
            <option value="" selected="true">------Seleccione------</option>
             <?php 
             $conexion = conectar();
              $sqlProvs = "SELECT * FROM productos";
              $resp = mysqli_query($conexion,$sqlProvs);  
              while ($product = mysqli_fetch_array($resp)):
            ?>               
             <option value="<?php echo $product['idProducto'] ?>"><?php echo $product['nombre']; ?></option>                               
            <?php endwhile ?>
             ?>
           </select>
          </div>
       </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Crédito Fiscal</span>
          </div>
          <input type="text" name="nit" aria-label="First name" class="form-control" placeholder="NIT">
          <input type="text" name="empresa" aria-label="Last name" class="form-control" placeholder="Nombre Empresa">
        </div>
      </div>           
    </div>     
    <div class="row justify-content-center">
      <small class="text-danger">*Campos para generar crédito fiscal, no son obligatorios</small>
    </div>        
    <div class="row  justify-content-center mt-5">
      <div class="col-md-8">
        <div class="form-group text-center">
          <button type="submit" name="btnProcesar" class="btn btn-primary"><span class="icon-refresh"></span> Procesar</button>
          <a href="index.php?p=inicio" type="submit" name="btnCancelar" class="btn btn-dark"><span class="icon-cancel-circle"></span> Cancelar</a>
        </div>
       </div>
    </div>       
  </form>         
</div>
  