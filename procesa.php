<?php
require_once('simplex.php');
error_reporting(0);
$tipo = "MAX";

$num_variables = $_POST['numero_variables'];
//Variables de decision
$num_restricciones = $_POST['numero_restricciones'];


for($i=0; $i<$num_restricciones; $i++)
{
    $restricciones[] = ['valores' => $_POST['restricciones'][$i]['valor'],
                        'val' => $_POST['restricciones'][$i]['resultado']
    ];
}

$Z = $_POST['funcion_objetivo'];

/*
https://es.scribd.com/doc/39774413/Ejercicios-de-Programacion-Lineal-Resueltos-Mediante-El-Metodo-Simplex
$Z = [300, 400];
$restricciones[] = ['valores' => [3, 3],
                    'val' => 120];
$restricciones[] = ['valores' => [3, 6],
                    'val' => 180];

$Z = [20, 40];
$restricciones[] = ['valores' => [1, 3],
                    'val' => 9];
$restricciones[] = ['valores' => [5, 1],
                    'val' => 8];

3 RESTRICCIONES CAMBIAR
$Z = [10, 20];
$restricciones[] = ['valores' => [4, 2],
                    'val' => 20];
$restricciones[] = ['valores' => [8, 8],
                    'val' => 20];
$restricciones[] = ['valores' => [0, 2],
                    'val' => 10];


$Z = [10, 20];
$restricciones[] = ['valores' => [1, 5],
'val' => 9];
$restricciones[] = ['valores' => [5, 1],
'val' => 8];
*/

$Z = [3.2, 2.4];

$restricciones[] = ['valores' => [8, 5],
'val' => 200];

$restricciones[] = ['valores' => [5, 4],
'val' => 140];

$restricciones[] = ['valores' => [5, 7],
'val' => 175];

$simple = new Simplex($tipo, $num_variables, $num_restricciones, $Z, $restricciones);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<title>Metodo Simplex</title>
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Plugins CSS
    ============================================ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/jquery-ui.min.css" rel="stylesheet">
    <link href="css/select2.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <?php
        echo $simple->response();
        ?>
    </div>



    <script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/select2.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>

</body>
</html>
