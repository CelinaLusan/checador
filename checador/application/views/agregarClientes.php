<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("America/mexico_city");
?>
<!DOCTYPE html>
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
			if ( isset($mensaje) ) {				
		?>
			<div class="alert <?=$alert?> alert-dismissible fade show" role="alert">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong><?=$title?></strong> <?=$mensaje?>.
			</div>
		<?php
			}
		?>

		<h3 class="text-center">Registrar Clientes</h3>
		<p>Datos obligatorios(<a class="text-danger">*</a>)</p>
		<br>
		<form class="form-horizontal" role="form" action="<?=base_url()?>index.php/Cliente/agregarCliente" method="POST">		
				<div class="form-group">
					<label><a class="text-danger">*</a>Nombre</label>
					<input type="text"  class="form-control" name="nombre" maxlength="40" placeholder="Escribe el nombre del cliente" required>	
				</div>
				<div class="form-group">
					<label>Apellido</label>
					<input type="text"  class="form-control" name="apellido" maxlength="40"  placeholder="Escribe el apellido">	
				</div>
				<div class="form-group">
						<label><a class="text-danger"> * </a>Calle</label>
						<input type="text"  name="calle" class="form-control" maxlength="40" placeholder="Escribe la calle" required>
				</div> 
				<div class="form-group">
						<label><a class="text-danger"> * </a>Colonia</label>
						<input type="text"  name="colonia" class="form-control" maxlength="40" placeholder="Escribe la colonia" required>
				</div> 
				<div class="form-group">
						<label>Notas</label>
						<input type="text" name="notas" class="form-control" maxlength="1000" placeholder="Escribe notas adicionales">
				</div> 
			<button type="submit"class="btn btn-lg btn-block btn-warning">Agregar cliente</button>
		</form>
		<br>
<div  class="row">
	<div class="container">
		<div class="col-md-4 float-right">
			<form class="form-inline" role="form" id="buscador">
			      <div class="form-group">
			        <input type="text" name="palabra" class="form-control" placeholder="Buscar cliente" required >
			      </div>
			     
			      		<button type="submit" id="buscar" class="btn btn-success">
				      		<i class="fas fa-search"></i>
			  			</button>
			  		
			</form>
		</div>
	</div>
</div>
		
		<div class="table-responsive col-md-offset-3 col-md-12">
			
			<h4>Reporte de clientes registrados</h4>
			<br>
			<table class="table">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Apellido</th>
			      <th scope="col">Calle</th>
				  <th scope="col">Colonia</th>
			      <th scope="col">Notas</th>
				  <th scope="col">Acciones</th>
			    </tr>
			  </thead>
			  	<?php 
			  	if($arrayClientes){
			  		echo "<tbody id='respuestaConsulta'>";

			  		foreach($arrayClientes as $i => $nombre) {
			  			echo "<tr>
				      		<th scope='row' id='idCliente'>".$i."</th>
				      		<td>".$arrayClientes[$i]->nombre."</td>
				      		<td>".$arrayClientes[$i]->apellido."</td>
				      		<td>".$arrayClientes[$i]->calle."</td>
							<td>".$arrayClientes[$i]->colonia."</td>
				      		<td>".$arrayClientes[$i]->notas."</td>";
				?>
					<td>
						<a data-id="<?php echo $arrayClientes[$i]->idCliente;?>" class="btn btn-edit btn-sm btn-outline-warning">
							<i class="fas fa-edit"> Editar </i>
						</a>
						<a data-id="<?php echo $arrayClientes[$i]->idCliente;?>" class="btn btn-delete btn-sm btn-outline-danger">
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
	<script>

$(document).ready(function(){
	
	
						$(document).on('click','.btn-delete',function(e){
							id = $(this).data("id");
							console.log(id);
							e.preventDefault();
							p = confirm("Estas seguro?");
							if(p){
								$.get("<?=base_url()?>index.php/Cliente/eliminarCliente","id="+id,function(data){
									window.location="<?php echo base_url()?>index.php/Cliente";
								});
							}
						});
	
	
			$(document).on('click','#actualizarDatos', function(e){
				//console.log('editar');
				e.preventDefault();
				
				//console.log("act");
				$.post("<?=base_url()?>index.php/Cliente/editarCliente",$("#actualizar").serialize(),function(data){
					alert("Agregado exitosamente!");
					window.location="<?php echo base_url()?>index.php/Cliente";
				});

			});
			
			
			$(document).on('click',".btn-edit",function(){
		  		id = $(this).data("id");
		  		//console.log("edit");
		  		$.get("<?=base_url()?>index.php/Cliente/getCliente","id="+id,function(data){
		  			//$("#form-edit").html(data);
					var respuesta = JSON.parse(data);
					var template="";
					var y=0;
					//console.log(respuesta);
					
				template +='<form role="form" id="actualizar" >'+
				'<div class="form-group">'+
					'<label><a class="text-danger">*</a>Nombre</label>'+
					'<input type="text" value="'+respuesta['nombre']+'" class="form-control" name="nombre" maxlength="40" placeholder="Escribe el nombre del cliente" required>'+	
				'</div>'+
				'<div class="form-group">'+
					'<label>Apellido</label>'+
					'<input type="text" value="'+respuesta['apellido']+' " class="form-control" name="apellido" maxlength="40"  placeholder="Escribe el apellido">'+	
				'</div>'+
				'<div class="form-group">'+
						'<label><a class="text-danger"> * </a>Calle</label>'+
						'<input type="text" value="'+respuesta['calle']+' " name="calle" class="form-control" maxlength="40" placeholder="Escribe la calle" required>'+
				'</div>'+ 
				'<div class="form-group">'+
						'<label><a class="text-danger"> * </a>Colonia</label>'+
						'<input type="text" value="'+respuesta['colonia']+'"  name="colonia" class="form-control" maxlength="40" placeholder="Escribe la colonia" required>'+
				'</div>'+ 
				'<div class="form-group">'+
						'<label>Notas</label>'+
						'<input type="text" value="'+respuesta['notas']+'" name="notas" class="form-control" maxlength="1000" placeholder="Escribe notas adicionales">'+
				'</div>'+
				'<input type="hidden" name="id" value="'+ respuesta['idCliente'] + '">'+
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

				$.post("<?=base_url()?>index.php/Cliente/buscar",$("#buscador").serialize(),function(data){
					
					//console.log(data);
					var respuesta = JSON.parse(data);
					var template="";


							$.each(respuesta,function(index,value){
				                	//template += "<option value='" + value['id_vehiculo'] + "'>" + value['unidad'] +"</option>";
				                		template += "<tr>"+
									      "<th scope='row' name='idCliente'>" +index+ "</th>"+
									      "<td>" +value['nombre']+ "</td>"+
									      "<td>"+value['apellido']+"</td>"+
											"<td>" +value['calle']+ "</td>"+
									      "<td>"+value['colonia']+"</td>"+
										  "<td>"+value['notas']+"</td>"+
										'<td>'+
											'<a data-id="'+ value['idCliente'] +'" class="btn btn-edit btn-sm btn-outline-warning">'+ 
												'<i class="fas fa-edit"> Editar </i>'+ 
											'</a>'+
											'<a data-id="'+ value['idCliente'] +'" class="btn btn-delete btn-sm btn-outline-danger"> <i class="fas fa-trash-alt"> Eliminar </i> </a>'+
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