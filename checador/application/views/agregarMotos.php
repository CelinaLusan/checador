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
	<script src="<?= base_url();?>public/js/jquery-3-3-1.js"></script>  
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

		<h3 class="text-center">Registrar Motos</h3>
		<p>Datos obligatorios(<a class="text-danger">*</a>)</p>
		<br>
		<form class="form-horizontal" role="form" action="<?=base_url()?>index.php/Moto/agregarMoto" method="POST" >
			<div class="form-group">
				<div class="form-group">
					<label><a class="text-danger"> * </a>Placas</label>
					<input type="text" class="form-control" name="placas" placeholder="Ingresa las placas" maxlength="10" required>	
				</div>
				<div class="form-group">
					<label><a class="text-danger"> * </a>Marca</label>
					<input type="text"  name="marca" class="form-control" placeholder="Marca" maxlength="40" required>
				</div> 
			</div>
			<button type="submit" class="btn btn-lg btn-block btn-warning">Agregar moto</button>
			<br>
		</form>

<div  class="row">
	<div class="container">
		<div class="col-md-4 float-right">
			<form class="form-inline" role="form" id="buscador">
			      <div class="form-group">
			        <input type="text" name="palabra" class="form-control" placeholder="Buscar moto" required >
			      </div>
			      	<button type="submit" id="buscar" class="btn btn-success">
				      	<i class="fas fa-search"></i>
			  		</button>
			</form>
		</div>
	</div>
</div>

		<div class="table-responsive col-md-offset-3 col-md-12">
			
			<h4>Reporte de motos registradas</h4>
			<br>
			<table class="table">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Marca</th>
			      <th scope="col">Placas</th>
			      <th scope="col">Acciones</th>
			    </tr>
			  </thead>


			  <?php 
			  	if($arrayMotos){
			  		echo "<tbody id='respuestaConsulta'>";

			  		foreach($arrayMotos as $i => $nombre) {
					  	echo "<tr>
						      		<th scope='row' name='idMoto'>".$arrayMotos[$i]->idMoto."</th>
						      		<td>".$arrayMotos[$i]->marca."</td>
						      		<td>".$arrayMotos[$i]->placas."</td>";
				?>
				
				<td>
					<a data-id="<?php echo $arrayMotos[$i]->idMoto;?>" class="btn btn-edit btn-sm btn-outline-warning">
						<i class="fas fa-edit"> Editar </i>
					</a>
					<a data-id="<?php echo $arrayMotos[$i]->idMoto;?>" class="btn btn-delete btn-sm btn-outline-danger">
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

	  
    <script src="<?= base_url();?>public/js/popper.min.js"  ></script>
    <script src="<?= base_url();?>public/js/bootstrap.min.js" ></script>

	
	<script>
	
$(document).ready(function(){ 

//console.log("ya");

			$(document).on('click','#actualizarDatos', function(e){
				//console.log('editar');
				e.preventDefault();
				
				//console.log("act");
				$.post("<?=base_url()?>index.php/Moto/editarMoto",$("#actualizar").serialize(),function(data){
					alert("Agregado exitosamente!");
					window.location="<?php echo base_url()?>index.php/Moto";
				});

			});


			$(document).on('click','.btn-delete',function(e){
							id = $(this).data("id");
							console.log(id);
							e.preventDefault();
							p = confirm("Estas seguro?");
							if(p){
								$.get("<?=base_url()?>index.php/Moto/eliminarMoto","id="+id,function(data){
									window.location="<?php echo base_url()?>index.php/Moto";
								});
							}
						});




			$(document).on('click','#buscar',function(e){
				e.preventDefault();
				
				console.log("buscar");

				$.post("<?=base_url()?>index.php/Moto/buscar",$("#buscador").serialize(),function(data){
					//alert("busqueda exitosa");
					//window.location="<?php echo base_url()?>index.php/Moto";
					//console.log(data);
					var respuesta = JSON.parse(data);
					var template="";


							$.each(respuesta,function(index,value){
				                	//template += "<option value='" + value['id_vehiculo'] + "'>" + value['unidad'] +"</option>";


				                		template += "<tr>"+
									      "<th scope='row' name='idMoto'>" +value['idMoto']+ "</th>"+
									      "<td>" +value['marca']+ "</td>"+
									      "<td>"+value['placas']+"</td>"+

										'<td>'+
											'<a data-id="'+ value['idMoto'] +'" class="btn btn-edit btn-sm btn-outline-warning">'+ 
												'<i class="fas fa-edit"> Editar </i>'+ 
											'</a>'+
											'<a data-id="'+ value['idMoto'] +'" class="btn btn-delete btn-sm btn-outline-danger"> <i class="fas fa-trash-alt"> Eliminar </i> </a>'+
										'</td>'+
										'</tr>';

				            });

				    	//agregar datos resultantes de consulta
				    	$("#respuestaConsulta").html(template);
				});
			});
	
		
			$(document).on('click',".btn-edit",function(){
		  		id = $(this).data("id");
		  		console.log("edit");
		  		$.get("<?=base_url()?>index.php/Moto/getMoto","id="+id,function(data){
		  			//$("#form-edit").html(data);
					var respuesta = JSON.parse(data);
					var template="";
					//console.log(respuesta['placas']);
					template ='<form role="form" id="actualizar" >'+
						 '<div class="form-group">'+
							'<label for="name">Marca</label>'+
							'<input type="text" class="form-control" value='+ respuesta['marca'] + ' name="marca" maxlength="40" required>'+
						  '</div>'+
						  '<div class="form-group">'+
							'<label for="lastname">Placas</label>'+
							'<input type="text" class="form-control" value='+ respuesta['placas'] +' name="placas" maxlength="10" required>'+
						  '</div>'+
						'<input type="hidden" name="id" value="'+ respuesta['idMoto'] + '">'+
						'<div class="modal-footer">' +
						  '<button type="submit" class="btn btn-default" id="actualizarDatos" data-dismiss="modal" >Actualizar</button>'+
						'</div>'+
						'</form>';
					
					//$template=+= "<option value='" + value['id_vehiculo'] + "'>" + value['unidad'] +"</option>";
					$("#form-edit").html(template);
					
		  		});
				
		  		$('#editModal').modal('show');
		  	});

});
	</script>
</body>
</html>