<?php
	$id = $_GET['id'];	
	require 'conexion.php';
	$con = conectar();
	$sqlProducto = "SELECT * from productos where idProducto = $id";  
	$resultado = mysqli_query($con,$sqlProducto);
	while($row = mysqli_fetch_array($resultado))
	{
		$idProducto = $row['idProducto'];
		$nombre = $row['nombre'];
		$costo = $row['precio'];
		$cantidad = $row['cantidad'];
		$costoTotal = $row['precio'] * $row['cantidad'];		
	}
	include 'plantillaSalidas.php';
	
	$pdf = new PDF();
	$pdf->name = $nombre;
	$pdf->idProducto = $idProducto;
	$pdf->cantidad = $cantidad;
	$pdf->costo = $costo;
	$pdf->costoTotal = $costoTotal;
	$pdf->AliasNbPages();
	$pdf->AddPage('portrait','letter');
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Setx(30);
	$pdf->Cell(26,7,'ID Salida',1,0,'C',1);
	$pdf->Cell(30,7,'Cantidad',1,0,'C',1);
	$pdf->Cell(30,7,'Costo',1,0,'C',1);
	$pdf->Cell(40,7,'Costo Total',1,0,'C',1);
	$pdf->Cell(33,7,'Fecha',1,1,'C',1);
	
	$pdf->SetFont('HELVETICA','',10);
	
	$query = "SELECT salidas.idSalida, salidas.cantidad, salidas.precio, salidas.fecha from salidas inner join productos on salidas.idProducto = productos.idProducto where productos.idProducto = $id";  
	$resp = mysqli_query($con,$query);	
	while($row = mysqli_fetch_array($resp))
	{
		$pdf->Setx(30);
		$pdf->Cell(26,9,$row['idSalida'],1,0,'C');
		$pdf->Cell(30,9,$row['cantidad'],1,0,'C');
		$pdf->Cell(30,9,"$ " . $row['precio'],1,0,'C');
		$pdf->Cell(40,9,"$ ".($row['precio'] * $row['cantidad']),1,0,'C');
		$pdf->Cell(33,9,date_format(date_create($row['fecha']),'d/m/Y'),1,1,'C');
		
	}
	$pdf->Output('i','salidas_'.$pdf->name.'.pfd');
?>