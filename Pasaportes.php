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
		<title>Pagina de ingreso de datos</title>

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
			<div class="container"><br><br><br><br><br><br><br><br><br><br>
            <section  class="travel-box">
								<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="frmbusq" id="frmbusq">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-travel-boxes">
                                                    <div id="desc-tabs" class="desc-tabs">
                                                        <ul class="nav nav-tabs" role="tablist">
                                                            <li role="presentation" class="active">
                                                                <a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">
                                                                    <i class="fa fa-plane"></i>
                                                                    
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div role="tabpanel" class="tab-pane active fade in" id="flights">
                                                                <div class="tab-para">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                                                            <div class="single-tab-select-box">
                                                                                <h2>Pasaportes de los viajeros</h2>
                                                                                <?php
                                                                                    for ($i=1; $i <= $_SESSION['num_viajeros'] ; $i++) { 
                                                                                        echo "<input type=\"text\" name=\"passport".$i."\" class=\"form-control\" maxlength=\"9\">";
                                                                                    }
                                                                                ?>
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
																		<div class="col-lg-3 col-md-3 col-sm-4">
                                                                            <div class="single-tab-select-box">
                                                                                <h2>Maletas</h2>
                                                                                <div class="travel-select-icon">
                                                                                    <select class="form-control " name="maleta">
                                                                                        <option value="default">Numero de maletas </option><!-- /.option-->
                                                                                        <option value="1M">1 Maleta + Carry on (Sin costo adicional)</option><!-- /.option-->
                                                                                        <option value="2M">2 Maletas + Carry on (+$100)</option><!-- /.option-->
                                                                                        <option value="3M">3 Maletas + Carry on (+$200)</option><!-- /.option-->
                                                                                    </select><!-- /.select-->
                                                                                </div><!-- /.travel-select-icon -->
                                                                            </div><!--/.single-tab-select-box-->
                                                                        </div><!--/.col-->
                                                                            <div class="col-sm-13">
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
                <?php
        $tipo_vuelo = "";$origen = "";$destino ="";$partida = "";$num_Adultos ="";$num_Niños ="";$id_pasaje = "";
        $clase =""; $id_vuelo = "";$llegada = "";$salida = "";$fecha = "";$hora = "";$vuelo = "";$tarifa = 0;

        include "Modulos/conexion_db.php";
        if(isset($_POST['bt-buscar'])){
            $tipo_vuelo = trim($_POST['radio']);
            $origen = trim($_POST['lugar_partida']);
            $destino = trim($_POST['lugar_destino']);
            $partida = trim($_POST['fecha_ida']);
            $regreso = trim($_POST['fecha_reg']);
            $num_Adultos = (int)trim($_POST['Adultos']);
            $num_Niños = (int)trim($_POST['Niños']);
            $clase = trim($_POST['clase']);$_SESSION['clase'] = $clase;
            $tarifa =  380*$num_Adultos + 280*$num_Niños;
            switch ($clase) {
                case 'A':
                    $tarifa = $tarifa + 500*$num_Adultos +500*$num_Niños;
                    break;
                case 'B':
                    $tarifa = $tarifa + 150*$num_Adultos +150*$num_Niños;
                    break;
                case 'C':
                    break;
                default:
                    break;
            }
            $_SESSION['tarifa'] = $tarifa;
                if ($tipo_vuelo == 'ida-vuelta') {
                    $_SESSION['regreso'] = true;
                    $sql = "SELECT Capacidad FROM vuelo WHERE Destino = '$destino' AND Origen = '$origen' AND Fecha_salida = '$partida'";
                    $result = mysqli_query($conn,$sql);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $cap =  $row['Capacidad'];
                        if ($cap > 0) {
                            $sql2 = "SELECT Id_Vuelo, Origen, Destino, Fecha_salida, Hora, Numero_Vuelo FROM vuelo WHERE Destino = '$destino' AND Origen = '$origen' AND Fecha_salida = '$partida'";
                            $resultado = mysqli_query($conn,$sql2);
                            if(mysqli_num_rows($resultado) > 0){
                                $row = mysqli_fetch_assoc($resultado);
                                $id = $row['Id_Vuelo']; $salida = $row['Origen']; $llegada = $row['Destino']; $fecha = $row['Fecha_salida']; $hora = $row['Hora'];$vuelo = $row['Numero_Vuelo'];$_SESSION['vuelo'] = $vuelo;
                            
                                echo '<div class="container" style="padding:0">';
                                echo '<table  class="table table-striped table-bordered nowrap" style="background-color:white">';
                                echo '<caption><h3 style="color:white">Confirmar informacion del vuelo</h3></caption>';
                                echo '<thead style="background-color:white">';
                                    echo '<tr>';
                                        echo '<th>Vuelo</th>';
                                        echo '<th>Salida</th>';
                                        echo '<th>Llegada</th> ';  
                                        echo '<th>Tarifa</th>'; 
                                        echo '<th></th>';
                                    echo '</tr>';
                                echo '</thead>';
                                echo ' <tbody>';
                                    echo '<tr>';
                                        echo '<td>'.$vuelo.'</td>';
                                        echo '<td>'.$hora.' -> '.$fecha.' -> '.$salida.'</td>';
                                        echo '<td>'.$llegada.'</td>';
                                        echo '<td>$'.$tarifa.'</td>';
                                }
                                else {
                                    echo "No se encontro ningun vuelo";
                                }
                            }
                             else {
                            echo "Ya no queda espacio en el vuelo seleccionado";
                        }
                    }
                    else{
                        echo 'No se enconontro ningun vuelo';
                    }
                    // vuelo de regreso
                    $sql = "SELECT Capacidad FROM vuelo WHERE Destino = '$origen' AND Origen = '$destino' AND Fecha_salida = '$regreso'";
                    $result = mysqli_query($conn,$sql);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $cap = $row['Capacidad'];
                        if ($cap > 0) {
                            $sql = "SELECT Id_Vuelo, Origen, Destino, Fecha_salida, Hora, Numero_Vuelo FROM vuelo WHERE Destino = '$origen' AND Origen = '$destino' AND Fecha_salida = '$regreso'";
                            $result = mysqli_query($conn,$sql);
                            $row = mysqli_fetch_assoc($result);
                            $id = $row['Id_Vuelo']; $salida = $row['Origen']; $llegada = $row['Destino']; $fecha = $row['Fecha_salida']; $hora = $row['Hora'];$vuelo = $row['Numero_Vuelo'];$_SESSION['vuelo_r'] = $vuelo;

                            echo '<tr style="background-color:white">';
                                echo '<td>'.$vuelo.'</td>';
                                echo '<td>'.$hora.' -> '.$fecha.' -> '.$salida.'</td>';
                                echo '<td>'.$llegada.'</td>';
                                echo '<td>$'.$tarifa.'</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td></td>';
                            echo '<td></td>';
                            echo '<td>Total:</td>';
                            echo '<td>$'.$tarifa+$tarifa.'</td>';
                            echo '<td><form action="/PROYECTO/Reserva.php" name="frminsert" method="POST"><input class="btn btn-success" name="bt-confirmar" type="submit" value="Confirmar"></input></form></td>';
                            echo '</tr>';
                            echo '</tbody>';
                            echo '</table>';
                        }
                        else {
                            echo "No hay mas capacidad en el vuelo seleccionado";
                        }
                    }
                    else {
                        alerta("no se encontro ningun vuelo");
                    }
                }
                //vuelo solo de ida
                else{
                    $_SESSION['regreso'] = false;
                    $sql = "SELECT Capacidad FROM vuelo WHERE Destino = '$destino' AND Origen = '$origen' AND Fecha_salida = '$partida'";
                    $result = mysqli_query($conn,$sql);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $cap =  $row['Capacidad'];
                        if ($cap > 0) {
                            $sql2 = "SELECT Id_Vuelo, Origen, Destino, Fecha_salida, Hora, Numero_Vuelo FROM vuelo WHERE Destino = '$destino' AND Origen = '$origen' AND Fecha_salida = '$partida'";
                            $resultado = mysqli_query($conn,$sql2);
                            if(mysqli_num_rows($resultado) > 0){
                                $row = mysqli_fetch_assoc($resultado);
                                $id = $row['Id_Vuelo']; $salida = $row['Origen']; $llegada = $row['Destino']; $fecha = $row['Fecha_salida']; $hora = $row['Hora'];$vuelo = $row['Numero_Vuelo'];$_SESSION['vuelo'] = $vuelo;
                            
                                echo '<div class="container" style="padding:0">';
                                echo '<table  class="table table-striped table-bordered nowrap">';
                                echo '<caption><h3 style="color:white">Confirmar informacion del vuelo</h3></caption>';
                                echo '<thead style="background-color:white">';
                                    echo '<tr>';
                                        echo '<th>Vuelo</th>';
                                        echo '<th>Salida</th>';
                                        echo '<th>Llegada</th> ';  
                                        echo '<th>Subtotal</th>'; 
                                        echo '<th></th>';
                                    echo '</tr>';
                                echo '</thead>';
                                echo ' <tbody>';
                                    echo '<tr>';
                                        echo '<td>'.$vuelo.'</td>';
                                        echo '<td>'.$hora.' -> '.$fecha.' -> '.$salida.'</td>';
                                        echo '<td>'.$llegada.'</td>';
                                        echo '<td>$'.$tarifa.'</td>';
                                        echo '<td><form action="/PROYECTO/Pasaportes.php" name="frminsert" method="POST"><input class="btn btn-success" name="bt-confirmar" type="submit" value="Confirmar"></input></form></td>';
                                    echo '</tr>';
                                    echo '</tbody>';
                                    echo '</table>';
                                }
                                else {
                                    alerta("no se encontro ningun vuelo");
                                }
                            }
                             else {
                            echo "Ya no queda espacio en el vuelo seleccionado";
                        }
                    }
                    else{
                        alerta("no se encontro ningun vuelo");
                    } 
                }    
            mysqli_close($conn);
        }
        include "Modulos/conexion_db.php";
        //confirmacion de vuelo
        if (isset($_POST['bt-confirmar'])) {
            if (isset($_SESSION['username'])) {
                $success = 0;
            $id_cliente = "";
            $comprobante = 0;
            $user = $_SESSION['username'];
            $sql = "SELECT Id_Cliente FROM cliente WHERE email = '$user'";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $id_cliente =  $row['Id_Cliente'];
            }
            else{
                echo "Debe crear un usuario para hacer reservas";
                exit;
            }
            $vuelo = $_SESSION['vuelo'];
            $sql = "SELECT Id_Vuelo FROM vuelo WHERE Numero_Vuelo = '$vuelo'";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $id_vuelo =  $row['Id_Vuelo'];
            }$i = 0;
            while ($i < 222) {
                $seat = randomSeat($_SESSION['clase']);
                $sql = "SELECT * FROM pasaje WHERE Asiento = '$seat'";
                $result = mysqli_query($conn,$sql);
                if (mysqli_num_rows($result) == 0) {
                    break;
                }
            else{
                $i++;
            } 
            }
            $clase = $_SESSION['clase'];$tarifa = $_SESSION['tarifa'];
            $sql = "INSERT INTO pasaje(Id_Cliente,Id_vuelo,Clase,Asiento,Monto) VALUES($id_cliente,'$id_vuelo','$clase','$seat',$tarifa)";
            if (mysqli_query($conn,$sql)) {
                $success += 1;
            }
            else {
                echo "error" . $sql . "<br>" . mysqli_error($conn);
            }
            $sql = "SELECT Id_Pasaje FROM pasaje WHERE Id_Cliente = '$id_cliente' AND Id_vuelo = '$id_vuelo'";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $id_pasaje =  $row['Id_Pasaje'];
            }
            else{
            }
            $sql = "SELECT * FROM pago";
            $result = mysqli_query($conn,$sql);
            $comprobante = (int)mysqli_num_rows($result) + 1 ;
            $date = date("Y-m-d");
            $sql = "INSERT INTO pago(Monto,Numero_Comprobante,Id_Pasaje,Fecha) VALUES($tarifa,$comprobante,$id_pasaje,'$date')";
            if (mysqli_query($conn,$sql)) {
                $success += 1;
            }
            else{
                echo "error" . $sql . "<br>" . mysqli_error($conn);
            }
            $sql = "SELECT Capacidad FROM vuelo WHERE Numero_Vuelo = '$vuelo'";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $cap =  $row['Capacidad'];
                if ($cap > 0) {
                    $sql = "UPDATE vuelo SET Capacidad = Capacidad - 1 WHERE Numero_Vuelo = '$vuelo'";
                    $result = mysqli_query($conn,$sql);
                }
                else {
                    echo "error, ya no quedan espacios en este vuelo";
                }
            }
            // si hay vuelo de ida y regreso
            if ($_SESSION['regreso'] == true) {
                $vuelo = $_SESSION['vuelo_r'];
                $sql = "SELECT Id_Vuelo FROM vuelo WHERE Numero_Vuelo = '$vuelo'";
                $result = mysqli_query($conn,$sql);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $id_vuelo =  $row['Id_Vuelo'];
                }
                $i = 0;
                while ($i < 222) {
                    $seat = randomSeat($_SESSION['clase']);
                    $sql = "SELECT * FROM pasaje WHERE Asiento = '$seat'";
                    $result = mysqli_query($conn,$sql);
                    if (mysqli_num_rows($result) == 0) {
                        break;
                    }
                    else{
                        $i++;
                    } 
                }
                $clase = $_SESSION['clase'];$tarifa = $_SESSION['tarifa'];
                $sql = "INSERT INTO pasaje(Id_Cliente,Id_vuelo,Clase,Asiento,Monto) VALUES($id_cliente,'$id_vuelo','$clase','$seat',$tarifa)";
                if (mysqli_query($conn,$sql)) {
                    $success += 1;
                }
                else {
                    echo "error" . $sql . "<br>" . mysqli_error($conn);
                }

                $sql = "SELECT Id_Pasaje FROM pasaje WHERE Id_Cliente = '$id_cliente' AND Id_vuelo = '$id_vuelo'";
                $result = mysqli_query($conn,$sql);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $id_pasaje =  $row['Id_Pasaje'];
                }
                else{
                }
                $sql = "SELECT * FROM pago";
                $result = mysqli_query($conn,$sql);
                $comprobante = (int)mysqli_num_rows($result) + 1 ;
                $date = date("Y-m-d");
                $sql = "INSERT INTO pago(Monto,Numero_Comprobante,Id_Pasaje,Fecha) VALUES($tarifa,$comprobante,$id_pasaje,'$date')";
                if (mysqli_query($conn,$sql)) {
                    $success += 1;
                }
                else{
                    echo "error" . $sql . "<br>" . mysqli_error($conn);
                }
                $sql = "SELECT Capacidad FROM vuelo WHERE Numero_Vuelo = '$vuelo'";
                $result = mysqli_query($conn,$sql);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $cap =  $row['Capacidad'];
                    if ($cap > 0) {
                        $sql = "UPDATE vuelo SET Capacidad = Capacidad - 1 WHERE Numero_Vuelo = '$vuelo'";
                        $result = mysqli_query($conn,$sql);
                    }
                    else {
                        echo "error, ya no quedan espacios en este vuelo";
                    }
                }
            }
            if ($success == 2 || $success == 4) {
                alerta("Se ha reservado su vuelo satisfactoriamente!");
            }
            else {
                alerta("Ha ocurrido un error al ingresar su vuelo, inténtelo de nuevo");
            }
            }
            else {
                alerta("Debe iniciar sesion con su usuario para poder hacer reservas!");
            }
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