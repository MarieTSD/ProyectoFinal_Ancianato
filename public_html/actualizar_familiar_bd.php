

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Ancianato</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <!--  Para el los menajes de confimacion ets-->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body >

    <?php
    session_start();
    error_reporting(0);
    
    $serv = 'localhost';
    $cuenta = 'root';
    $contra = '';
    $BaseD = 'ancianato';
   
   //Variables de session
   $_SESSION['id']='';
   $_SESSION['nombre'] ='';
   $_SESSION['ap'] = '';
   $_SESSION['am'] = '';
   $_SESSION['nac']='';
   $_SESSION['paren']='';
   $_SESSION['calle']='';
   $_SESSION['colonia']='';
   $_SESSION['cp']='';
   $_SESSION['ciudad']='';
   $_SESSION['estado']='';
   $_SESSION['telefono']='';
   $_SESSION['idR']='';


  //Realiar la conexion con la base de datos 
   $conexion = new mysqli($serv,$cuenta,$contra,$BaseD);
  if($conexion->connect_error){
      die('Ocurrio un error en la conexion con la BD');
  }else{  
    $modificar = $_SESSION['mod']; 
    $sql2 = "select * from familiar where ID='$modificar'";//hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
    
    $resultado = $conexion -> query($sql2); //aplicamos sentencia  
            while( $fila = $resultado -> fetch_assoc() ){
                $_SESSION['id']= $fila['ID'];
                $_SESSION['nombre'] = $fila['Nombre'];
                $_SESSION['ap'] = $fila['Apellido_P'];
                $_SESSION['am'] = $fila['Apellido_M'];
                $_SESSION['nac']=$fila['Fecha_Nac'];
                $_SESSION['paren']=$fila['Parentezco'];
                $_SESSION['calle']=$fila['CalleNo'];
                $_SESSION['colonia']=$fila['Colonia'];
                $_SESSION['cp']=$fila['CP'];
                $_SESSION['ciudad']=$fila['Cuidad'];
                $_SESSION['estado']=$fila['Estado'];
                $_SESSION['telefono']=$fila['Telefono'];
                $_SESSION['idR']=$fila['ID_Residente'];
              
            } 
         if(isset($_POST['submit'])){
            $uno = $_POST["idA"];
            $dos = $_POST["nomA"];
            $tres = $_POST["apA"];
            $cuatro = $_POST["amA"];
            $cinco = $_POST["nacA"];
            $seis = $_POST['calleA'];
            $siete = $_POST["coloniaA"];
            $ocho = $_POST["cpA"];
            $nueve = $_POST["ciudadA"];
            $diez = $_POST["estadoA"];
            $once = $_POST["telA"];
            $doce= $_POST["idR"];
            $trece= $_POST["paren"];
                        

            $sql3="select ID from residente WHERE ID='$doce'";
            $rev= $conexion -> query($sql3);

            if($conexion->affected_rows >=1){
                $modificar = $_SESSION["mod"];
                $ne="update familiar set ID='$uno', Nombre='$dos', Apellido_P='$tres', Apellido_M='$cuatro', Fecha_Nac='$cinco',Parentezco='$trece', CalleNo='$seis', Colonia='$siete', CP='$ocho', Cuidad='$nueve', Estado='$diez', Telefono='$once', ID_Residente='$doce' WHERE ID='$modificar'";
                $fin = $conexion -> query($ne);
                if ($conexion->affected_rows >= 1){ 
                    $_SESSION['exito2'] = "si";
                        header("Location: actualizar_familiar.php");
                    }
            }else{
                echo '<script> 
                        alert("El Residente indicado no existe")
                        </script> ';
            }

            
            
        }
  }
