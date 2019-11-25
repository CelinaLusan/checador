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
		<h3 class="text-center">Registrar chofer</h3>
		<p>Datos obligatorios(<a class="text-danger">*</a>)</p>
		<br>
		<form class="form-horizontal" role="form" action="<?=base_url()?>index.php/Usuario/agregarUsuario" method="POST" >
				<div class="form-group">
					<label><a class="text-danger"> * </a>Elige la moto asignada</label>
					<select class="form-control" name="idMoto" id="idMoto" required>
						<?php
							echo '<option disabled value="0" selected>Elije una moto</option>';
							foreach($arrayMotos as $i => $idMoto)
							echo '<option selected value="'.$i.'">'.$idMoto.'</option>';
						?>
					</select>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="idRol" id="idRol" value="2">	
				</div>
				<div class="form-group">
					<label><a class="text-danger"> * </a>Nombre</label>
					<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre del chofer" required>	
				</div>
				<div class="form-group">
					<label>Apellido</label>
					<input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingresa el apellido">
				</div>
				<div class="form-group">
					<label><a class="text-danger"> * </a>Nombre de usuario</label>
					<input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" placeholder="Ingresa el nombre de usuario" required>
				</div>
				<div class="form-group">
					<label><a class="text-danger"> * </a>Password</label>
					<input type="password" name="password" class="form-control" placeholder="Ingresa una contraseña" required>
				</div>
				<button type="submit"class="btn btn-lg btn-block btn-warning">Agregar chofer</button>
		</form>
	<br>	
<div  class="row">
	<div class="container">
		<div class="col-md-4 float-right">
			<form class="form-inline" role="form" id="buscador">
			      <div class="form-group">
			        <input type="text" name="palabra" class="form-control" placeholder="Buscar chofer" required >
			      </div>
			      	<button type="submit" id="buscar" class="btn btn-success">
				      	<i class="fas fa-search"></i>
			  		</button>
			</form>
		</div>
	</div>
</div>
		
		<div class="table-responsive col-md-offset-3 col-md-12">
			
			<h4>Reporte de choferes registrados</h4>
			<br>
			<table class="table">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Moto</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Apellido</th>
			      <th scope="col">Usuario</th>
				  <th scope="col">Acciones</th>
			    </tr>
			  </thead>
			  	<?php 
			  	if($arrayUsuarios){
			  		echo "<tbody id='respuestaConsulta'>";
			  		foreach($arrayUsuarios as $i => $nombre) {
			  			echo "<tr>
				      		<th scope='row' id='idUsuario'>".$arrayUsuarios[$i]->idUsuario."</th>
				      		<td>".$arrayUsuarios[$i]->idMoto."</td>
				      		<td>".$arrayUsuarios[$i]->nombre."</td>
				      		<td>".$arrayUsuarios[$i]->apellido."</td>
				      		<td>".$arrayUsuarios[$i]->nombreUsuario."</td>";
							
				?>
					<td>
						<a data-id="<?php echo $arrayUsuarios[$i]->idUsuario;?>" class="btn btn-edit btn-sm btn-outline-warning">
							<i class="fas fa-edit"> Editar </i>
						</a>
						<a data-id="<?php echo $arrayUsuarios[$i]->idUsuario;?>" class="btn btn-delete btn-sm btn-outline-danger">
							<i class="fas fa-trash-alt"> Eliminar </i>
						</a>
					</td>
			<?php				
				echo "</tr>";
				}
			  echo "</tbody>";
			  	}
			  ?>
			</table>
		</div>
		
<!-- modal -->		
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
		<h4 class="modal-title">Actualizar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          
        </div>
        <div class="modal-body">
			<div id="form-edit">
				
			</div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
		
    </main>

	<script src="<?= base_url();?>public/js/jquery-3-3-1.js"></script>    
    <script src="<?= base_url();?>public/js/popper.min.js"  ></script>
    <script src="<?= base_url();?>public/js/bootstrap.min.js" ></script>
	<script type="text/javascript">
		document.getElementById("idRol").style.display="none";
		
