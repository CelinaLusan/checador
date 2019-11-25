
	<nav class="navbar navbar-expand-md navbar-dark bg-secondary">    
		<img class="rounded-circle border border-warning" src="<?= base_url();?>public/image/logotipo.jpg" width="150px" />
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarCollapse">
	        <ul class="navbar-nav mr-auto">
				<li class="nav-item border-right">
					<a class="nav-link text-warning" href="<?php echo base_url()?>index.php/Salida">
						<i class="fas fa-shipping-fast"></i>
						Registrar Salida<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item border-right">
					<a class="nav-link text-warning" href="<?php echo base_url()?>index.php/Usuario">
					<i class="fas fa-users"></i>
						Choferes<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item border-right">
					<a class="nav-link text-warning" href="<?php echo base_url()?>index.php/Cliente">
						<i class="fas fa-address-book"></i>
						Clientes<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item border-right">
					<a class="nav-link text-warning" href="<?php echo base_url()?>index.php/Moto">
						<i class="fas fa-motorcycle"></i>
						Motos<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-warning" href="<?php echo base_url()?>index.php/Llegada">
						<!-- <i class="far fa-file"></i>-->
						<i class="fas fa-user-clock"></i>
						Registrar Llegada<span class="sr-only">(current)</span>
					</a>
				</li>	
	    	</ul> 
			 
			<ul class="nav navbar-nav navbar-right">
					<li class="nav-item">
							<a class="nav-link text-warning" href="<?php echo base_url()?>index.php/LoginUsers/cerrar_sesion">
								Cerrar sesión
								<!--<i class="fas fa-times-circle"></i>-->
								<span class="sr-only">(current)</span>
								<i class="fas fa-power-off"></i>
							</a>
						</li>
			 </ul>
	    </div>
	</nav>