?>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="inicio_admin.php">Adminitrador</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item dropdown show">
                            <a class="nav-link js-scroll-trigger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                EMPLEADO
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="altas_empleado.php">ALTA</a>
                                <a class="dropdown-item" href="baja_empleado.php">BAJA</a>
                                <a class="dropdown-item" href="actualizar_empleado.php">ACTUALIZAR</a>
                                <a class="dropdown-item" href="ver_empleados.php">VISUALIZAR</a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#">DONACION</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#">MEDICAMENTO</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#">CLASE</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#">ATENCION MEDICA</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#">SUMINISTRO</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Call to action-->
        <section class="page-section bg-dark text-white">
            <div class="container text-center">
                <h2 class="mb-4">ACTUALIZAR CAMPOS EMPLEADO</h2>
            </div>
        </section>


    <section class="hero3 hero8">      
      <form class="contact100-form validate-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="post" id="alta">
				<div class="wrap-input100 validate-input" data-validate="Requerido">
					<span class="label-input100">ID:</span>
					<input class="input100" type="number" name="idA" value="<?php echo $_SESSION['id']; ?>" required>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<span class="label-input100">Nombre(s):</span>
					<input class="input100" type="text" name="nomA" value="<?php echo $_SESSION['nombre']; ?>" required>
					<span class="focus-input100"></span>
				</div>

                <div class="wrap-input100 validate-input" data-validate="Requerido">
					<span class="label-input100">Apellido paterno:</span>
					<input class="input100" type="text" name="apA" value="<?php echo $_SESSION['ap']; ?>" required>
					<span class="focus-input100"></span>
				</div>
                <div class="wrap-input100 validate-input" data-validate="Requerido">
					<span class="label-input100">Apellido meterno:</span>
					<input class="input100" type="text" name="amA" value="<?php echo $_SESSION['am']; ?>">
					<span class="focus-input100"></span>
				</div>
                <div class="wrap-input100 validate-input" data-validate="Requerido">
					<span class="label-input100">Fecha de nacimiento:</span>
					<input class="input100" type="date" name="nacA" value="<?php echo $_SESSION['nac']; ?>" required>
					<span class="focus-input100"></span>
				</div>
                <div class="wrap-input100 validate-input" data-validate="Requerido">
					<span class="label-input100">Prentezco:</span>
					<input class="input100" type="text" name="paren" value="<?php echo $_SESSION['paren']; ?>" required>
					<span class="focus-input100"></span>
				</div>
                <div class="wrap-input100 validate-input" data-validate="Requerido">
					<span class="label-input100">Calle y No.:</span>
					<input class="input100" type="text" name="calleA" value="<?php echo $_SESSION['calle']; ?>" required>
					<span class="focus-input100"></span>
				</div>
                <div class="wrap-input100 validate-input" data-validate="Requerido">
					<span class="label-input100">Colonia:</span>
					<input class="input100" type="text" name="coloniaA" value="<?php echo $_SESSION['colonia']; ?>" required>
					<span class="focus-input100"></span>
				</div>
                <div class="wrap-input100 validate-input" data-validate="Requerido">
					<span class="label-input100">Codigo postal:</span>
					<input class="input100" type="number" name="cpA" value="<?php echo $_SESSION['cp']; ?>" required>
					<span class="focus-input100"></span>
				</div>
                <div class="wrap-input100 validate-input" data-validate="Requerido">
					<span class="label-input100">Ciudad:</span>
					<input class="input100" type="text" name="ciudadA" value="<?php echo $_SESSION['ciudad']; ?>" required>
					<span class="focus-input100"></span>
				</div>
                <div class="wrap-input100 validate-input" data-validate="Requerido">
					<span class="label-input100">Estado:</span>
					<input class="input100" type="text" name="estadoA" value="<?php echo $_SESSION['estado']; ?>" required>
					<span class="focus-input100"></span>
				</div>
                <div class="wrap-input100 validate-input" data-validate="Requerido">
					<span class="label-input100">Telefono:</span>
					<input class="input100" type="number" name="telA" value="<?php echo $_SESSION['telefono']; ?>">
					<span class="focus-input100"></span>
				</div>

                <div class="wrap-input100 validate-input" data-validate="Requerido">
					<span class="label-input100">id Residente:</span>
					<input class="input100" type="number" name="idR" value="<?php echo $_SESSION['idR']; ?>" required>
					<span class="focus-input100"></span>
				</div>

                

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn" name="submit">
						<span>
							Actualizar
							<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			</form>
    </section>



       
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container"><div class="small text-center text-muted">Copyright © 2020 - Start Bootstrap</div></div>
        </footer>

        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
