<?php 



include 'connect/conn.php';
include 'connect/login-check.php';

$username = $_SESSION['username'];
// $id = $_SESSION['id'];

$checkUSer = dbconnect()->prepare("SELECT * FROM admin WHERE username=?");
$checkUSer->execute([$username]);

$row = $checkUSer->fetch();

$id = $row['id'];
$email = $row['email'];
$phone = $row['phone'];
$username = $row['username'];
$role = $row['role'];

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SuperRecords Admin</title>
        <link rel="stylesheet" href="css/modal.css">
        <link href="css/jquery.dataTables.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">

        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html"><h3>SuperRecords</h3></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <!-- <h5 style="color: #11f546;" class="nav-item"><marquee direction="up" behavior="slide">
                <?php 
                //echo $email 
                ?>
             </marquee></h5> -->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a style="list-style-type: circle;" class="dropdown-item" href="#!"><?php echo $email ?></a></li>
                        <li><a class="dropdown-item" href="update-admin.php?id=<?php echo $id ?>">Settings</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <a class="nav-link" href="expenses.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-comment-dollar"></i></div>
                                Expenses
                            </a>

                            <a class="nav-link" href="income.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-calculator"></i></div>
                                Income
                            </a>

                            <a class="nav-link" href="stock.php">
                                <div class="sb-nav-link-icon"><i class="far fa-sticky-note"></i></div>
                                Stock
                            </a>

                            <a class="nav-link" href="out_of_stock.php">
                                <div class="sb-nav-link-icon"><i class="far fa-sticky-note"></i></div>
                                Out-of-Stock
                            </a>

                            <a class="nav-link" href="disperse.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-shopping-cart"></i></div>
                                Disperse
                            </a>
                            <?php
                            if ($role =="Admin") {?>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                                Management
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="register.php">Register</a>
                                    <a class="nav-link" href="accounts.php">Accounts</a>
                                </nav>
                            </div>                                
                           <?php }
                            
                            ?>
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <span>
                            <?php 

                            echo $role;
                            
                            ?>
                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon nav-icon"><i class="fas fa-sign-out-alt"></i></div>
                                <p>Logout</p>
                            </a>
                        </span>
                    </div>
                </nav>
            </div>