<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cardumen</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link href="assets/css/plugins/morris.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/estilos.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
</head>

<body class="login_body">

    <div class="container-fluid">
    
        <div class="login">

            <div id="ajax_alert"></div>

            <form class="form-signin" method='POST' id='formu_login'>
                <div class="form-group">
                    <label>Nombre de usuario</label>
                    <div class="input-group-lg">
                        <input type="text" name="usuario" class="form-control" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <div class="input-group-lg">
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    
                </div>
                <button class="btn btn-lg btn-primary" type="submit">Acceder</button>
            </form>

            <script type="text/javascript">
                $(function (e) {
                    $('#formu_login').submit(function (e) {
                        e.preventDefault();
                        $('#ajax_alert').load('validar.php?' + $('#formu_login').serialize());
                    })
                })
            </script>
        </div>
        

    </div> <!-- /container -->


    <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="assets/js/plugins/morris/raphael.min.js"></script>
    <script src="assets/js/plugins/morris/morris.min.js"></script>
    <script src="assets/js/plugins/morris/morris-data.js"></script>
</body>

</html>