<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("America/mexico_city");
?><!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?= base_url();?>public/css/bootstrap.min.css" >
	<link rel="stylesheet" href="<?= base_url();?>public/css/main2.css?<?= date('Y-m-d H:i:s');?>" >
	<script src="https://kit.fontawesome.com/68e3a45157.js" crossorigin="anonymous"></script>

	<title>Checador</title>    
</head>
<body>

	

	<main role="main" class="container">
	<?php $this->load->view('layout/navbar'); ?>	
	<br>
		<?php
			if ( isset($mensaje ) ) {				
		?>
		<div class="alert <?=$alert?> alert-dismissible fade show" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong><?=$title?></strong> <?=$mensaje?>.
		</div>
		<?php
			}
		?>

		<h3 class="text-center">Registrar Llegada</h3>
		<p>Datos obligatorios(<a class="text-danger">*</a>)</p>
		<br>
		<form class="form-horizontal" role="form" action="<?=base_url()?>index.php/Llegada/agregarLlegada" method="POST" >
			<div class="form-group">
					<label>Fecha y hora de llegada</label>
					<input type="datetime" name="horaLlegadaVisible" id="horaSalidaVisible" class="form-control" value="<?php echo $fecha=date("Y-m-d\TH-i");?>" disabled>
					<input type="hidden" name="horaLlegada" id="horaLlegada" class="form-control" value="<?php echo $fecha=date("Y-m-d\TH-i");?>" >
			</div>
			<div class="form-group">
				<label>Elige tu registro</label>
				<select class="form-control" name="idRegistro" required>
					<?php
						echo '<option disabled required>Elije tu salida</option>';
						foreach($arrayRegistros as $i => $idRegistro)
						echo '<option selected value="'.$i.'">'.$idRegistro.'</option>';
					?>
				</select>
			</div>
			<button type="submit"class="btn btn-lg btn-block btn-warning">Terminar entrega</button>
		</form>
    </main>

	<script src="<?= base_url();?>public/js/jquery-3-3-1.js"></script>    
    <script src="<?= base_url();?>public/js/popper.min.js"  ></script>
    <script src="<?= base_url();?>public/js/bootstrap.min.js" ></script>
</body>
</html>