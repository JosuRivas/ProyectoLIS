<?php
		function generacion_nav(){
			$tabs = array(
				"index.php#inicio" => "Inicio",
				"index.php#destinos" => "Destinos",
				"index.php#paquetes" => "Paquetes",
				"index.php#promos" => "Promociones",
				"index.php#info" => "Noticias");
			echo '<ul class="nav navbar-nav navbar-right">';
			foreach ($tabs as $key => $value) {
				echo '<li class="smooth-menu"><a href="'.$key.'">'.$value.'</a></li>';
			}
			
            echo '<li class="smooth-menu"><a href="#" style="color:#08c95f">'.$_SESSION['username']."</a></li>";
			echo '<li><a href="Modulos/logout.php">Cerrar sesion</a></li>';
			echo '</ul>';
		}
		?>
        <!-- main-menu Start -->
		<header class="top-area">
			<div class="header-area">
				<div class="container">
					<div class="row">
						<div class="col-sm-2">
							<div class="logo">
								<a href="index.php">
									Agencia<span>Viajes</span>
								</a>
							</div><!-- /.logo-->
						</div><!-- /.col-->
						<div class="col-sm">
							<div class="main-menu">
								<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
										<i class="fa fa-bars"></i>
									</button><!-- / button-->
								</div><!-- /.navbar-header-->
								<div class="collapse navbar-collapse">		  
									<?php
									generacion_nav();
									?>
								</div><!-- /.navbar-collapse -->
							</div><!-- /.main-menu-->
						</div><!-- /.col-->
					</div><!-- /.row -->
					<div class="home-border"></div><!-- /.home-border-->
				</div><!-- /.container-->
			</div><!-- /.header-area -->

		</header><!-- /.top-area-->