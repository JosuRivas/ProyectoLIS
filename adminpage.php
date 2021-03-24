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
		<title>Pagina de admin</title>

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
	    ?>
        <?php
			if(isset($_SESSION['username'])){
				include 'Modulos/navbar2.php';
			}
			else{
				include 'Modulos/navbar.php';
			}
		?>
        <?php
            include "Modulos/log.php"
        ?>
		<?php
			function visitas(){
				$abrir = fopen("assets/js/counter.txt","r");
				if (!$abrir) {
					echo "no se puedo abrir el mensaje";
				}
				else{
					$counter = (int)fread($abrir,20);
					fclose($abrir);
					return $counter;
				}
			}
			function alerta($msg){
                echo "<script>alert('$msg');</script>";
            }			
		?>
		<section id="inicio" class="about-us" style="background: url(assets/images/home/bg-admin.jpg)no-repeat; min-height:615px;">
			<div class="container">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="frmquery">
					<div class="about-us-content">
						<div class="row row-bordered">
							<h1 style="color: white;">Informacion de la pagina - Numero de visitas: <?php echo visitas()?></h1>
							<div class="col-sm-12">
								<div class="single-about-us">
								</div><!--/.single-about-us-->
							</div><!--/.col-->
							<div class="col-sm-0">
								<div class="single-about-us">
									
								</div><!--/.single-about-us-->
							</div><!--/.col-->
						</div><!--/.row-->
						<br>
						<div class="row">
							<div class="col-sm-4">
								<input class="btn btn-primary "type="submit" value="Mostrar vuelos" name="bt-vuelos">
							</div>
							<div class="col-sm-4">
								<input class="btn btn-success "type="submit" value="Mostrar clientes" name="bt-clientes">
							</div>
							<div class="col-sm-4">
								<input class="btn btn-warning "type="submit" value="Mostrar tickets" name="bt-tickets">
							</div>
						</div>
					</div><!--/.about-us-content-->
				</form>
			</div><!--/.container-->
		</section><!--/.about-us-->
		<section class="service">
				<?php
					include "Modulos/conexion_db.php";
					if (isset($_POST['bt-vuelos'])) {
						$date = new DateTime("now");
						$date2 = clone $date;
						$date2 -> add(new DateInterval("P1M"));
						$date = $date ->format('Y-m-d');
						$date2 = $date2 ->format('Y-m-d');
						$sql = "SELECT vuelo.Numero_Vuelo, aerolinea.Nombre, vuelo.Origen, vuelo.Destino, vuelo.Fecha_salida  FROM vuelo INNER JOIN aerolinea ON vuelo.Id_Aerolinea = aerolinea.Id_Aerolinea WHERE vuelo.Fecha_salida BETWEEN '$date' AND '$date2'";
						$result = mysqli_query($conn,$sql);
						if (mysqli_num_rows($result) > 0) {
							echo '<div class="container" style="padding:0">';
                                echo '<table  class="table table-striped table-bordered nowrap" style="background-color:white">';
                                echo '<caption><h3 style="color:Black">Informacion de los vuelos del proximo mes:</h3></caption>';
                                echo '<thead style="background-color:white">';
                                    echo '<tr>';
                                        echo '<th>Numero_Vuelo</th>';
                                        echo '<th>Aerolinea</th>';
                                        echo '<th>Origen</th> ';  
                                        echo '<th>Destino</th>'; 
                                        echo '<th>Fecha_Salida</th>';
                                    echo '</tr>';
                                echo '</thead>';
                                echo ' <tbody>';
							while ($row = mysqli_fetch_row($result)) {
								echo '<tr>';
								echo '<td>' . $row[0].'</td>';
								echo '<td>' . $row[1].'</td>';
								echo '<td>' . $row[2].'</td>';
								echo '<td>' . $row[3].'</td>';
								echo '<td>' . $row[4].'</td>';
								echo '</tr>';
							}	
								echo '</tbody>';
                           		echo '</table>';	
						}
						else {
							alerta("No se encontro ningun vuelo");
						}
						mysqli_close($conn);
					}
					if (isset($_POST['bt-clientes'])) {
						include "Modulos/conexion_db.php";
						$sql = "SELECT Nombre, Edad, email FROM cliente";
						$result = mysqli_query($conn,$sql);
						if (mysqli_num_rows($result) > 0) {
							echo '<div class="container" style="padding:0">';
                                echo '<table  class="table table-striped table-bordered nowrap" style="background-color:white">';
                                echo '<caption><h3 style="color:Black">Informacion de los clientes:</h3></caption>';
                                echo '<thead style="background-color:white">';
                                    echo '<tr>';
                                        echo '<th>Nombre Completo</th>';
                                        echo '<th>Edad</th>';
                                        echo '<th>Email</th> ';  
                                    echo '</tr>';
                                echo '</thead>';
                                echo ' <tbody>';
								while ($row = mysqli_fetch_row($result)) {
									echo '<tr>';
									echo '<td>' . $row[0].'</td>';
									echo '<td>' . $row[1].'</td>';
									echo '<td>' . $row[2].'</td>';
									echo '</tr>';
								}
								echo '</tbody>';
								echo '</table>';
						}
						else{
							alerta("No se encontraron clientes");
						}
						mysqli_close($conn);
					}
					if (isset($_POST['bt-tickets'])) {
						include "Modulos/conexion_db.php";
						$date = new DateTime("now");
						$date2 = clone $date;
						$date2 -> add(new DateInterval("P1M"));
						$date = $date ->format('Y-m-d');
						$date2 = $date2 ->format('Y-m-d');
						$sql = "SELECT pago.Numero_Comprobante, pago.Fecha,vuelo.Numero_Vuelo, cliente.Nombre, pasaje.Asiento, pasaje.Monto FROM pasaje INNER JOIN pago ON pago.Id_Pasaje = pasaje.Id_Pasaje INNER JOIN vuelo ON vuelo.Id_Vuelo = pasaje.Id_vuelo INNER JOIN cliente ON cliente.Id_Cliente = pasaje.Id_Cliente WHERE pago.Fecha BETWEEN '$date' AND '$date2' ";
						$result = mysqli_query($conn,$sql);
						if (mysqli_num_rows($result) > 0) {
							echo '<div class="container" style="padding:0">';
                                echo '<table  class="table table-striped table-bordered nowrap" style="background-color:white">';
                                echo '<caption><h3 style="color:Black">Reservas del ultimo mes:</h3></caption>';
                                echo '<thead style="background-color:white">';
                                    echo '<tr>';
                                        echo '<th>Numero_Comprobante</th>';
                                        echo '<th>Fecha_Pago</th>';
                                        echo '<th>Numero_Vuelo</th> ';
										echo '<th>Nombre Completo</th> ';  
										echo '<th>Asiento</th> ';  
										echo '<th>Monto</th> ';   
                                    echo '</tr>';
                                echo '</thead>';
                                echo ' <tbody>';
								while ($row = mysqli_fetch_row($result)) {
									echo '<tr>';
									echo '<td>' . $row[0].'</td>';
									echo '<td>' . $row[1].'</td>';
									echo '<td>' . $row[2].'</td>';
									echo '<td>' . $row[3].'</td>';
									echo '<td>' . $row[4].'</td>';
									echo '<td>' . $row[5].'</td>';
									echo '</tr>';
							}
							echo '</tbody>';
							echo '</table>';
						}
						else {
							alerta("No se encontro ningun ticket reciente");
						}
					}
				?>
		</section>

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
    