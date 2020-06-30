<?php
	include 'plantillaProductos.php';
	require 'conexion.php';
	$con = conectar();
	$query = "SELECT productos.idProducto, proveedores.nombre as nombrep, productos.nombre, productos.precio, productos.cantidad FROM productos inner JOIN proveedores on proveedores.idProveedor = productos.idProveedor";  
	$resultado = mysqli_query($con,$query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('portrait','letter');
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,7,'ID',1,0,'C',1);
	$pdf->Cell(40,7,'Proveedor',1,0,'C',1);
	$pdf->Cell(47,7,'Producto',1,0,'C',1);
	$pdf->Cell(32,7,'Costo Unitario',1,0,'C',1);
	$pdf->Cell(30,7,'Cantidad',1,0,'C',1);
	$pdf->Cell(28,7,'Costo Total',1,1,'C',1);
	
	$pdf->SetFont('HELVETICA','',10);
	while($row = mysqli_fetch_array($resultado))
	{
		$pdf->Cell(20,9,$row['idProducto'],1,0,'C');
		$pdf->Cell(40,9,ucfirst($row['nombrep']),1,0,'l');
		$pdf->Cell(47,9,$row['nombre'],1,0,'l');
		$pdf->Cell(32,9,"$".$row['precio'],1,0,'C');
		$pdf->Cell(30,9,$row['cantidad'],1,0,'C');
		$pdf->Cell(28,9,"$".($row['precio'] * $row['cantidad']),1,1,'C');
		
	}
	$pdf->Output('','ReporteProductos.pdf');
?>