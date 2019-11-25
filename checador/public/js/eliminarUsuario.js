$(document).ready(function(){  
	//document.title="Eliminar Usuario";
	var nombre="";
	//$("#actUsuarios").addClass("active");


	$("#eliminarUsuario").click(function(event){ 
		$("#formEliminarUsuario").submit();
	});

        $("#formEliminarUsuario").submit(function(event){ 
        //$("#eliminarUsuario").click(function(event){ 
				event.preventDefault();
				if($('#select-usuarios')[0].value == ""){
					console.log("Elige un Usuario");
					$('#select-usuarios').focus();
					return;
				}

				var formData = new FormData($("#formEliminarUsuario")[0]);

				$.ajax({
				url:$(this).attr('action'),
				type:$(this).attr('method'),
				data: formData,
	            cache: false,
	            contentType: false,
	            processData: false,
				success:function(resp){
					//alert(resp);
					console.log(resp);
					if (resp==="Exito") {
						//alert(resp);
						
						$("#formEliminarUsuario")[0].reset();
						actualizaListadoDeUsuarios();
						$("#resultado").html("<p class='text-center alert alert-success'>Eliminado con éxito!! </p>");
						$("#resultado").delay("slow").hide(600);
						$("#resultado").show();
					}else 
						if(resp==="Error"){
							$("#resultado").html("<p class='text-center alert alert-danger'> Ha ocurrido un error :( </p>");
							$("#resultado").delay("slow").hide(600);
							$("#resultado").show();
						}
				}

			});


		});

        	
        	/*Inicio acutalizar select*/
	function actualizaListadoDeUsuarios(){
			//peticion para cancelar el boleto
					var actualiza="";
		        	//console.log(folioCancelado);
		        	$.post("http://localhost/index.php/Eliminar_cliente/get_clientes",{
						actualiza : actualiza
						},
						
						function(response){
							
							//console.log(respuesta,response);
							var template = "<option value = '' >Elige una cliente</option>";
							var respuesta = JSON.parse(response);
							
							$.each(respuesta,function(index,value){
				                	template += "<option value='" + value['id_cliente'] + "'>" + value['nombre'] +"</option>";
				            });
				            console.log(template);
							console.log("aqiuewiruiu");
							$("#select-usuarios").html(template);
				   		})
						.fail(function(jqXHR, textStatus, errorThrown){
				         		console.log("Error");
				        });
						return;
				// fin peticion
		}
/*Fin atualizar select */
        

});