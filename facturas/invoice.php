<?php
	
	$peticionAjax=true;
	
	require_once "../config/APP.php";

	$rut=(isset($_GET['rut'])) ? $_GET['rut']: 0;
//Instancia al controlador clientes para obtener datos
  require_once "../controladores/clienteControlador.php";
  
  $ins_clientes = new clienteControlador();
  $datos_clientes=$ins_clientes->datos_cliente_controlador("Unico",$rut);
  if($datos_clientes->rowCount()==1){

	$datos_clientes=$datos_clientes->fetch();

 

	//Instancia al controlador reservas
	require_once "../controladores/reservasControlador.php";
    $ins_reserva = new reservasControlador();

	$datos_reserva=$ins_reserva->datos_reservas_controlador("Unico",$rut);

	if($datos_reserva->rowCount()==1){
		$datos_reserva=$datos_reserva->fetch();
		

	require "./fpdf.php";

	$pdf = new FPDF('P','mm','Letter');
	$pdf->SetMargins(17,17,17);
	$pdf->AddPage();
	$pdf->Image('../vistas/assets/img/logo.png',10,10,30,30,'PNG');

	$pdf->SetFont('Arial','B',18);
	$pdf->SetTextColor(0,107,181);
	$pdf->Cell(0,10,utf8_decode(strtoupper("RESTO-BAR PLATITA")),0,0,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(-35,10,utf8_decode('N. de factura'),'',0,'C');

	$pdf->Ln(10);

	$pdf->SetFont('Arial','',15);
	$pdf->SetTextColor(0,107,181);
	$pdf->Cell(0,10,utf8_decode(""),0,0,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(-35,10,utf8_decode("".$datos_reserva['id']),'',0,'C');

	$pdf->Ln(25);

	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(36,8,utf8_decode('Fecha de reserva:'),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(27,8,utf8_decode(date("d/m/Y", strtotime("".$datos_reserva['fecha']))),0,0);
	$pdf->Ln(8);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(27,8,utf8_decode('Atendido por:'),"",0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(13,8,utf8_decode("TRABAJADOR"),0,0);

	$pdf->Ln(15);

	$pdf->SetFont('Arial','',12);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(15,8,utf8_decode('Cliente:'),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(65,8,utf8_decode("".$datos_clientes['nombre']."  ".$datos_clientes['apellido']),0,0);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(10,8,utf8_decode('Rut:'),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(40,8,utf8_decode("".$datos_clientes['rut_cliente_pk']),0,0);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(19,8,utf8_decode('Telefono:'),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(35,8,utf8_decode("".$datos_clientes['telefono']),0,0);
	$pdf->SetTextColor(33,33,33);

	$pdf->Ln(8);

	$pdf->Cell(20,8,utf8_decode('Direccion:'),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(109,8,utf8_decode("".$datos_clientes['direccion']),0,0);

	$pdf->Ln(15);

	$pdf->SetFillColor(38,198,208);
	$pdf->SetDrawColor(38,198,208);
	$pdf->SetTextColor(33,33,33);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(15,10,utf8_decode('Cantidad'),1,0,'C',true);
	$pdf->Cell(90,10,utf8_decode('Descripción'),1,0,'C',true);
	$pdf->Cell(51,10,utf8_decode('Fecha - Hora'),1,0,'C',true);
	$pdf->Cell(25,10,utf8_decode(''),1,0,'C',true);

	$pdf->Ln(10);

	$pdf->SetTextColor(97,97,97);


	$pdf->Cell(15,10,utf8_decode("".$datos_reserva['cantidad']),'L',0,'C');
	$pdf->Cell(90,10,utf8_decode("Mesa N°".$datos_reserva['nombre']),'L',0,'C');
	$pdf->Cell(51,10,utf8_decode("".$datos_reserva['fecha']."  ".$datos_reserva['hora_reserva']),'L',0,'C');
	$pdf->Cell(25,10,utf8_decode(""),'LR',0,'C');
	

	$pdf->Ln(10);

	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(15,10,utf8_decode(''),'T',0,'C');
	$pdf->Cell(90,10,utf8_decode(''),'T',0,'C');
	$pdf->Cell(51,10,utf8_decode('TOTAL'),'LTB',0,'C');
	$pdf->Cell(25,10,utf8_decode("$5.000 CLP"),'LRTB',0,'C');

	$pdf->Ln(15);

	

	$pdf->SetFont('Arial','',12);
	if(true){
		$pdf->Ln(12);

		$pdf->SetTextColor(97,97,97);
		$pdf->MultiCell(0,9,utf8_decode("NOTA IMPORTANTE: \n Esta reserva tiene un costo de  $5.000 CLP"),0,'J',false);
	}

	$pdf->Ln(25);

	/*----------  INFO. EMPRESA  ----------*/
	$pdf->SetFont('Arial','B',9);
	$pdf->SetTextColor(33,33,33);
	$pdf->Cell(0,6,utf8_decode("RESTO-BAR PLATITA"),0,0,'C');
	$pdf->Ln(6);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(0,6,utf8_decode("DIRECCION FICTICIA: EL PLATITA 1055, SANTIAGO"),0,0,'C');
	$pdf->Ln(6);
	$pdf->Cell(0,6,utf8_decode("TELEFONO:9XXXXXXX"),0,0,'C');
	$pdf->Ln(6);
	$pdf->Cell(0,6,utf8_decode("CORREO:RESTO-BAR-PLATITA@platita.com "),0,0,'C');


	$pdf->Output("I","Factura_1.pdf",true);

	
}else{
	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo COMPANY;?></title>
	<?php include "../vistas/inc/Link.php"; ?>
</head>
<body>
	
<section class="page_404">
	<div class="container">
		<div class="row">	
		<div class="col-sm-12 ">
		<div class="col-sm-10 col-sm-offset-1  text-center">
		<div class="four_zero_four_bg">
			<h1 class="text-center ">404</h1>
			
		
		</div>
		
		<div class="contant_box_404">
		<h3 class="h2">
		OCurrio un error
		</h3>
		
		<p>No se ha encontrado los datos de la reserva o no existen</p>
		
	
	</div>
		</div>
		</div>
		</div>
	</div>
</section>



<?php 
 include "../vistas/inc/Script.php";
?>
</body>
</html>


<?php
}
}
?>