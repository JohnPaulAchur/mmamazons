<?php


include 'header.php';

$added = "";
$errorMsg = "";
if (isset($_POST['add'])) {
$pos = check_input($_POST['pos']);
$cash = check_input($_POST['cash']);
$trans = check_input($_POST['trans']);
$exp = check_input($_POST['exp']);
$others = check_input($_POST['others']);
$exc = check_input($_POST['excess']);
$date = date('Y-m-d');

$total = check_input($_POST['total']);

    if (empty($pos) && empty($cash) && empty($trans) && empty($exp) && empty($others) && empty($exc)) {
        $errorMsg = "Operation Failed, All fields can't be empty !!!";
    }else{
        $register = dbconnect()->prepare("INSERT INTO income SET pos=?, cash=?, transfer=?, expenses=?, others=?, excess=?, total=?, editor=?, date=?");
        
        //alternate method
        // $register = dbconnect()->prepare("INSERT INTO advertisers(email,password,fullname,gender,age,phone,address,status,created) VALUE(?,?,?,?,?,?,?,?,?)");
        //alt.method
         if($register->execute([$pos,$cash,$trans,$exp,$others,$exc,$total,$username,$date]))
        {
        $added = "<h6 class='success'>Operation Successful !!!</h6>";
        }else{
            $errorMsg = "Oops! operation failed";
        }
    
    }
}
?>