$(document).ready(function(){
	
	
						$(document).on('click','.btn-delete',function(e){
							id = $(this).data("id");
							console.log(id);
							e.preventDefault();
							p = confirm("Estas seguro?");
							if(p){
								$.get("<?=base_url()?>index.php/Usuario/eliminarUsuario","id="+id,function(data){
									window.location="<?php echo base_url()?>index.php/Usuario";
								});
							}
						});
	
	
			$(document).on('click','#actualizarDatos', function(e){
				//console.log('editar');
				e.preventDefault();
				
				//console.log("act");
				$.post("<?=base_url()?>index.php/Usuario/editarUsuario",$("#actualizar").serialize(),function(data){
					alert("Agregado exitosamente!");
					window.location="<?php echo base_url()?>index.php/Usuario";
				});

			});
			
			
			$(document).on('click',".btn-edit",function(){
		  		id = $(this).data("id");
		  		//console.log("edit");
		  		$.get("<?=base_url()?>index.php/Usuario/getUsuario","id="+id,function(data){
		  			//$("#form-edit").html(data);
					var respuesta = JSON.parse(data);
					var template="";
					var y=0;
					//console.log(respuesta);
					//console.log(respuesta.arrayGetUsuario.idMoto);
					//console.log(respuesta.arrayMotos[0].idMoto);
					
							

				                		template +='<form role="form" id="actualizar" >'+
										'<div class="form-group">'+
											'<label><a class="text-danger"> * </a>Elige la moto asignada</label>'+
											'<select class="form-control" name="idMoto" id="idMoto" required>'+
													'<option disabled value="0" selected>Elije una moto</option>';
					for(y=0;y<respuesta.arrayMotos.length;y++){
						template += '<option selected value="'+ respuesta.arrayMotos[y].idMoto +'">'+respuesta.arrayMotos[y].marca+'</option>';
					}
										template += '</select>'+
										'</div>'+
				'<div class="form-group">'+
					'<label><a class="text-danger"> * </a>Nombre</label>'+
					'<input type="text" value="'+ respuesta.arrayGetUsuario.nombre + ' "class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre del chofer" required>'+	
				'</div>'+
				'<div class="form-group">'+
					'<label>Apellido</label>'+
					'<input type="text" value="' + respuesta.arrayGetUsuario.apellido + ' " name="apellido" id="apellido" class="form-control" placeholder="Ingresa el apellido">'+
				'</div>'+
				'<div class="form-group">'+
					'<label><a class="text-danger"> * </a>Nombre de usuario</label>'+
					'<input type="text" value="'+ respuesta.arrayGetUsuario.nombreUsuario +' " name="nombreUsuario" id="nombreUsuario" class="form-control" placeholder="Ingresa el nombre de usuario" required>'+
				'</div>'+
				'<input type="hidden" name="id" value="'+ respuesta.arrayGetUsuario.idUsuario + '">'+
				'<div class="modal-footer">' +
				  '<button type="submit" class="btn btn-default" id="actualizarDatos" data-dismiss="modal" >Actualizar</button>'+
				'</div>'+
				'</form>';
					
					$("#form-edit").html(template);
					
		  		});
				
		  		$('#editModal').modal('show');
		  	});
			
			
			$(document).on('click','#buscar',function(e){
				e.preventDefault();
				console.log("buscar");

				$.post("<?=base_url()?>index.php/Usuario/buscar",$("#buscador").serialize(),function(data){
					
					//console.log(data);
					var respuesta = JSON.parse(data);
					var template="";


							$.each(respuesta,function(index,value){
				                	//template += "<option value='" + value['id_vehiculo'] + "'>" + value['unidad'] +"</option>";
				                		template += "<tr>"+
									      "<th scope='row' name='idUsuario'>" +value['idUsuario']+ "</th>"+
									      "<td>" +value['idMoto']+ "</td>"+
									      "<td>"+value['nombre']+"</td>"+
											"<td>" +value['apellido']+ "</td>"+
									      "<td>"+value['nombreUsuario']+"</td>"+
										'<td>'+
											'<a data-id="'+ value['idUsuario'] +'" class="btn btn-edit btn-sm btn-outline-warning">'+ 
												'<i class="fas fa-edit"> Editar </i>'+ 
											'</a>'+
											'<a data-id="'+ value['idUsuario'] +'" class="btn btn-delete btn-sm btn-outline-danger"> <i class="fas fa-trash-alt"> Eliminar </i> </a>'+
										'</td>'+
										'</tr>';

				            });


				    	//agregar datos resultantes de consulta
				    	$("#respuestaConsulta").html(template);
				});
			});
			
});
		
	</script>

</body>
</html>