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

		<h3 class="text-center">Registrar Salida</h3>
		<p>Datos obligatorios(<a class="text-danger">*</a>)</p>
		<br>
			<form class="form-horizontal" role="form" action="<?=base_url()?>index.php/Salida/agregarSalida" method="POST" >
				<div class="form-group">
						<label><a class="text-danger"> * </a>Fecha y hora de salida</label>
						<input type="datetime" name="horaSalidaVisible" id="horaSalidaVisible" class="form-control" value="<?php echo $fecha=date("Y-m-d\TH-i");?>" disabled>
						<input type="hidden" name="horaSalida" id="horaSalida" class="form-control" value="<?php echo $fecha=date("Y-m-d\TH-i");?>" >
				</div>
				<div class="form-group">
					<label><a class="text-danger"> * </a>Elige el chofer</label>
					<select class="form-control" name="idChofer" required>
						<?php
							echo '<option disabled required>Elije un chofer</option>';
							foreach($arrayUsuarios as $i => $idUsuario)
							echo '<option selected value="'.$i.'">'.$idUsuario.'</option>';
						?>
					</select>
					<label><a class="text-danger"> * </a>Elige la moto</label>
					<select class="form-control" name="idMoto" required>
						<?php
							echo '<option disabled required>Elije la moto asignada</option>';
							foreach($arrayMotos as $i => $idMoto)
							echo '<option selected value="'.$i.'">'.$idMoto.'</option>';
						?>
					</select>
					<label><a class="text-danger"> * </a>Elige el cliente</label>
					<select class="form-control" name="idCliente" required>
						<?php
							echo '<option disabled required>Elije un cliente</option>';
							foreach($arrayClientes as $i => $idCliente)
							echo '<option selected value="'.$i.'">'.$idCliente.'</option>';
						?>
					</select>
					<div class="form-group">
						<label><a class="text-danger"> * </a>Monto</label>
						<input type="number" step=any class="form-control" name="monto" placeholder="Ingresa el monto" required>	
					</div>
					<div class="form-group">
						<label>Observaciones</label>
						<input type="text" name="observaciones" class="form-control" placeholder="Ingresa las observaciones">
					</div>
					<div>
						<button type="submit"class="btn btn-lg btn-block btn-warning">Agregar registro</button>
					</div>
				</div>
				
			</form>
    </main>

	<script src="<?= base_url();?>public/js/jquery-3-3-1.js"></script>    
    <script src="<?= base_url();?>public/js/popper.min.js"  ></script>
    <script src="<?= base_url();?>public/js/bootstrap.min.js" ></script>
	<script type="text/javascript" >
		var fecha=new Date();
	</script>
</body>
</html>