<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Income</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Income</li>
                        </ol>
                        <div class="row p-1">


                        <div class="card mb-3 col-md-7">
                           
                                    <form method="POST">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2 ">Period:</div>
                                            <div class="col-md-4">
                                                <input type="date" name="from" class="form-control"/>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" name="to" class="form-control"/>
                                            </div>
                                            <div class="col-md-2"><button type="submit" class="btn btn-primary" name="subreport">submit</button></div>

                                        </div>
                                    </div>
                                    </form>
                            </div>
                            <!-- <div class="mb-3 col-md-1">
                            </div> -->
                        <div class="card mb-3 col-md-5">
                           
                            <div class="card-body">
                            <h6 class="error textcenter" style="float: left;">

                            <?php

                            if ($errorMsg != "") {
                            echo $errorMsg ;
                            unset($errorMsg);
                            }
                            ?>
                            <?php

                                if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                                }
                                if ($added != "") {
                                echo $added ;
                                unset($added);
                                }
                                ?>
                            </h6>

                            </div>

                            
                        </div>


                        
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                            
                            

                            <button type="button" class="btn btn-primary flows" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add</button>
                                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">Open modal for @fat</button> -->
                                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Open modal for @getbootstrap</button> -->

                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Input Today's Income Here</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST">
                                            <div class="row">  
                                                <div class="mb-3 col-md-6">
                                                    <label for="message-text" class="col-form-label">POS(N):</label>
                                                    <input type="number" min="0" class="form-control" name="pos" id="pos" oninput="addup()">
                                                </div>
                                                
                                                <div class="mb-3 col-md-6">
                                                    <label for="cash" class="col-form-label">Cash(N):</label>
                                                    <input type="number" min="0" class="form-control" name="cash" id="cash" oninput="addup()">
                                                </div>
                                            </div>
                                            <div class="row">  
                                                <div class="mb-3 col-md-6">
                                                    <label for="trans" class="col-form-label">Transfer(N):</label>
                                                    <input type="number" min="0" class="form-control" name="trans" id="trans" oninput="addup()">
                                                </div>
                                                
                                                <div class="mb-3 col-md-6">
                                                    <label for="exp" class="col-form-label">Expenses(N):</label>
                                                    <input type="number" min="0" class="form-control" name="exp" id="exp" oninput="addup()">
                                                </div>
                                            </div>
                                            <div class="row">  
                                                <div class="mb-3 col-md-6">
                                                    <label for="message-text" class="col-form-label">Others(N):</label>
                                                    <input type="number" min="0" class="form-control" name="others" id="others" oninput="addup()">
                                                </div>
                                                
                                                <div class="mb-3 col-md-6">
                                                    <label for="excess" class="col-form-label">Excess(N):</label>
                                                    <input type="number" min="0" class="form-control" name="excess" id="excess" oninput="addup()">
                                                </div>
                                            </div>
                                            <!-- <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label" >Quantity:</label>
                                                <input type="number" class="form-control" min="0" id="first" name="qty" oninput="calculation()" value="0000">
                                            </div>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Unit Price(N):</label>
                                                <input type="number" class="form-control" id="second" min="0" name="unit" oninput="calculation()" value="0000">
                                            </div> -->
                                            <div class="mb-3">
                                                <label for="total" class="col-form-label">Total(N):</label>
                                                <input type="number" min="0" class="form-control"  id="total" oninput="addup()" name="total">
                                            </div>
                                            

                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" name="add" class="btn btn-primary">Add</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                </form>
                                    
                                
                            
                            </div>
                            <div class="card-body">
                                <table id="example" class="display">
                                    <thead>
                                        <tr>
                                            <th width="3%">SN</th>
                                            <th>POS(N)</th>
                                            <th>Cash(N)</th>
                                            <th>Transfer(N)</th>
                                            <th>Expenses(N)</th>
                                            <th>Others(N)</th>
                                            <th>Excess(N)</th>
                                            <th>Total(N)</th>
                                            <th>Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>



                                    <?php 

                                    if(isset($_POST['subreport'])){

                                        $from = check_input( $_POST['from']);
                                        $to = check_input( $_POST['to']);

                                        if(empty($from) && empty($to)) {
                                            echo"<script>alert('The period fields are required')</script>";
                                        }else{
                                           // echo"<script>alert('The date are $from and $to')</script>";


                                            $n = 0;
                                        $query1 = "SELECT * FROM income WHERE date BETWEEN '$from' AND '$to' ORDER BY id DESC";
                                        $data = mysqli_query($connect,$query1);
                                        while($row = mysqli_fetch_assoc($data)) {
                                            $id = $row['id'];
                                            $n++;
                                            $pos = $row['pos'];
                                            $cash = $row['cash'];
                                            $trans = $row['transfer'];
                                            $exp = $row['expenses'];
                                            $others = $row['others'];
                                            $exc = $row['excess'];
                                            $total = $row['total'];
                                            $date = $row['date'];
                                            $editor = $row['editor'];

                                            ?>

                                            <tr>
                                            <td width='3%'><?php echo"$n"?></td>
                                            <td><?php echo"$pos"?></td>
                                            <td> <?php echo"$cash"?> </td>
                                            <td> <?php echo"$trans"?> </td>
                                            <td> <?php echo"$exp"?> </td>
                                            <td> <?php echo"$others"?> </td>
                                            <td> <?php echo"$exc"?> </td>
                                            <td> <?php echo"$total"?> </td>
                                            <td> <?php echo"$date"?> </td>

                                            <?php

                                                if($role =="Admin"){?>
                                                <td>
                                                <a href="del_inc.php?id=<?php echo $id; ?>"  onclick ="return confirm('Are you sure you want to delete?')"><i class="text-danger fa fa-trash"></i></a>
                                                </td>
                                                <?php }else{

                                                }
                                                ?>
                                            
                                        </tr>
                                            <?php

                                        }
                                           
                                        }

                                        

                                    }else{

                                        $sn = 1;
                                        $query1 = "SELECT * FROM income ORDER BY id DESC";
                                        $data = mysqli_query($connect,$query1);
                                        while($row = mysqli_fetch_assoc($data)) {
                                            $id = $row['id'];
                                            $pos = $row['pos'];
                                            $cash = $row['cash'];
                                            $trans = $row['transfer'];
                                            $exp = $row['expenses'];
                                            $others = $row['others'];
                                            $exc = $row['excess'];
                                            $total = $row['total'];
                                            $date = $row['date'];
                                            $editor = $row['editor'];

                                            ?>

                                   
                                        <tr>
                                            <td width="3%"><?php echo $sn++ ?></td>
                                            <td><?php echo $pos ?></td>
                                            <td><?php echo $cash ?></td>
                                            <td><?php echo $trans ?></td>
                                            <td><?php echo $exp ?></td>
                                            <td><?php echo $others ?></td>
                                            <td><?php echo $exc ?></td>
                                            <td><?php echo $total ?></td>
                                            <td><?php echo $date ?></td>
                                            <?php

                                            if($role =="Admin"){?>
                                            <td>
                                            <a href="del_inc.php?id=<?php echo $id; ?>"  onclick ="return confirm('Are you sure you want to delete?')"><i class="text-danger fa fa-trash"></i></a>
                                            </td>
                                            <?php }else{

                                            }
                                            ?>

                                        </tr>

                                    <?php } } ?>
                                    </tbody>
                                </table>
                                <?php
                                
                                if (isset($_POST['subreport'])) {
                                    $from = check_input( $_POST['from']);
                                    $to = check_input( $_POST['to']);?>
                                    <span class="my5">Sum Total(N) :</span>

                                <span ><b>
                                    <?php
                                    $query = "SELECT SUM(total) AS sum FROM income WHERE DATE BETWEEN '$from' AND '$to'";
                                    $data = mysqli_query($connect,$query);

                                    while($row = mysqli_fetch_assoc($data)){

                                        $sumTot = $row['sum'];
                                    }

                                    echo $sumTot;
                                }
                                else {?>
                                    <span class="my5">Sum Total(N) :</span>

                                <span ><b>
                                    <?php
                                    $query = "SELECT SUM(total) AS sum FROM income";
                                    $data = mysqli_query($connect,$query);

                                    while($row = mysqli_fetch_assoc($data)){

                                        $sumTotal = $row['sum'];
                                    }

                                    echo $sumTotal;
                                }
                                    ?>
                                    </b>
                                <span>

                                
                            </div>
                        </div>
                    </div>
                </main>


<?php


include 'footer.php';


?>