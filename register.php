<?php 
include 'header.php'; 
?>



<?php
// include 'connect/conn.php';

if(isset($_POST['register'])){

    $userName = check_input($_POST['username']);
    $phone = check_input($_POST['phone']);
    $email = check_input($_POST['email']);
    $role = check_input($_POST['select']);
    $password = check_input($_POST['password']);
    $cpass = check_input($_POST['cpass']);
   
    $pword = md5($password);



    if(empty($userName) && empty($phone) && empty($email) && empty($role) && empty($password) && empty($cpass)){
        $msg = "You Have Not Entered Any Details!!!";
        echo "<script> alert('$msg')</script>";
    }elseif(empty($userName)){
        $msg = "Username is Required!!!";
        echo "<script> alert('$msg')</script>";
    }elseif(empty($phone)){
        $msg = "phone number is Required!!!";
        echo "<script> alert('$msg')</script>";
    }elseif(empty($email)){
        $msg = "Email Required!!!";
        echo "<script> alert('$msg')</script>";
    }elseif(empty($role) || !isset($role)){
        $msg = "Please Select Role!!!";
        echo "<script> alert('$msg')</script>";
    }elseif(empty($password)){
        $msg = "password Required!!!";
        echo "<script> alert('$msg')</script>";
    }elseif(empty($cpass)){
        $msg = "Confirm password Required!!!";
        echo "<script> alert('$msg')</script>";
    }elseif($_POST['password'] !== $_POST['cpass']){
        $msg = "passwords are not same !!!";
        echo "<script> alert('$msg')</script>";
    }else{

        $checkuser = dbconnect()->prepare("SELECT email FROM admin WHERE email=?");
        $checkuser->execute([$email]);
        $row = $checkuser->fetch();
        //alternative method


         
        // $no = $checkuser->rowcount()
        //if($no)
        if($checkuser->rowcount() > 0){
            $msg = "User already exist!!!";
            echo "<script> alert('$msg')</script>";
        }else{
            $register = dbconnect()->prepare("INSERT INTO admin SET username=?, phone=?, email=?, password=?, role=?");
           
           //alternate method
           // $register = dbconnect()->prepare("INSERT INTO advertisers(email,password,fullname,gender,age,phone,address,status,created) VALUE(?,?,?,?,?,?,?,?,?)");
           //alt.method
           $registered = $register->execute([$userName,$phone,$email,$pword,$role]);
         if($registered){
            $msg = "Sign Up Successful!!!";
            echo "<script> alert('$msg'); window.location='accounts.php';</script>";
         }else{
            echo "<script> alert('Oops operation failed!!!')</script>";
         }
    }
    
}
    
    
}  
   

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
    
</head>
<body>
    

<div id="layoutSidenav_content">
 <main>



 <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Register An Admin</h3></div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="row mb-3">
                                                <div class="col-md-6 down">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" name="username" />
                                                        <label for="inputFirstName">Username</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 down">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" name="phone" />
                                                        <label for="inputLastName">Phone Number</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 down">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="email">
                                                        <label for="inputEmail">Email address</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 down">
                                                    <div class="form-floating">
                                                        <select class="form-control" id="inputRole" type="text" placeholder="Select Role" name="select">
                                                            <option value="" selected> - Select Role - </option>
                                                            <option value="Admin">Admin</option>
                                                            <option value="User">User</option>
                                                        </select>
                                                    </div>
                                                </div>
                            
                                                <div class="col-md-6 down">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password" placeholder="Create a password" name="password" />
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 down">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" placeholder="Confirm password" name="cpass" />
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><button name="register" type="submit" class="btn btn-primary btn-block">Create Account</button></div>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

 </main>




<?php include 'footer.php'; ?>
