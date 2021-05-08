<!doctype html>
<html class="no-js"  lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Rufina:400,700" rel="stylesheet" />

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet" />

		<!-- TITLE OF SITE -->
		<title>Agencia de viajes</title>

		<!-- favicon img -->
		<link rel="shortcut icon" type="image/icon" href="assets/logo/favicon.png"/>

		<!--font-awesome.min.css-->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--animate.css-->
		<link rel="stylesheet" href="assets/css/animate.css" />

		<!--hover.css-->
		<link rel="stylesheet" href="assets/css/hover-min.css">

		<!--datepicker.css-->
		<link rel="stylesheet"  href="assets/css/datepicker.css" >

		<!--owl.carousel.css-->
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
		<link rel="stylesheet" href="assets/css/owl.theme.default.min.css"/>

		<!-- range css-->
        <link rel="stylesheet" href="assets/css/jquery-ui.min.css" />

		<!--bootstrap.min.css-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />

		<!-- bootsnav -->
		<link rel="stylesheet" href="assets/css/bootsnav.css"/>

		<!--style.css-->
		<link rel="stylesheet" href="assets/css/style.css" />

		<!--responsive.css-->
		<link rel="stylesheet" href="assets/css/responsive.css" />

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<body>
	<?php
	session_start();
		$abrir = fopen("assets/js/counter.txt","r");
		if (!$abrir) {
			echo "no se puedo abrir el mensaje";
		}
		else{
			$counter = (int)fread($abrir,20);
			fclose($abrir);
			$counter++;
			$abrir = fopen("assets/js/counter.txt","w");
			fwrite($abrir,$counter);
			fclose($abrir);
		}
	?>
		<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
			your browser</a> to improve your experience and security.</p>
		<![endif]-->
		<?php
			if(isset($_SESSION['username'])){
				include 'Modulos/navbar2.php';
			}
			else{
				include 'Modulos/navbar.php';
			}
		?>
		<!--about-us start -->
		<section id="inicio" class="about-us">
			<div class="container">
				<div class="about-us-content">
					<div class="row">
						<div class="col-sm-12">
							<div class="single-about-us">
								<div class="about-us-txt">
									<h2>
										Reserva tus boletos ahora
									</h2>
									<div class="about-btn">
										<button  class="about-view" onclick="window.location.href='Reserva.php';">
											Reserva ya
										</button>
									</div><!--/.about-btn-->
								</div><!--/.about-us-txt-->
							</div><!--/.single-about-us-->
						</div><!--/.col-->
						<div class="col-sm-0">
							<div class="single-about-us">
								
							</div><!--/.single-about-us-->
						</div><!--/.col-->
					</div><!--/.row-->
				</div><!--/.about-us-content-->
			</div><!--/.container-->

		</section><!--/.about-us-->
		<!--about-us end -->
		<?php
		include("Modulos/log.php");
		?>

							<!--travel-box start-->
							<section  class="travel-box">
								<form action="Reserva.php" method="POST" name="frmbusq" id="frmbusq">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-travel-boxes">
                                                    <div id="desc-tabs" class="desc-tabs">
                                                        <ul class="nav nav-tabs" role="tablist">
                                                            <li role="presentation" class="active">
                                                                <a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">
                                                                    <i class="fa fa-plane"></i>
                                                                    vuelos
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div role="tabpanel" class="tab-pane active fade in" id="flights">
                                                                <div class="tab-para">
                                                                    <div class="trip-circle">
                                                                        <div class="single-trip-circle">
                                                                            <input type="radio" id="radio-ida-reg" name="radio" onchange="hide()" value="ida-vuelta">
                                                                            <label for="radio-ida-reg">
                                                                                <span class="round-boarder">
                                                                                    <span class="round-boarder1"></span>
                                                                                </span>Ida y regreso
                                                                            </label>
                                                                        </div><!--/.single-trip-circle-->
                                                                        <div class="single-trip-circle">
                                                                            <input type="radio" id="radio-ida" name="radio" checked="checked" onchange="hide()" value="ida">
                                                                            <label for="radio-ida">
                                                                                <span class="round-boarder">
                                                                                    <span class="round-boarder1"></span>
                                                                                </span>Solo ida / solo regreso
                                                                            </label>
                                                                        </div><!--/.single-trip-circle-->
                                                                    </div><!--/.trip-circle-->
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                                                            <div class="single-tab-select-box">
                                                                                <h2>Lugar de partida</h2>
                                                                                <div class="travel-select-icon">
                                                                                    <select class="form-control " name="lugar_partida">
																					<option value="default">Ingresa el aeropuerto de partida</option><!-- /.option-->
																					<?php
																						include_once("Modulos/conexion_db.php");
																						$sql = "SELECT DISTINCT Origen FROM vuelo";
																						$result = mysqli_query($conn,$sql);
																						if (mysqli_num_rows($result)>0) {
																							while ($row = mysqli_fetch_assoc($result)) {
																								$destino = $row['Origen'];
																								echo "<option value=\"$destino\">$destino</option>";
																							}
																						}
																						else {
																							echo "<option>No se encontraron vuelos</option>";
																						}
																					?>
                                                                                    </select><!-- /.select-->
                                                                                </div><!-- /.travel-select-icon -->
                                                                            </div><!--/.single-tab-select-box-->
                                                                        </div><!--/.col-->

                                                                        <div class="col-lg-2 col-md-3 col-sm-4">
                                                                            <div class="single-tab-select-box">
                                                                                <h2>Partida</h2>
                                                                                <div class="travel-check-icon">                                                                                
                                                                                        <input type="date" name="fecha_ida" class="form-control">
                                                                                </div><!-- /.travel-check-icon -->
                                                                            </div><!--/.single-tab-select-box-->
                                                                        </div><!--/.col-->

                                                                        <div class="col-lg-2 col-md-3 col-sm-4">
                                                                            <div class="single-tab-select-box">
                                                                                <h2>Regreso</h2>
                                                                                <div class="travel-check-icon">
                                                                                    
                                                                                        <input type="date" name="fecha_reg" class="form-control" id="fecha_regreso" readonly>
                                                                                    
                                                                                </div><!-- /.travel-check-icon -->
                                                                            </div><!--/.single-tab-select-box-->
                                                                        </div><!--/.col-->


                                                                        <div class="col-lg-2 col-md-1 col-sm-4">
                                                                            <div class="single-tab-select-box">
                                                                                <h2>Adultos(+12)</h2>
                                                                                <div>
                                                                                    <input type="number" name="Adultos" id="Adultos" class="form-control" min=0 placeholder="0">
                                                                                </div><!-- /.travel-select-icon -->
                                                                            </div><!--/.single-tab-select-box-->
                                                                        </div><!--/.col-->

                                                                        <div class="col-lg-2 col-md-1 col-sm-4">
                                                                            <div class="single-tab-select-box">
                                                                                <h2>Niños</h2>
                                                                                <div>
                                                                                <input type="number" name="Niños" id="Adultos" class="form-control" min=0 placeholder="0">
                                                                                </div><!-- /.travel-select-icon -->
                                                                            </div><!--/.single-tab-select-box-->
                                                                        </div><!--/.col-->

                                                                    </div><!--/.row-->

                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                                                            <div class="single-tab-select-box">

                                                                                <h2>Lugar de destino</h2>

                                                                                <div class="travel-select-icon">
                                                                                    <select class="form-control " name="lugar_destino">

                                                                                        <option value="default">Ingresa el lugar de destino</option><!-- /.option-->
																						<?php
																							include_once("Modulos/conexion_db.php");
																							$sql = "SELECT DISTINCT Destino FROM vuelo";
																							$result = mysqli_query($conn,$sql);
																							if (mysqli_num_rows($result)>0) {
																								while ($row = mysqli_fetch_assoc($result)) {
																									$destino = $row['Destino'];
																									echo "<option value=\"$destino\">$destino</option>";
																								}
																							}
																							else {
																								echo "<option>No se encontraron vuelos</option>";
																							}
																						?>
                                                                                    </select><!-- /.select-->
                                                                                </div><!-- /.travel-select-icon -->
                                                                            </div><!--/.single-tab-select-box-->
                                                                        </div><!--/.col-->
                                                                        <div class="col-lg-3 col-md-3 col-sm-4">
                                                                            <div class="single-tab-select-box">

                                                                                <h2>Clase</h2>
                                                                                <div class="travel-select-icon">
                                                                                    <select class="form-control " name="clase">
                                                                                        <option value="default">Ingresa la clase</option><!-- /.option-->
                                                                                        <option value="A">Primera clase</option><!-- /.option-->
                                                                                        <option value="B">Ejecutiva</option><!-- /.option-->
                                                                                        <option value="C">Economica</option><!-- /.option-->
                                                                                    </select><!-- /.select-->
                                                                                </div><!-- /.travel-select-icon -->
                                                                            </div><!--/.single-tab-select-box-->
                                                                        </div><!--/.col-->
                                                                            <div class="col-sm-5">
                                                                                <div class="about-btn pull-right">
                                                                                    <input type="submit" class="about-view travel-btn" id="bt-buscar" name="bt-buscar" value="Buscar"><!--/.travel-btn-->                                                                         
                                                                                </div><!--/.about-btn-->
                                                                            </div><!--/.col-->
                                                                    
                                                                        </div><!--/.row-->
                                                                    </div>
                                                            </div><!--/.tabpannel-->
                                                        </div><!--/.tab content-->
                                                    </div><!--/.desc-tabs-->
                                                </div><!--/.single-travel-box-->
                                            </div>
                                        </div>
                                    </div>
                                </form>
    						</section><!--/.travel-box-->
		<!--travel-box end-->

        <!--service start-->
		<section id="service" class="service">
			<div class="container">

				<div class="service-counter text-center">

					<div class="col-md-4 col-sm-4">
						<div class="single-service-box">
							<div class="service-img">
								<img src="assets/images/service/s1.png" alt="service-icon" />
							</div><!--/.service-img-->
							<div class="service-content">
								<h2>
									<a href="#">
									Escoge entre muchos destinos
									</a>
								</h2>
								<p>Destinos impresionantes para disfrutar de las vacaciones</p>
							</div><!--/.service-content-->
						</div><!--/.single-service-box-->
					</div><!--/.col-->

					<div class="col-md-4 col-sm-4">
						<div class="single-service-box">
							<div class="service-img">
								<img src="assets/images/service/s2.png" alt="service-icon" />
							</div><!--/.service-img-->
							<div class="service-content">
								<h2>
									<a href="#">
										Disfruta de nuestros paquetes
									</a>
								</h2>
								<p>Paquetes de viaje y estadía para que no te preocupes de nada!</p>
							</div><!--/.service-content-->
						</div><!--/.single-service-box-->
					</div><!--/.col-->

					<div class="col-md-4 col-sm-4">
						<div class="single-service-box">
							<div class="statistics-img">
								<img src="assets/images/service/s3.png" alt="service-icon" />
							</div><!--/.service-img-->
							<div class="service-content">

								<h2>
									<a href="#">
										Reserva tus vuelos en línea
									</a>
								</h2>
								<p>Resérvalos instantáneamente usando nuestra agencia</p>
							</div><!--/.service-content-->
						</div><!--/.single-service-box-->
					</div><!--/.col-->

				</div><!--/.statistics-counter-->	
			</div><!--/.container-->

		</section><!--/.service-->
		<!--service end-->

		<!--galley start-->
		<section id="destinos" class="gallery">
			<div class="container">
				<div class="gallery-details">
					<div class="gallary-header text-center">
						<h2>
							Destinos destacados
						</h2>
						<p>
							¿A donde quieres ir? ¿Cuanto quieres explorar?  
						</p>
					</div><!--/.gallery-header-->
					<div class="gallery-box">
						<div class="gallery-content">
						  	<div class="filtr-container">
						  		<div class="row">

						  			<div class="col-md-6">
						  				<div class="filtr-item">
											<img src="assets/images/gallary/g1.jpg" alt="portfolio image"/>
											<div class="item-title">
												<a href="#">
													China
												</a>
												<p><span>15 Paquetes</span><span>12 Lugares</span>
											</div><!-- /.item-title -->
										</div><!-- /.filtr-item -->
						  			</div><!-- /.col -->

						  			<div class="col-md-6">
						  				<div class="filtr-item">
											<img src="assets/images/gallary/g2.jpg" alt="portfolio image"/>
											<div class="item-title">
												<a href="#">
													Venezuela
												</a>
												<p><span>12 Paquetes</span><span>9 lugares</span></p>
											</div> <!-- /.item-title-->
										</div><!-- /.filtr-item -->
						  			</div><!-- /.col -->

						  			<div class="col-md-4">
						  				<div class="filtr-item">
											<img src="assets/images/gallary/g3.jpg" alt="portfolio image"/>
											<div class="item-title">
												<a href="#">
													Brasil
												</a>
												<p><span>25 Paquetes</span><span>10 Lugares</span></p>
											</div><!-- /.item-title -->
										</div><!-- /.filtr-item -->
						  			</div><!-- /.col -->

						  			<div class="col-md-4">
						  				<div class="filtr-item">
											<img src="assets/images/gallary/g4.jpg" alt="portfolio image"/>
											<div class="item-title">
												<a href="#">
													Australia 
												</a>
												<p><span>18 Paquetes</span><span>9 Lugares</span></p>
											</div> <!-- /.item-title-->
										</div><!-- /.filtr-item -->
						  			</div><!-- /.col -->

						  			<div class="col-md-4">
						  				<div class="filtr-item">
											<img src="assets/images/gallary/g5.jpg" alt="portfolio image"/>
											<div class="item-title">
												<a href="#">
													Holanda
												</a>
												<p><span>14 Paquetes</span><span>12 Lugares</span></p>
											</div> <!-- /.item-title-->
										</div><!-- /.filtr-item -->
						  			</div><!-- /.col -->

						  			<div class="col-md-8">
						  				<div class="filtr-item">
											<img src="assets/images/gallary/g6.jpg" alt="portfolio image"/>
											<div class="item-title">
												<a href="#">
													Turquia
												</a>
												<p><span>14 Paquetes</span><span>6 Lugares</span></p>
											</div> <!-- /.item-title-->
										</div><!-- /.filtr-item -->
						  			</div><!-- /.col -->

						  		</div><!-- /.row -->

						  	</div><!-- /.filtr-container-->
						</div><!-- /.gallery-content -->
					</div><!--/.galley-box-->
				</div><!--/.gallery-details-->
			</div><!--/.container-->

		</section><!--/.gallery-->
		<!--gallery end-->

		<!--packages start-->
		<section id="paquetes" class="packages">
			<div class="container">
				<div class="gallary-header text-center">
					<h2>
						Paquetes especiales
					</h2>
					<p>
						Viajes con estadía y alimentos incluidos para que disfrutes al máximo de tu vacación
					</p>
				</div><!--/.gallery-header-->
				<div class="packages-content">
					<div class="row">
						<div class="col-md-4 col-sm-6">
							<div class="single-package-item">
								<img src="assets/images/packages/p1.jpg" alt="package-place">
								<div class="single-package-item-txt">
									<h3>Italia <span class="pull-right">$499</span></h3>
									<div class="packages-para">
										<p>
											<span>
												<i class="fa fa-angle-right"></i> 3 Dias 2 noches
											</span>
											<i class="fa fa-angle-right"></i>  acomodación 5 estrellas
										</p>
										<p>
											<span>
												<i class="fa fa-angle-right"></i>  Con transporte
											</span>
											<i class="fa fa-angle-right"></i> Con restaurante
										 </p>
									</div><!--/.packages-para-->
									<div class="packages-review">
										<p>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<span>254 reseñas</span>
										</p>
									</div><!--/.packages-review-->
									<div class="about-btn">
										<button  class="about-view packages-btn">
											Reserva ya
										</button>
									</div><!--/.about-btn-->
								</div><!--/.single-package-item-txt-->
							</div><!--/.single-package-item-->

						</div><!--/.col-->

						<div class="col-md-4 col-sm-6">
							<div class="single-package-item">
								<img src="assets/images/packages/p2.jpg" alt="package-place">
								<div class="single-package-item-txt">
									<h3>Inglaterra<span class="pull-right">$1499</span></h3>
									<div class="packages-para">
										<p>
											<span>
												<i class="fa fa-angle-right"></i> 6 Dias 7 noches
											</span>
											<i class="fa fa-angle-right"></i>  acomodación 5 estrellas
										</p>
										<p>
											<span>
												<i class="fa fa-angle-right"></i>  Con transporte
											</span>
											<i class="fa fa-angle-right"></i>  Comida incluida
										 </p>
									</div><!--/.packages-para-->
									<div class="packages-review">
										<p>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<span>344 reseñas</span>
										</p>
									</div><!--/.packages-review-->
									<div class="about-btn">
										<button  class="about-view packages-btn">
											Reserva ya
										</button>
									</div><!--/.about-btn-->
								</div><!--/.single-package-item-txt-->
							</div><!--/.single-package-item-->

						</div><!--/.col-->
						
						<div class="col-md-4 col-sm-6">
							<div class="single-package-item">
								<img src="assets/images/packages/p3.jpg" alt="package-place">
								<div class="single-package-item-txt">
									<h3>Francia<span class="pull-right">$1199</span></h3>
									<div class="packages-para">
										<p>
											<span>
												<i class="fa fa-angle-right"></i> 5 Dias 6 noches
											</span>
											<i class="fa fa-angle-right"></i>  acomodación 5 estrellas
										</p>
										<p>
											<span>
												<i class="fa fa-angle-right"></i>  Con transporte
											</span>
											<i class="fa fa-angle-right"></i>  Con restaurante
										 </p>
									</div><!--/.packages-para-->
									<div class="packages-review">
										<p>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<span>544 reseñas</span>
										</p>
									</div><!--/.packages-review-->
									<div class="about-btn">
										<button  class="about-view packages-btn">
											Reserva ya
										</button>
									</div><!--/.about-btn-->
								</div><!--/.single-package-item-txt-->
							</div><!--/.single-package-item-->

						</div><!--/.col-->
						
						<div class="col-md-4 col-sm-6">
							<div class="single-package-item">
								<img src="assets/images/packages/p4.jpg" alt="package-place">
								<div class="single-package-item-txt">
									<h3>India<span class="pull-right">$799</span></h3>
									<div class="packages-para">
										<p>
											<span>
												<i class="fa fa-angle-right"></i> 4 Dias 5 noches
											</span>
											<i class="fa fa-angle-right"></i>  acomodación 5 estrellas
										</p>
										<p>
											<span>
												<i class="fa fa-angle-right"></i>  Con transporte
											</span>
											<i class="fa fa-angle-right"></i>  Con restaurante
										 </p>
									</div><!--/.packages-para-->
									<div class="packages-review">
										<p>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<span>625 reseñas</span>
										</p>
									</div><!--/.packages-review-->
									<div class="about-btn">
										<button  class="about-view packages-btn">
											Reserva ya
										</button>
									</div><!--/.about-btn-->
								</div><!--/.single-package-item-txt-->
							</div><!--/.single-package-item-->

						</div><!--/.col-->
						
						<div class="col-md-4 col-sm-6">
							<div class="single-package-item">
								<img src="assets/images/packages/p5.jpg" alt="package-place">
								<div class="single-package-item-txt">
									<h3>España<span class="pull-right">$999</span></h3>
									<div class="packages-para">
										<p>
											<span>
												<i class="fa fa-angle-right"></i> 4 Dias 4 noches
											</span>
											<i class="fa fa-angle-right"></i>  acomodación 5 estrellas
										</p>
										<p>
											<span>
												<i class="fa fa-angle-right"></i>  Con transporte
											</span>
											<i class="fa fa-angle-right"></i>  Con restaurante
										 </p>
									</div><!--/.packages-para-->
									<div class="packages-review">
										<p>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<span>379 reseñas</span>
										</p>
									</div><!--/.packages-review-->
									<div class="about-btn">
										<button  class="about-view packages-btn">
											Reserva ya
										</button>
									</div><!--/.about-btn-->
								</div><!--/.single-package-item-txt-->
							</div><!--/.single-package-item-->

						</div><!--/.col-->
						
						<div class="col-md-4 col-sm-6">
							<div class="single-package-item">
								<img src="assets/images/packages/p6.jpg" alt="package-place">
								<div class="single-package-item-txt">
									<h3>Tailandia<span class="pull-right">$799</span></h3>
									<div class="packages-para">
										<p>
											<span>
												<i class="fa fa-angle-right"></i> 5 Dias 6 noches
											</span>
											<i class="fa fa-angle-right"></i>  acomodación 5 estrellas
										</p>
										<p>
											<span>
												<i class="fa fa-angle-right"></i>  Con transporte
											</span>
											<i class="fa fa-angle-right"></i>  Con restaurante
										 </p>
									</div><!--/.packages-para-->
									<div class="packages-review">
										<p>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<span>447 reseñas</span>
										</p>
									</div><!--/.packages-review-->
									<div class="about-btn">
										<button  class="about-view packages-btn">
											Reserva ya
										</button>
									</div><!--/.about-btn-->
								</div><!--/.single-package-item-txt-->
							</div><!--/.single-package-item-->

						</div><!--/.col-->

					</div><!--/.row-->
				</div><!--/.packages-content-->
			</div><!--/.container-->

		</section><!--/.packages-->
		<!--packages end-->

		<!--special-offer start-->
		<section id="promos" class="special-offer">
			<div class="container">
				<div class="special-offer-content">
					<div class="row">
						<div class="col-sm-8">
							<div class="single-special-offer">
								<div class="single-special-offer-txt">
									<h2>Tailandia</h2>
									<div class="packages-review special-offer-review">
										<p>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<span>2544 reseñas</span>
										</p>
									</div><!--/.packages-review-->
									<div class="packages-para special-offer-para">
										<p>
											<span>
												<i class="fa fa-angle-right"></i> 5 Dias 4 noches
											</span>
											<span>
												<i class="fa fa-angle-right"></i> 2 personas
											</span>
											<span>
												<i class="fa fa-angle-right"></i>  Acomodacion 5 estrellas
											</span>
										</p>
										<p>
											<span>
												<i class="fa fa-angle-right"></i>  Con transporte
											</span>
											<span>
												<i class="fa fa-angle-right"></i>  Con restaurante
											</span>  
										</p>
										<p class="offer-para">
		 
										</p>
									</div><!--/.packages-para-->
									<div class="offer-btn-group">
										<div class="about-btn">
											<button  class="about-view packages-btn">
												Reserva ya
											</button>
										</div><!--/.about-btn-->
									</div><!--/.offer-btn-group-->
								</div><!--/.single-special-offer-txt-->
							</div><!--/.single-special-offer-->
						</div><!--/.col-->
						<div class="col-sm-4">
							<div class="single-special-offer">
								<div class="single-special-offer-bg">
									<img src="assets/images/offer/offer-shape.png" alt="offer-shape">
								</div><!--/.single-special-offer-bg-->
								<div class="single-special-shape-txt">
									<h3>Oferta especial</h3>
									<h4><span>40%</span><br>descuento</h4>
									<p><span>$999</span><br>regular $ 1450</p>
								</div><!--/.single-special-shape-txt-->
							</div><!--/.single-special-offer-->
						</div><!--/.col-->
					</div><!--/.row-->
				</div><!--/.special-offer-content-->
			</div><!--/.container-->

		</section><!--/.special-offer end-->
		<!--special-offer end-->

		<!--blog start-->
		<section id="info" class="blog">
			<div class="container">
				<div class="blog-details">
						<div class="gallary-header text-center">
							<h2>
								Ultimas noticias
							</h2>
							<p>
								Noticias relevantes de todo el mundo
							</p>
						</div><!--/.gallery-header-->
						<div class="blog-content">
							<div class="row">

								<div class="col-sm-4 col-md-4">
									<div class="thumbnail">
										<h2>20 diciembre 2020</h2>
										<div class="thumbnail-img">
											<img src="assets/images/blog/b1.jpg" alt="blog-img">
											<div class="thumbnail-img-overlay"></div><!--/.thumbnail-img-overlay-->
										
										</div><!--/.thumbnail-img-->
									  
										<div class="caption">
											<div class="blog-txt">
												<h3>
													<a href="#">
														Medidas de bioseguridad para pasajeros a tomar en cuenta al volar
													</a>
												</h3>
												<p>
													Lorem ipsum dolor sit amet, contur adip elit, sed do mod incid ut labore et dolore magna aliqua. Ut enim ad minim veniam 
												</p>
												<a href="#">Ver Más</a>
											</div><!--/.blog-txt-->
										</div><!--/.caption-->
									</div><!--/.thumbnail-->

								</div><!--/.col-->

								<div class="col-sm-4 col-md-4">
									<div class="thumbnail">
										<h2>8 enero 2021</h2>
										<div class="thumbnail-img">
											<img src="assets/images/blog/b2.jpg" alt="blog-img">
											<div class="thumbnail-img-overlay"></div><!--/.thumbnail-img-overlay-->
										
										</div><!--/.thumbnail-img-->
										<div class="caption">
											<div class="blog-txt">
												<h3>
													<a href="#">
														Nuevas fechas de apertura de aeropuertos
													</a>
												</h3>
												<p>
													Lorem ipsum dolor sit amet, contur adip elit, sed do mod incid ut labore et dolore magna aliqua. Ut enim ad minim veniam 
												</p>
												<a href="#">Ver Más</a>
											</div><!--/.blog-txt-->
										</div><!--/.caption-->
									</div><!--/.thumbnail-->

								</div><!--/.col-->

								<div class="col-sm-4 col-md-4">
									<div class="thumbnail">
										<h2>22 febrero 2021</h2>
										<div class="thumbnail-img">
											<img src="assets/images/blog/b3.jpg" alt="blog-img">
											<div class="thumbnail-img-overlay"></div><!--/.thumbnail-img-overlay-->
										
										</div><!--/.thumbnail-img-->
										<div class="caption">
											<div class="blog-txt">
												<h3><a href="#">Probabilidades de contagiarse de Covid en un vuelo</a></h3>
												<p>
													Lorem ipsum dolor sit amet, contur adip elit, sed do mod incid ut labore et dolore magna aliqua. Ut enim ad minim veniam 
												</p>
												<a href="#">Ver Más</a>
											</div><!--/.blog-txt-->
										</div><!--/.caption-->
									</div><!--/.thumbnail-->

								</div><!--/.col-->

							</div><!--/.row-->
						</div><!--/.blog-content-->
					</div><!--/.blog-details-->
				</div><!--/.container-->

		</section><!--/.blog-->
		<!--blog end-->

		
		
		<?php
		include 'Modulos/footer.php';
		?>


		<script src="assets/js/jquery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->

		<!--modernizr.min.js-->
		<script  src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>


		<!--bootstrap.min.js-->
		<script  src="assets/js/bootstrap.min.js"></script>

		<!-- bootsnav js -->
		<script src="assets/js/bootsnav.js"></script>

		<!-- jquery.filterizr.min.js -->
		<script src="assets/js/jquery.filterizr.min.js"></script>

		<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

		<!--jquery-ui.min.js-->
        <script src="assets/js/jquery-ui.min.js"></script>

        <!-- counter js -->
		<script src="assets/js/jquery.counterup.min.js"></script>
		<script src="assets/js/waypoints.min.js"></script>

		<!--owl.carousel.js-->
        <script  src="assets/js/owl.carousel.min.js"></script>

        <!-- jquery.sticky.js -->
		<script src="assets/js/jquery.sticky.js"></script>

        <!--datepicker.js-->
        <script  src="assets/js/datepicker.js"></script>

		<!--Custom JS-->
		<script src="assets/js/custom.js"></script>

	</body>
</html>