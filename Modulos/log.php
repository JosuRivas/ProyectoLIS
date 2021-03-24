
<?php
    include("conexion_db.php");

        if (isset($_POST['registrar'])){
            $user = trim($_POST['emailR']);
            $pass = trim($_POST['passwordR']);
            $tipo = "cliente";
            $nombres = trim($_POST['nombres']);
            $apellidos = trim($_POST['apellidos']);
            $edad = trim($_POST['edad']);
            $name = $nombres . " " . $apellidos;
            if ($user != "" && $pass !="") {
                $sql = "INSERT INTO usuario (Username,contraseña,Tipo_User) VALUES('$user','$pass','$tipo');";
                $sql .="INSERT INTO cliente (Nombre,Edad,email) VALUES('$name','$edad','$user');";
                
            if (mysqli_multi_query($conn,$sql)) {
                }
            
            else{
                echo "error" . $sql . "<br>" . mysqli_error($conn);
                }
            mysqli_close($conn);     
            }
        }
?>
<!--login-->
<?php 
    // Include config file
    require_once "conexion_db.php";
     
    // Define variables and initialize with empty values
    $username = $password = "";
    $username_err = $password_err = "";
     
    // Processing form data when form is submitted
    if(isset($_POST['logear'])){
     
        // Check if username is empty
        if(empty(trim($_POST["emailL"]))){
            $username_err = "Ingrese su usuario.";
        } else{
            $username = trim($_POST["emailL"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["passwordL"]))){
            $password_err = "Ingrese su contraseña.";
        } else{
            $password = trim($_POST["passwordL"]);
        }        
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT id_Usuario, Username, contraseña, Tipo_User FROM usuario WHERE Username = ?";
            
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_username = $username;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $tipo_user);
                        if(mysqli_stmt_fetch($stmt)){
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                $_SESSION["tipo_user"] = $tipo_user;
                                if ($_SESSION["tipo_user"] == "cliente") {
                                    echo "<script>window.location = \"index.php\"</script> ";  
                                }
                                elseif ($_SESSION["tipo_user"] == "admin") {
                                    echo "<script>window.location = \"adminpage.php\"</script> ";  
                                }
                                                     
                        }
                    } else{
                        // Display an error message if username doesn't exist
                        $username_err = "No existe una cuenta con esas credenciales.";
                    }
                } else{
                    echo "Error, inténtelo mas tarde.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Close connection
        mysqli_close($conn);
    }

 
?>
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-form" data-backdrop="false"><!--ventana modal-->
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header"><!--header modal-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
                <ul class="nav nav-tabs"><!--barra de navegacion-->
                    <li class="active"><a href="#login" data-toggle="tab">Iniciar sesión</a></li>
                    <li><a href="#register" data-toggle="tab">Registrarse</a></li>
                </ul>
            </div>
            <div class="modal-body"><!--cuerpo-->
                <div class="tab-content">
                    <div id="login" class="tab-pane fade in active"><!--tab logear-->
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"><!--form logear-->
                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>" >
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="emailL" name="emailL" value="<?php echo $username; ?>">
                                <span class="help-block"><?php echo $username_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                <label for="passwordL">Contraseña:</label>
                                <input type="password" name="passwordL" id="passwordL" class="form-control">
                                <span class="help-block"><?php echo $password_err; ?></span>
                            </div>
                            <button type="submit" class="about-view" name="logear">Ingresar</button>
                        </form>
                    </div>
                    <div id="register" class="tab-pane fade"><!--tab registrar-->
                        <?php
                            include("conexion_db.php");
                        ?>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"><!--form registrar-->
                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="emailR" name="emailR" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="edad">Edad(años):</label>
                                <input type="number" class="form-control" id="edad" name="edad" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="passwordR">Contraseña</label>
                                <input type="password" class="form-control" id="passwordR" name="passwordR" placeholder="" onkeyup="check()" required>
                            </div>
                            <div class="form-group">
                                <label for="passwordR2">Confirmar Contraseña:</label>
                                <input type="password" class="form-control" id="passwordR2" name="passwordR2" placeholder="" onkeyup="check()" required>
                            </div>
                            <span id="msg" style="display:none"></span>
                            <button type="submit" class="about-view" name="registrar" id="registrar">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
<script src="assets/js/pwd.js"></script>







           