<?php


include 'header.php';


?>
 <?php
                            $added = "";
                            $errorMsg = "";
                            if (isset($_POST['add'])) {
                            $itm = check_input($_POST['itm']);
                            $qty = check_input($_POST['qty']);
                            $unit = check_input($_POST['unit']);
                            $date = date('Y-m-d');
                            
                                if (empty($itm)) {
                                    $errorMsg = "Not Added, Item name is required !!!";
                                }elseif(empty($qty)){
                                    $errorMsg = "Item Quantity is required !!!";                                   
                                }else{
                                    $register = dbconnect()->prepare("INSERT INTO stock SET item=?, unit=?, qty=?, date=?");
                                   
                                   //alternate method
                                   // $register = dbconnect()->prepare("INSERT INTO advertisers(email,password,fullname,gender,age,phone,address,status,created) VALUE(?,?,?,?,?,?,?,?,?)");
                                   //alt.method
                                   $registered = $register->execute([$itm,$unit,$qty,$date]);
                                 if($registered){
                                    $added = "<span style='color:#14fc43;'>Operation Successful !!!</span>";
                                 }else{
                                     $errorMsg = "operation failed";
                                 }
                                
                                }
                            }



                        ?>



<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Stock</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Stock</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                List of all available stock.
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
                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary flows" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add</button>
                                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">Open modal for @fat</button> -->
                                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Open modal for @getbootstrap</button> -->

                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New Stock</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST">
                                                
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Item:</label>
                                                    <input type="text" class="form-control" name="itm" id="recipient-name">
                                                </div>
                                            
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label" >Quantity:</label>
                                                <input type="number" class="form-control" min="0" id="first" name="qty">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label" >Unit:</label>
                                                <!-- <input type="number" class="form-control" min="0" id="first" name="qty"> -->
                                                <select class="form-control drip" name="unit" placeholder=" - Select Unit -">
                                                <option>Pack</option>
                                                <option>Tin</option>
                                                <option>Bag</option>
                                                <option>Litre(s)</option>
                                                <option>Kg</option>
                                                </select>
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
                                            <th width="5%">SN</th>
                                            <th width="50%">Item</th>
                                            <th width="15%">Unit</th>
                                            <th width="12%">Qty</th>
                                            <th width="18%">Date</th>
                                            <?php if($role =="Admin"){ ?>
                                            <th width="18%"></th>
                                            <th width="18%"></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                    <?php
                                        $n=0;
                                        $query1 = "SELECT * FROM stock WHERE qty>'0' ORDER BY item";
                                        $data1 = mysqli_query($connect,$query1);
                                        while($row = mysqli_fetch_assoc($data1)) {
                                            $n++;
                                            $id = $row['id'];
                                            $item = $row['item'];
                                            $unit = $row['unit'];
                                            $qty = $row['qty'];
                                            $date = $row['date'];
                                            ?>
                                    
                                        <tr>
                                            <td style="width: 3px;"><?php echo $n; ?></td>
                                            <td><?php echo $item; ?></td>
                                            <td ><?php echo $unit; ?></td>
                                            <td ><?php echo $qty; ?></td>
                                            <td><?php echo $date; ?></td>
                                            <?php

                                            if($role =="Admin"){?>
                                            <td width="3%">
                                                <a href="disp-form.php?id=<?php echo $id ?>" class="text-danger"><i class="fa fa-shopping-cart"></i></a>
                                            </td>
                                            <td width="3%">
                                                <a href="update-stock.php?id=<?php echo $id ?>" class="text-success"><i class="fa fa-edit"></i></a>                                                                   
                                             </td>


                                <?php } } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        </div>
                        
                </main>

<?php


include 'footer.php';


?>