<!DOCTYPE html>
<html lang="en">
<?php
    $mysqli = new mysqli("localhost", "root", "", "earthquake"); 
?>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Peringatan Gempa Bumi</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Earthquake</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            ><!-- Navbar Search-->

            



            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Control</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <form method="post"></form>
                        <form method="post">
                            <input type="submit" class="dropdown-item" name="cek" value="Check Alarm">
                            <input type="submit" class="dropdown-item" name="mati" value="Turn Off">

                        </form>

                    </div>
                </li>
            </ul>
                </div>
            </form>
            <!-- Navbar-->
        </nav>
        <div id="layoutSidenav">
            <?php include "menu.php" ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <!--<div class="alert alert-danger" style="text-align: center;" role="alert">
                            DANGER!!!
                        </div>-->
                        <h1 class="mt-4">Dashboard</h1>

                        <div class="card mb-4">

                            <?php
                                $dataid1 = '';
                                $datapga1 = '';
                                $dataid2 = '';
                                $datapga2 = '';
                                $dataid3 = '';
                                $datapga3 = '';

                                $sql1 = "SELECT * FROM (SELECT id_sensor1, pga1, tanggal, waktu from sensor1 ORDER BY id_sensor1 DESC LIMIT 10) Var1 ORDER BY id_sensor1 ASC";
                                $sql2 = "SELECT * FROM (SELECT id_sensor2, pga2, tanggal, waktu from sensor2 ORDER BY id_sensor2 DESC LIMIT 10) Var1 ORDER BY id_sensor2 ASC";
                                $sql3 = "SELECT * FROM (SELECT id_sensor3, pga3, tanggal, waktu from sensor3 ORDER BY id_sensor3 DESC LIMIT 10) Var1 ORDER BY id_sensor3 ASC";

                                $result1 = mysqli_query($mysqli, $sql1);
                                $result2 = mysqli_query($mysqli, $sql2);
                                $result3 = mysqli_query($mysqli, $sql3);

                                while ($row1 = mysqli_fetch_array($result1)) {
                                    $dataid1 = $dataid1 . '"'. $row1['id_sensor1'].'",';
                                    $datapga1 = $datapga1 . '"'. $row1['pga1'].'",';
                                }
                                while ($row2 = mysqli_fetch_array($result2)) {
                                    $dataid2 = $dataid2 . '"'. $row2['waktu'].'",';
                                    $datapga2 = $datapga2 . '"'. $row2['pga2'].'",';
                                }
                                while ($row3 = mysqli_fetch_array($result3)) {
                                    $dataid3 = $dataid3 . '"'. $row3['id_sensor3'].'",';
                                    $datapga3 = $datapga3 . '"'. $row3['pga3'].'",';
                                }

                                $dataid1 = trim($dataid1,",");
                                $datapga1 = trim($datapga1,",");
                                $dataid2 = trim($dataid2,",");
                                $datapga2 = trim($datapga2,",");
                                $dataid3 = trim($dataid3,",");
                                $datapga3 = trim($datapga3,",");
                            ?>


                            <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Getaran Terkini Pada Sensor 1, Sensor 2, dan Sensor 1. (Gal, Waktu)</div>
                            <div class="card-body"><canvas id="myChart" width="100%" height="30"></canvas></div>
                            <script>
                                let myChart = document.getElementById('myChart').getContext('2d')

                                let barChart = new Chart(myChart,{
                                    type: 'line',
                                    options:{
                                        scales:{
                                            xAxes:[{
                                                labelString:'waktu'
                                            }]
                                        }
                                    },
                                    data:{
                                        labels: [<?php echo $dataid2; ?>],
                                        datasets:[{
                                            label: "Sensor 1 (Gal)",
                                            backgroundColor: 'rgba(0,99,132,0.5)',
                                            borderColor: 'rgb(2,44,71)',
                                            data: [<?php echo $datapga1; ?>],

                                        },
                                        {
                                            label: "Sensor 2 (Gal)",
                                            backgroundColor: 'rgba(230, 126, 34, 0.5)',
                                            borderColor: 'rgb(211, 84, 0)',
                                            data: [<?php echo $datapga2; ?>],

                                        },
                                        {
                                            label: "Sensor 3 (Gal)",
                                            backgroundColor: 'rgba(155, 89, 182,0.5)',
                                            borderColor: 'rgb(142, 68, 173)',
                                            data: [<?php echo $datapga3; ?>],

                                        }]
                                    }
                                });
                            </script>


                        </div>

                         <h4 class="mt-4">Getaran Terkini</h1>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">Fuzzy Logic</div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            <?php
                                                $query_tampilfu = "SELECT * FROM fuzzy ORDER BY ID DESC LIMIT 1";
                                                $fuzzy = mysqli_query($mysqli, $query_tampilfu); 
                                                while ($rowf = mysqli_fetch_array($fuzzy)) {
                                                    $dataid = $rowf['id'];
                                                    $datahasil = $rowf['hasil'];
                                                    $datapga9 = $rowf['pga1'];
                                                    $datapga8 = $rowf['pga2'];
                                                    $datapga7 = $rowf['pga3'];
                                                    $tglfuz = $rowf['tanggal'];
                                                    $wktfuz = $rowf['waktu'];
                                                }

                                            ?>
                                            <li class="list-group-item">Status: <?php if($datahasil == 1){echo "Berbahaya";}else{echo "Tidak Berbahaya";} ?></li>
                                            <li class="list-group-item">Sensor 1: <?php echo $datapga9, " Gal"; ?></li>
                                            <li class="list-group-item">Sensor 2: <?php echo $datapga8, " Gal"; ?></li>
                                            <li class="list-group-item">Sensor 3: <?php echo $datapga7, " Gal"; ?></li>
                                            <li class="list-group-item">Tanggal: <?php echo $tglfuz; ?></li>
                                            <li class="list-group-item">Waktu: <?php echo $wktfuz; ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">K-Nearest Neighbor</div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            <?php
                                                $query_tampilfu = "SELECT * FROM knn ORDER BY ID DESC LIMIT 1";
                                                $fuzzy = mysqli_query($mysqli, $query_tampilfu); 
                                                while ($rowf = mysqli_fetch_array($fuzzy)) {
                                                    $dataid = $rowf['id'];
                                                    $datahasil = $rowf['hasilk'];
                                                    $datapga9 = $rowf['pga1'];
                                                    $datapga8 = $rowf['pga2'];
                                                    $datapga7 = $rowf['pga3'];
                                                    $tglknn = $rowf['tanggal'];
                                                    $wktknn = $rowf['waktu'];
                                                }

                                            ?>
                                            <li class="list-group-item">Status: <?php if($datahasil == 1){echo "Berbahaya";}else{echo "Tidak Berbahaya";} ?></li>
                                            <li class="list-group-item">Sensor 1: <?php echo $datapga9, " Gal"; ?></li>
                                            <li class="list-group-item">Sensor 2: <?php echo $datapga8, " Gal"; ?></li>
                                            <li class="list-group-item">Sensor 3: <?php echo $datapga7, " Gal"; ?></li>
                                            <li class="list-group-item">Tanggal: <?php echo $tglknn; ?></li>
                                            <li class="list-group-item">Waktu: <?php echo $wktknn; ?></li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2019</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    </body>
</html>

<?php

    if(isset($_POST['cek'])){
        $outpt = shell_exec("python program/on.py");
        $message = "Check Alarm";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }elseif(isset($_POST['mati'])){
        $outpt = shell_exec("python program/stop.py");
        $message = "Alarm Mati";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

?>