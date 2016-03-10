<?php
    $acceso=$_COOKIE['acceso']; 
    $usuariologin=$_COOKIE['usuariologin'];
    $nom_usu=$_COOKIE['nom_usu'];
    if($acceso !='1')
    {
        header('location:index.php');
        exit;
    }
    session_start();
    if($_SESSION['acceso']=="" or $_SESSION['usuariologin']=="")
    {
        header('location:index.php');
        exit;
    }
?>

<!-- INCLUIMOS EL HEADER -->
<?php include_once('segmentos/header.php'); ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <i class="fa fa-fw fa-home"></i> 
                        Home
                    </h1>
                </div>
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-fw fa-image"></i> Slide Principal</h3>
                        </div>
                        <div class="panel-body">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


<!-- INCLUIMOS EL HEADER -->
<?php include_once('segmentos/footer.php'); ?>
