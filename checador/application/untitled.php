
<link rel="stylesheet" href="<?= base_url();?>public/css/main.css?<?= date('Y-m-d H:i:s');?>" >


<main role="main" class="container col-sm-6 col-md-4">
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



		<div class="card">
		<!-- <h1 class="text-center">Bienvenido</h1> -->
		<p class="text-center">
			<img class="img-responsive" src="<?= base_url();?>public/image/logotipo.jpg" alt="" width="150px">
		</p>
			<div class="card-body">

				<div class="d-flex justify-content-center">
					<div class="brand-logo-container">
						<img src="<?= base_url();?>public/image/logotipo.jpg" class="brand-logo" alt="Logo" width="150px"/>
					</div>
				</div>
						<form role="form" action="<?=base_url()?>index.php/LoginUsers/iniciar_sesion" method="POST" >	
									<div class="input-group mb-3">
										<div class="input-group-append">
												<span class="input-group-text"><i class="fas fa-user"></i></span>
										</div>
										<input type="text" class="form-control" name="nombre" maxlength="40" placeholder="Nombre de usuario" required>	
									</div>

									<div class="input-group mb-3">
										<div  class="input-group-append">
											<span class="input-group-text"><i class="fas fa-key"></i></span>
										</div>
										<input type="password"  name="password" class="form-control" placeholder="Tu contraseña" required>
									</div> 
									<br>
								<div class="text-center">
									<button  type="submit"class="btn btn-lg btn-block btn-warning">Login</button>
								</div>
							<p></p>
						</form>
				
			</div>
		</div>
    </main>