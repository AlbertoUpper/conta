<?php 
  
  $idProduct = $_POST['idProduct'];
  $cant = number_format($_POST['cant'],3);
  $prec = $_POST['prec'];

  $conexion = conectar();
  $sqlVerificarCantidad = "SELECT cantidad from productos where idProducto = $idProduct";
  $sql = "insert into salidas values(null,$idProduct,$cant,$prec,null)";
  $resp = mysqli_query($conexion, $sqlVerificarCantidad);
  while ($valor = mysqli_fetch_array($resp)) {
    $stock = $valor['cantidad'];
  }
 if ($cant > $stock) {
   echo "<script>alert('La cantidad saliente es mayor al stock actual')</script>";
 }else{
  if (mysqli_query($conexion, $sql)) {
    echo "<script>alert('Salida registrada con Éxito')</script>";
    echo "<script>
    location.href='index.php?p=inicio';
    </script>";    
  }else{
   echo "<script>alert('Error al registrar la Salida')</script>";
  }
 }
  
 ?>