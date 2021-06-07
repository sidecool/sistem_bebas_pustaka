<?php
// Abaikan Error Browser
error_reporting(0);
session_start();

include '../config/route.php';
include '../config/database.php';

if(isset($_POST['Login'])){      
    $uname = $_POST['username'];
    $paswd = $_POST['password'];
        
    $sql = "SELECT username, password, hak_akses
            FROM tbl_login 
            WHERE username='$uname' AND password='$paswd' ";
    
    $result = $mysqli->query($sql);
    
    $numrow = $result->num_rows;
    
    if($numrow == 1) {
        $column = $result->fetch_assoc();
    
        $_SESSION['username'] = $uname;
        $_SESSION['status'] = "masuk";
        
        if($column['hak_akses'] == "ADMIN") {
            $_SESSION['id'] = "999";
            $_SESSION['nama'] = "Administrator";                        
        }        
        
        header('location:dashboard.php');
    } 
}
if(isset($_SESSION['status'])){
    if($_SESSION['status']=='masuk'){
        header('location:dashboard.php');
    }        
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Administrator</title>

    <link rel="shortcut icon" href="<?php echo $baseurl; ?>/admin/assets/img/icon/favicon.ico" >
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/admin/assets/css/styles_admin.css" >
    <!-- Javascript -->
    <script src="<?php echo $baseurl; ?>/assets/js/jquery.min.js"></script>    
    <script src="<?php echo $baseurl; ?>/admin/assets/js/FontAwesome/all.min.js"></script>    
    <script src="<?php echo $baseurl; ?>/admin/assets/js/Bootstrap4/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $baseurl; ?>/admin/assets/js/scripts_admin.js" ></script>
    <script>
        function f_showpassword() {
            var x = document.getElementById("inputPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        };

        function f_cekenter(sender, e) {
            if(e.which == 13 || e.keyCode == 13) {
                for (i = 0; i < sender.form.elements.length; i++) {                    
                    if (sender.form.elements[i].tabIndex == sender.tabIndex + 1) {
                        sender.form.elements[i].focus();
                        if (sender.form.elements[i].type == "password") {
                            sender.form.elements[i].select();
                            break;
                        }
                    }
                }                
                return false;
            }       
            return true;     
        };
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
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Login Administrator</h3></div>
                                <div class="card-body">
                                    <form method="post" action="" autocomplete="off">
                                        <div class="form-group">
                                            <!-- <label class="small mb-1" for="inputEmailAddress">Username</label> -->
                                            <input class="form-control py-4" id="inputEmailAddress" type="text" placeholder="Enter username" name="username" autofocus onkeydown="return f_cekenter(this, event)" tabIndex="1">
                                        </div>
                                        <div class="form-group">
                                            <!-- <label class="small mb-1" for="inputPassword">Password</label> -->
                                            <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" name="password" tabIndex="2">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" onclick="f_showpassword()">
                                                <label class="custom-control-label" for="rememberPasswordCheck">Show password</label>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="">Forgot Password?</a>
                                            <input type="submit" name="Login" class="btn btn-primary" value="Login" tabIndex="3">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <!-- <div class="small"><a href="register.html">Need an account? Sign up!</a></div> -->
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
                        <div class="text-muted">Copyright &copy; Administrator 2021</div>
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
</body>        
</html>