<!DOCTYPE html>

<html lang="en">

<?php
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "gagal"){
            echo '<script language="javascript">';
                echo 'alert("username atau password salah")';
            echo '</script>';
        }else if($_GET['pesan'] == "logout"){
            echo "Anda telah berhasil logout";
        }else if($_GET['pesan'] == "belum_login"){
            echo "Anda harus login untuk mengakses halaman admin";
        }
    }
?>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Page Title - SB Admin</title>
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script language="javascript">
            function validasilogin(){
                if(document.form1.username.value==""){
                    alert("Username Kosong !");
                    form1.username.focus();
                    return false;
                }
                if(document.form1.pass.value==""){
                    alert("Password Kosong !");
                    form1.pass.focus();
                return false;
                }
            }
        </script>
        
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">


                                        <form name="form1" method="post" action="proses-login.php" onsubmit="return validasilogin();">
                                            <div class="form-group"><label class="small mb-1" for="username">Username</label>
                                                <input class="form-control py-4" name="username" id="username" type="text" placeholder="Enter username" />
                                            </div>
                                            
                                            <div class="form-group"><label class="small mb-1" for="pass">Password</label>
                                                <input class="form-control py-4" name="pass" id="pass" type="password" placeholder="Enter password" />
                                            </div>
                                            
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <center></center><button type="submit" name="login" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
        <script src="../js/scripts.js"></script>
    </body>
</html>
