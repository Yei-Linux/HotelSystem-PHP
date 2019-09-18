<header class="main-header">
 	
	<!--=====================================
	LOGOTIPO
	======================================-->
	<a href="inicio" class="logo">
		
		<!-- logo mini -->
		<span class="logo-mini">
			
			<img src="vistas/img/plantilla/logo.png" class="img-responsive" style="padding:10px">

		</span>

		<!-- logo normal -->

		<span class="logo-lg">
			
			<img src="vistas/img/plantilla/nombre.png" class="img-responsive" style="padding:10px 0px">

		</span>

	</a>

	<!--=====================================
	BARRA DE NAVEGACIÓN
	======================================-->
	<nav class="navbar navbar-static-top" role="navigation">
		
		<!-- Botón de navegación -->

	 	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        	
        	<span class="sr-only">Toggle navigation</span>
      	
      	</a>

		<!-- perfil de usuario -->

		<div class="navbar-custom-menu">
				
			<ul class="nav navbar-nav">
				
				<li class="dropdown user user-menu">
					
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						
						<img src=<?php echo $_SESSION['foto']  ?> class="user-image">

						<span class="hidden-xs"><?php echo $_SESSION['nombres']  ?></span>

					</a>

					<!-- Dropdown-toggle -->

					<ul class="dropdown-menu" style="background-image: url('/SISTEMA_HOTELERIA/vistas/img/plantilla/user.png');background-size: cover;">

						<li class="user-body" style="color:white;text-align: center;">

							<p style="text-align: center">Usuario : <?php echo $_SESSION['usuario'];  ?></p>

						</li>

						<li class="user-body" style="color:white;text-align: center;">
	
							<p style="text-align: center">Tipo de Usuario : <?php echo $_SESSION['perfil'];  ?></p>

						</li>

						<li class="user-body" style="color:white;text-align: center;">
	
							<p style="text-align: center">Hotel : <?php echo $_SESSION['nombreHotel'] ;  ?></p>

						</li>
						
						<li class="user-body" style="color:white;display:flex;justify-content:center;">
							
							<div  style="background-color: gray">

								<a href="salir" class="btn btn-default" style="color:white">Cerrar Sesion</a>

							</div>

						</li>

					</ul>

				</li>

			</ul>

		</div>

	</nav>

 </header>