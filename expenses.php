<?php


include 'header.php';


?>
 <?php
                            $added = "";
                            $errorMsg = "";
                            if (isset($_POST['add'])) {
                            $exp = check_input($_POST['exp']);
                            $qty = check_input($_POST['qty']);
                            $unit = check_input($_POST['unit']);
                            $totalexp = check_input($_POST['totalexp']);
                            $date = date('Y-m-d');
                            
                                if (empty($exp)) {
                                    $errorMsg = "Not Added, Item name is required !!!";
                                }elseif(empty($qty)){
                                    $errorMsg = "Item Quantity is required !!!";                                   
                                }elseif(empty($unit)){
                                    $errorMsg = "Unit Price is required !!!";
                                }elseif(empty($totalexp)){
                                    $errorMsg = "Invalid Input(s)";
                                }else{
                                    $register = dbconnect()->prepare("INSERT INTO expenses SET item=?, qty=?, unit_price=?, total=?, creator=?, date=?");
                                   
                                   //alternate method
                                   // $register = dbconnect()->prepare("INSERT INTO advertisers(email,password,fullname,gender,age,phone,address,status,created) VALUE(?,?,?,?,?,?,?,?,?)");
                                   //alt.method
                                   $registered = $register->execute([$exp,$qty,$unit,$totalexp,$username,$date]);
                                 if($registered){
                                    $added = "Operation Successful !!!";
                                 }else{
                                     $errorMsg = "operation failed";
                                 }
                                
                                }
                            }



                        ?>


<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Expenses</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Expenses</li>
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
                            <!-- <table>
                                        <thead>
                                        <tr> -->
                                        <!-- </tr>
                                    </thead>
                                    </table> -->
                            

                                
                                    <button type="button" class="btn btn-primary flows" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add</button>
                                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">Open modal for @fat</button> -->
                                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Open modal for @getbootstrap</button> -->

                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New Expense</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST">
                                            
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Item:</label>
                                                    <input type="text" class="form-control" name="exp" id="recipient-name">
                                                </div>
                                            
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label" >Quantity:</label>
                                                <input type="number" class="form-control" min="0" id="first" name="qty" oninput="calculation()" value="0000">
                                            </div>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Unit Price(N):</label>
                                                <input type="number" class="form-control" id="second" min="0" name="unit" oninput="calculation()" value="0000">
                                            </div>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Total(N):</label>
                                                <input type="number" class="form-control"  id="total" oninput="calculation()" value="0000" name="totalexp">
                                            </div>
                                            <div class="error textcenter">
                                               
                                                
                                               
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
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Unit Price(N)</th>
                                            <th>Total(N)</th>
                                            <th>Created</th>
                                            <th>creator</th>
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                    <?php
                                    if (isset($_POST['subreport'])){
                                        $from = check_input( $_POST['from']);
                                        $to = check_input( $_POST['to']);

                                        if(empty($from) && empty($to)) {
                                            echo"<script>alert('The period fields are required')</script>";
                                        }else{
                                           $n=0;
                                           $query1 = "SELECT * FROM expenses WHERE date BETWEEN '$from' AND '$to' ORDER BY id DESC";
                                        $data1 = mysqli_query($connect,$query1);
                                        while($row = mysqli_fetch_assoc($data1)) {
                                            $n++;
                                            $id = $row['id'];
                                            $item = $row['item'];
                                            $qty = $row['qty'];
                                            $unit= $row['unit_price'];
                                            $total = $row['total'];
                                            $date = $row['date'];
                                            $creator = $row['creator'];
                                            ?>

                                        <tr>
                                            <td style="width: 3px;"><?php echo $n; ?></td>
                                            <td><?php echo $item; ?></td>
                                            <td style="width: 3px;"><?php echo $qty; ?></td>
                                            <td><?php echo $unit; ?></td>
                                            <td><?php echo $total; ?></td>
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo $creator; ?></td>
                                            <?php

                                            if($role =="Admin"){  ?>
                                            <td>
                                            <a href="del_exp.php?id=<?php echo $id; ?>"  onclick ="return confirm('Are you sure you want to delete?')"><i class="text-danger fa fa-trash"></i></a>
                                            </td>
                                            <?php }else{

                                            }
                                            ?>
                                        </tr>

                                            <?php
                                    }
                                }
                            

                            }else {
                                    
                                    $sn = 1;
                                    $query = "SELECT * FROM expenses ORDER BY id DESC";
                                    
                                        
                                        
                                    $data = mysqli_query($connect,$query);

                                    while($row = mysqli_fetch_assoc($data)){
                                        $id = $row['id'];
                                        $item = $row['item'];
                                        $qty = $row['qty'];
                                        $unit= $row['unit_price'];
                                        $total = $row['total'];
                                        $date = $row['date'];
                                        $creator = $row['creator'];
                                        
                                    
                                    

                                   ?>

                                        <tr>
                                            <td style="width: 3px;"><?php echo $sn++; ?></td>
                                            <td><?php echo $item; ?></td>
                                            <td style="width: 3px;"><?php echo $qty; ?></td>
                                            <td><?php echo $unit; ?></td>
                                            <td><?php echo $total; ?></td>
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo $creator; ?></td>
                                            <?php

                                            if($role =="Admin"){?>
                                            <td>
                                            <a href="del_exp.php?id=<?php echo $id; ?>"  onclick ="return confirm('Are you sure you want to delete?')"><i class="text-danger fa fa-trash"></i></a>
                                            </td>
                                            <?php }else{

                                            }
                                            ?>
                                        </tr>


                                        <?php } }?>
                                        
                                    </tbody>
                                </table>
                                <?php
                                
                                if (isset($_POST['subreport'])) {
                                    $from = check_input( $_POST['from']);
                                    $to = check_input( $_POST['to']);?>
                                    <span class="my5">Sum Total(N) :</span>

                                <span ><b>
                                    <?php
                                    $query = "SELECT SUM(total) AS sum FROM expenses WHERE DATE BETWEEN '$from' AND '$to'";
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
                                    $query = "SELECT SUM(total) AS sum FROM expenses";
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