<!DOCTYPE html>
<?php
    $mysqli = new mysqli("localhost", "root", "", "earthquake"); 
    $query = "SELECT * FROM sensor3";
?>
<html lang="en">
    <head>
       <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Earthquake - Sensor 3</title>
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
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
        </nav>
        <div id="layoutSidenav">
            <?php include "menu.php" ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Sensor 3</h1>
                        <div class="card mb-4">

                            <?php
                                $dataid = '';
                                $datapga = '';
                                $dataDate = '';
                                $dataWaktu = '';

                                $sql = "SELECT id, pga, tanggal, waktu FROM sensor3 ORDER BY id";
                                $result = mysqli_query($mysqli, $sql);

                                while ($row = mysqli_fetch_array($result)) {
                                    $dataid = $dataid . '"'. $row['id'].'",';
                                    $datapga = $datapga . '"'. $row['pga'].'",';
                                    $dataDate = $row['tanggal'];
                                    $dataWaktu = $row['waktu'];
                                }

                                $dataid = trim($dataid,",");
                                $datapga = trim($datapga,",");
                            ?>


                            <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Area Chart Example</div>
                            <div class="card-body"><canvas id="myChart" width="100%" height="30"></canvas></div>
                            <div class="card-footer small text-muted">Updated <?php echo $dataDate ?> at <?php echo $dataWaktu ?></div>
                            


                            


                            <script>
                                let myChart = document.getElementById('myChart').getContext('2d')

                                let barChart = new Chart(myChart,{
                                    type: 'line',
                                    data:{
                                        labels: [<?php echo $dataid; ?>],

                                        datasets:[{
                                            label: "Sensor 3",
                                            backgroundColor: 'rgba(155, 89, 182,0.5)',
                                            borderColor: 'rgb(142, 68, 173)',
                                            data: [<?php echo $datapga; ?>],
                                        }]
                                    }
                                });
                            </script>


                        </div>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>DataTable Example</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Id</th>
                                                <th>PGA</th>
                                                <th>SIG BMKG</th>
                                                <th>Longtitude</th>
                                                <th>Latitude</th>
                                                <th>Tanggal</th>
                                                <th>Waktu</th>
                                            </tr>
                                        </thead>
                                    
                                        <tbody>
                                            <?php
                                                if($result = $mysqli->query($query)){
                                                    while($data=$result->fetch_assoc()){
                                                        $id = $data["id"];
                                                        $pga = $data["pga"];
                                                        $sigbmkg = $data["sigbmkg"];
                                                        $longtitude = $data["longtitude"];
                                                        $latitude = $data["latitude"];
                                                        $tanggal = $data["tanggal"];
                                                        $waktu = $data["waktu"];

                                                        echo '<tr>
                                                                <th>'.$id.'</th>
                                                                <th>'.$pga.'</th>
                                                                <th class="text-center">'.$sigbmkg.'</th>
                                                                <th>'.$longtitude.'</th>
                                                                <th>'.$latitude.'</th>
                                                                <th>'.$tanggal.'</th>
                                                                <th>'.$waktu.'</th>
                                                            </tr>';


                                                    }
                                                    $result->free();
                                                }
                                            ?>
                                        </tbody>
                                    </table>
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
        <script src="assets/demo/chart-pie-demo.js"></script>

        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
