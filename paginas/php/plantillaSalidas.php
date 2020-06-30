<?php
	require 'fpdf/fpdf.php';
	class PDF extends FPDF
	{
		public $idProducto;
		public $name;
		public $cantidad;
		public $costo;
		public $costoTotal;
		public function Header()
		{
			$this->Image('../../img/si2.png', 5, 5, 30 );
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10, "Salidas producto: " . $this->name . " con ID: " . $this->idProducto ,0,1,'C');
			$this->SetFont('Arial','',10);
			$this->Cell(120,5, "Cantidad Actual: " . $this->cantidad,0,1,'C');
			$this->Cell(120,5, "Costo Actual: $" . $this->costo,0,1,'C');
			$this->Cell(124,5, "Costo Total: $" . number_format($this->costoTotal,2),0,0,'C');
			$this->Ln(20);
		}
		
		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','B', 10);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}		
	}
?>