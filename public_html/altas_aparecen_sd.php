<?php
//Admin
session_start();

//conexion a la base de datos
$servidor = 'localhost';
$cuenta = 'root';
$password = '';
$bd = 'ancianato';
$conexion = new mysqli($servidor, $cuenta, $password, $bd);
error_reporting(0);
include('db.php');
?>

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
    <link rel="stylesheet" href="css/style.css">
    <link href="css/styles.css" rel="stylesheet" />
    <!--  Para el los menajes de confimacion ets-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--Clases-->
    <script type="text/javascript" src="JS/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="JS/actions.js"></script>
</head>

<body>
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
            <a class="btn btn-outline-light" href="logout.php"><span class="glyphicon glyphicon-log-in"></span> LOGOUT</a>
        </div>
    </nav>

    <!-- Call to action-->
    <section class="bg-primary text-white h-25">
        <div class="container text-center pt-5">
            <h2 class="mb-2 pt-5">ALTA APARECEN_SD</h2>
        </div>
    </section>

    <?php
    if ($_SESSION['exito'] == "si") {
        echo '<script>swal("Alta Exitosa", "Continua dando de alta", "success");</script>';

        $_SESSION['exito'] = "";
    } else if ($_SESSION['exito'] == "no") {
        echo '<script>swal("ID Repetido", "El id debe ser unico", "error");</script>';
        $_SESSION['exito'] = "";
    }
    ?>

    <section class="hero3">
        <form class="contact100-form validate-form" action="altas_aparecen_sd_bd.php" enctype="multipart/form-data" method="POST" id="alta">
            <div class="wrap-input100 validate-input p-1" data-validate="Requerido">
                <span class="label-input100">Suministro: </span>
                <select name="idS" id="idS" class="input100">
                    <option value="">Selecciona un suministro</option>
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM `suministro`");
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <option value="<?php echo $row['Codigo']; ?>">
                            <?php echo $row['Codigo'], " - ", $row['Nombre']; ?>
                        </option>
                    <?php }
                    //mysqli_close($con);
                    ?>
                </select>
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input p-1" data-validate="Requerido">
                <span class="label-input100">Donacion: </span>
                <select name="idD" id="idD" class="input100">
                    <option value="">Selecciona una donacion</option>
                    <?php
                    $result2 = mysqli_query($con, "SELECT * FROM `donacion`");
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                    ?>
                        <option value="<?php echo $row2['ID']; ?>">
                            <?php echo $row2['ID'], " - ", $row2['Aporte']; ?>
                        </option>
                    <?php }
                    mysqli_close($con2);
                    ?>
                </select>
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input p-1" data-validate="Requerido">
                <span class="label-input100">Cantidad: </span>
                <input class="input100" type="number" id="cantA" name="cantA" placeholder="20" required>
                <span class="focus-input100"></span>
            </div>

            <div class="container-contact100-form-btn p-1">
                <button class="btn btn-outline-info w-50 p-3 m-1" onclick="getData()" name="submit">
                    <span>
                        AGREGAR
                        <i class="fan fan-long-arrow-right m-l-7" aria-hidden="true"></i>
                    </span>
                </button>
            </div>

        </form>
    </section>

    <!-- Footer-->
    <footer class="bg-light py-5">
        <div class="container">
            <div class="small text-center text-muted">Copyright © 2020 - Start Bootstrap</div>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>