
<?php



include 'connect/conn.php';

$errorMsg = "";

if(isset($_POST['login'])){
    if(empty($_POST['username']) || empty($_POST['password'])){
        
        $errorMsg = "<br>Email and password Required !!!</br>";
        // echo "<script>alert('$msg')</script>";
    }else{
        $userName = check_input($_POST['username']);
        $password = check_input($_POST['password']);
        

        $pass = md5($password);
        
        $checkUser = dbconnect()->prepare("SELECT * FROM admin WHERE username=? && password=?");
        $checkUser->execute([$userName,$pass]);
        $row = $checkUser->fetch();
        $no = $checkUser->rowcount();
        if($no >0){
            
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['user'] = $userName;
            
            
            // $_SESSION['success'] = "WELCOME {$_SESSION['email']}, LOGIN SUCCESSFUL !!!";
            // header("location:admin/dashboard.php");
            $msg = "Login Successful !!!";
            echo "<script>alert('$msg'); window.location='dashboard.php';</script> ";
        // }elseif($row['password'] != $_POST['password']){
        //     $error = "Wrong Password Entered !!!";
        //     // $msg = "Wrong Password !!!";
        //     // echo "<script> alert('$msg')</script>";

        //     
    }else{
        // $error = "Wrong Email Or Password, Try again!!!";
        $errorMsg = "<br>Wrong Email Or Password, Try again!!!</br>";
        // $msg = "account doesn't exist !!!";
        // echo "<script>alert('$msg')</script>";
      }
        
    }
}



?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Foodlicious</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
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
                                
                                <div class='error textcenter'>

                                <?php
                                
                                    if (isset($_SESSION['nologin'])) {
                                        echo $_SESSION['nologin'];
                                        unset($_SESSION['nologin']);
                                    }

                                    if ($errorMsg != "") {
                                        echo $errorMsg ;
                                        unset($errorMsg);
                                    }
                                
                                
                                ?>
                                </div>
                                    <!-- <div class=""><h6 class="text-center font-weight-light" style="color: blue;">Lfood</h6></div> -->
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="text" placeholder="UserName" name="username" />
                                                <label for="inputEmail">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="">Forgot Password?</a>
                                                <button type="submit" name="login" class="btn btn-primary" >Login</button>
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
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
