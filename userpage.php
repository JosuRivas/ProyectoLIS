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
		<title>Pagina de usuario</title>

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
			function alerta($msg){
                echo "<script>alert('$msg');</script>";
            }			
		?>
		<section id="inicio" class="about-us" style="background: url(assets/images/home/bg-admin.jpg)no-repeat; min-height:615px;">
			<div class="container">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="frmquery">
					<div class="about-us-content">
						<div class="row row-bordered">
							<h1 style="color: white;">Informacion de sus próximos vuelos</h1>
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
					</div><!--/.about-us-content-->
				</form>
				<?php
					include "Modulos/conexion_db.php";
                    $user = $_SESSION['username'];
                    $date = new DateTime("now");
					$date2 = clone $date;
					$date2 -> add(new DateInterval("P1M"));
					$date = $date ->format('Y-m-d');
					$date2 = $date2 ->format('Y-m-d');
                    $sql = "SELECT Id_Cliente FROM cliente WHERE email = '$user'";
                    $result = mysqli_query($conn,$sql);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_row($result);
                        $id = $row[0];
                    }
					
                    $sql = "SELECT vuelo.Numero_Vuelo, aerolinea.Nombre, vuelo.Origen, vuelo.Destino, vuelo.Fecha_salida,vuelo.Hora,pasaje.Asiento FROM vuelo INNER JOIN aerolinea ON vuelo.Id_Aerolinea = aerolinea.Id_Aerolinea INNER JOIN pasaje ON pasaje.Id_vuelo = vuelo.Id_Vuelo WHERE pasaje.Id_Cliente = '$id' AND vuelo.Fecha_salida BETWEEN '$date' AND '$date2'";
                    $result = mysqli_query($conn,$sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo '<div class="container" style="padding:0">';
                                echo '<table  class="table table-striped table-bordered nowrap" style="background-color:white">';
                                echo '<caption><h3 style="color:Black">Proximos vuelos:</h3></caption>';
                                echo '<thead style="background-color:white">';
                                    echo '<tr>';
                                        echo '<th>Numero de vuelo</th>';
                                        echo '<th>Nombre de la aerolinea</th>';
                                        echo '<th>Aeropuerto de partida</th> ';
										echo '<th>Aeropuerto de destino</th> ';  
										echo '<th>Fecha de salida</th> ';
                                        echo '<th>Hora de salida</th> ';  
										echo '<th>Numero de asiento</th> ';   
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
                                    echo '<td>' . $row[6].'</td>';
									echo '</tr>';
							}
							echo '</tbody>';
							echo '</table>';
						}
						else {
							alerta("No se encontro ningun ticket reciente");
						}
                        mysqli_close($conn); 
				?>
			</div><!--/.container-->
			
		</section><!--/.about-us-->

		<?php
		include 'Modulos/footer.php';
		?>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="assets/js/adminajax.js"></script>
		<script src="assets/js/custom.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>	
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

		
    </body>