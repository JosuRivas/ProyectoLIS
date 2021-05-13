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
								while ($row = mysqli_fetch_assoc($result)) {
									echo '<tr>';
									echo '<td>' . $row['Numero_Comprobante'].'</td>';
									echo '<td>' . $row['Fecha'].'</td>';
									echo '<td>' . $row['Numero_Vuelo'].'</td>';
									echo '<td>' . $row['Nombre'].'</td>';
									echo '<td>' . $row['Asiento'].'</td>';
									echo '<td>' . $row['Monto'].'</td>';
									echo '</tr>';
							}
							echo '</tbody>';
							echo '</table>';
						}
						else {
							alerta("No se encontro ningun ticket reciente");
						}
						mysqli_close($conn);
					}
					
				?>
			</div><!--/.container-->
			
		</section><!--/.about-us-->
		<section class="travel-box" id="Controls">
		<div class="container p-3"><h2>Herramientas de administrador</h2></div><br>
		<div id="exTab2" class="container border border-success p-3 rounded">	
    	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="frm-menu" id="frm-menu"> 
        	<ul class="nav nav-tabs nav-fill">
				<li class="active nav-item text-dark">
                <a class="text-light bg-info nav-link" href="#1" data-toggle="tab" id="esconder1">Agregar vuelo nuevo</a>
				</li>
				<li class="nav-item"><a class="text-light bg-info nav-link" href="#2" data-toggle="tab" id="mostrar">Aregar aerolinea nueva</a>
				</li>
				<li class="nav-item"><a class="text-light bg-info nav-link" href="#3" data-toggle="tab" id="esconder2">Eliminar vuelos</a>
				</li>
           	 	<li class="nav-item"><a class="text-light bg-info nav-link" href="#4" data-toggle="tab" id="esconder3">Modificar vuelos</a>
				</li>
			</ul>
        <br>
			<div class="tab-content ">
			    <div class="tab-pane active" id="1">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-3">
                                <h3>Nombre aerolinea:</h3>
                                <select name="NombreA" id="NombreA" class="form-control">
								<?php
									include "Modulos/conexion_db.php";
									$sql = "SELECT Nombre FROM Aerolinea";
									$result = mysqli_query($conn,$sql);
									if (mysqli_num_rows($result)>0) {
										while ($row = mysqli_fetch_assoc($result)) {
											$nombre = $row['Nombre'];
											echo "<option value=\"$nombre\">$nombre</option>";
										}
									}
								?>
								</select>
                            </div>
                            <div class="col-sm-3">
                                <h3>Capacidad del vuelo:</h3>
                                <input type="text" name="CapacidadV" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <h3>Aeropuerto Origen</h3>
                                <input type="text" name="Origen" class="form-control" style="width: 240px;" step=".01">
                            </div>
                        </div><br>
						<div class="row">
							<div class="col-sm-3">
								<h3>Aeropuerto destino:</h3>
								<input type="text" name="Destino" class="form-control">
							</div>
							<div class="col-sm-3">
								<h3>Fecha salida:</h3>
								<input type="date" class="form-control" name="FechaSalida">
							</div>
							<div class="col-sm-3">
								<h3>Hora partida:</h3> 
								<input type="time" class="form-control" name="HoraPartida" value="22:10">
							</div>
						</div><br>
                        <div class="row">
							<div class="col-sm-3">
								<h3>Codigo de vuelo:</h3>
								<input type="text" class="form-control" name="CodigoVuelo">
							</div>
                            <div class="col-sm-3" style="margin-top: 52px;">
                            <input type="submit" class="btn btn-danger form-control" name="bt-ingresar-vuelo" value="Ingresar" >
                            </div>
                        </div>
                    </div>        
			    </div>
				<div class="tab-pane" id="2">
                    <div class="row">
						<div class="col-sm-3">
							<h3>Nombre aerolinea:</h3>
							<input type="text" name="NombreAerolinea" class="form-control">
						</div>
						<div class="col-sm-3">
							<h3>Codigo de pais:</h3>
							<input type="text" name="CodigoPais" class="form-control">
						</div>
						<div class="col-sm-3">
							<h3>Telefono:</h3>
							<input type="text" name="Telefono" class="form-control">
						</div>
					</div><br>
					<div class="row">
					<div class="col-sm-3">
						<input type="submit" class="btn btn-danger form-control" name="bt-ingresar-aerolinea" value="Ingresar">
					</div>
					</div>
				</div>
                <div class="tab-pane" id="3">
                    <div class="row">
                        <div class="col-sm-4">
						<h3>Ingrese el Codigo de vuelo del vuelo a eliminar:</h3>
                            <input type="text" class="form-control" name="BorrarVuelo"><br>
                            <input type="submit" class="btn btn-warning form-control" name="bt-delete" value="Eliminar" id="eliminar">
                        </div>
                    </div>  
				</div>
                <div class="tab-pane" id="4">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4">
								<h3>Vuelo a modificar:</h3>
                                <input type="text" class="form-control" name="codigo-viejo" placeholder="Codigo del vuelo a modificar :">
                            </div>
							<div class="col-sm-4">
								<h3>Modificar fecha partida</h3>
								<input class= "form-control" type="checkbox" name="cbox-fecha" id="cbox-fecha">
								
							</div>
							<div class="col-sm-4">
							<h3>Modificar hora partida</h3>
							<input type="checkbox" name="cbox-hora" id="cboxh" class="form-control">
							</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <h3>Nueva fecha:</h3>
                                <input type="date" class="form-control" name="FechaNueva" id="Nfecha" readonly>
                            </div>
							<div class="col-sm-4">
								<h3>Nueva hora salida:</h3>
								<input type="time" class="form-control" name="HoraNueva" value="23:11" id="Nhora" readonly>
							</div>
                        </div><br>
						<div class="row">
						<div class="col-sm-4">
							<input type="submit" class="btn btn-primary" name="bt-update" value="Modificar">
						</div>
						</div>
                    </div> 
				</div>
                <div class="tab-pane" id="5">                    
				</div>
		    </div>
    </form>
  </div>
  <?php   
            if (isset($_POST['NombreA']) && $_POST['NombreA']!="" && $_POST['CapacidadV']!="" && $_POST['FechaSalida']!="" && $_POST['HoraPartida']!="" && $_POST['Origen']!=""&& $_POST['Destino']!=""&& $_POST['CodigoVuelo']!="") {
                include_once "Modulos/conexion_db.php";
                $nombre = trim($_POST['NombreA']);$capacidad = trim($_POST['CapacidadV']);$fecha = trim($_POST['FechaSalida']);$hora = trim($_POST['HoraPartida']); $id = 0;
				$origen = trim($_POST['Origen']);$destino = trim($_POST['Destino']);$codigo = trim($_POST['CodigoVuelo']);

				$sql = "SELECT Id_Aerolinea FROM aerolinea WHERE Nombre = '$nombre'";
				$result = mysqli_query($conn,$sql);
				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					$id = $row['Id_Aerolinea'];

					$sql = "INSERT INTO vuelo(Id_Aerolinea,Capacidad,Origen,Destino,Fecha_salida,Hora,Numero_Vuelo) VALUES('$id','$capacidad','$origen','$destino','$fecha','$hora','$codigo')";
                	if ($result = mysqli_query($conn,$sql)) {
                    	alerta("Se ha ingresado correctamente el vuelo");
                	}
                	else {
                    	alerta("Ha ocurrido un error: " .mysqli_error($conn));
                		}
                		mysqli_close($conn);
					}
				else {
					alerta("No se encontró la aerolinea seleccionada");
					mysqli_close($conn);
				}    
				
            }
            if (isset($_POST['NombreAerolinea']) && isset($_POST['CodigoPais']) && isset($_POST['Telefono']) && $_POST['NombreAerolinea']!="" && $_POST['CodigoPais']!="" && $_POST['Telefono']!="") {
                include_once "Modulos/conexion_db.php";
				$name = $_POST['NombreAerolinea'];$codarea = $_POST['CodigoPais'];$tel = $_POST['Telefono'];
                $sql = "INSERT INTO aerolinea(Nombre,Codigo_Area,Telefono) VALUES('$name','$codarea','$tel')";
                $result = mysqli_query($conn,$sql);
				if ($result = mysqli_query($conn,$sql)) {
					alerta("Se ha ingresado correctamente el vuelo");
				}
				else {
					alerta("Ha ocurrido un error: " .mysqli_error($conn));
				}
				mysqli_close($conn);
            }
        if (isset($_POST['BorrarVuelo']) && $_POST['BorrarVuelo']!="") {
            include_once "Modulos/conexion_db.php";
            if (isset($_POST['BorrarVuelo'])) {
                $delete = trim($_POST['BorrarVuelo']);
                $sql = "DELETE FROM vuelo WHERE Numero_Vuelo = '$delete'";
                $result = mysqli_query($conn,$sql);
                if (mysqli_affected_rows($conn) > 0) {
                    alerta("El vuelo ha sido eliminado correctamente");
                }
                elseif (mysqli_affected_rows($conn) == 0) {
                    alerta("Ese vuelo no se encuentra en la base de datos");
                } 
                else {
                    alerta("No se ha podido eliminar el vuelo");
                }
            }
            mysqli_close($conn);
        }
        if (isset($_POST['FechaNueva']) && isset($_POST['HoraNueva']) && isset($_POST['codigo-viejo']) && $_POST['FechaNueva']!="" && $_POST['HoraNueva']!="" && $_POST['codigo-viejo']) {
			include_once "Modulos/conexion_db.php";
			$fechaN = $_POST['FechaNueva'];$horaN = $_POST['HoraNueva'];$cod = $_POST['codigo-viejo'];
			
			$sql = "UPDATE vuelo SET Fecha_salida = '$fechaN', Hora = '$horaN' WHERE Numero_Vuelo = '$cod'";
			$result = mysqli_query($conn,$sql);
			if (mysqli_affected_rows($conn) > 0) {
				alerta("El vuelo ha sido modificado");
			}
			elseif (mysqli_affected_rows($conn) == 0) {
				alerta("Ese vuelo no se encuentra en la base de datos");
			} 
			else {
				alerta("No se ha podido eliminar el vuelo");
			}
			mysqli_close($conn);
		}
		elseif (isset($_POST['FechaNueva']) && isset($_POST['codigo-viejo']) && $_POST['FechaNueva']!="" && $_POST['codigo-viejo']) {
			include_once "Modulos/conexion_db.php";
			$fechaN = $_POST['FechaNueva'];$cod = $_POST['codigo-viejo'];

			$sql = "UPDATE vuelo SET Fecha_salida = '$fechaN' WHERE Numero_Vuelo = '$cod'";
			$result = mysqli_query($conn,$sql);
			if (mysqli_affected_rows($conn) > 0) {
				alerta("El vuelo ha sido modificado");
			}
			elseif (mysqli_affected_rows($conn) == 0) {
				alerta("Ese vuelo no se encuentra en la base de datos");
			} 
			else {
				alerta("No se ha podido eliminar el vuelo");
			}
			mysqli_close($conn);
		}
		elseif (isset($_POST['HoraNueva']) && isset($_POST['codigo-viejo']) && $_POST['HoraNueva']!="" && $_POST['codigo-viejo']) {
			include_once "Modulos/conexion_db.php";
			$horaN = $_POST['HoraNueva'];$cod = $_POST['codigo-viejo'];

			$sql = "UPDATE vuelo SET Hora = '$horaN' WHERE Numero_Vuelo = '$cod'";
			$result = mysqli_query($conn,$sql);
			if (mysqli_affected_rows($conn) > 0) {
				alerta("El vuelo ha sido modificado");
			}
			elseif (mysqli_affected_rows($conn) == 0) {
				alerta("Ese vuelo no se encuentra en la base de datos");
			} 
			else {
				alerta("No se ha podido eliminar el vuelo");
			}
			mysqli_close($conn);
		}
        ?>

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
    