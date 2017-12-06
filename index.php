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
        <div class="row">
            <form action="procesa.php" method="POST" class="form-inline">
            <div class="col-md-12" style="margin-top:100px">
                <div class="panel panel-primary">
                    <div class="panel-heading">Metodo Simplex</div>
                    <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="numero_variables" class="col-md-12 control-label">Número de Variables</label>
                                        <div class="col-md-12">
                                            <input id="numero_variables" type="number" class="form-control" name="numero_variables" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="numero_restricciones" class="col-md-12 control-label">Número de Restricciones</label>
                                        <div class="col-md-12">
                                            <input id="numero_restricciones" type="number" class="form-control" name="numero_restricciones" required autofocus>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-auto">
                                    <button type="button" class="btn btn-primary" name="button" id="paso_1">
                                        Aceptar
                                    </button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="margin-top:100px">
                <div class="panel panel-primary">
                    <div class="panel-heading">Metodo Simplex</div>
                    <div class="panel-body">
                        <div id="valores"></div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>



    <script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/select2.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>

</body>
</html>
