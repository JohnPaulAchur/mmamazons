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
                        <h1 class="mt-4">Out of Stock</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Out of Stock</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                List of Unavailable stock.
                            </div>
                        </div>
                        <div class="card mb-4">
                                    <div class="card-header">
                                    <i class="fa fa-sticky-note"></i>
                                    Out of Stock
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
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th width="5%">SN</th>
                                            <th width="50%">Item</th>
                                            <th width="15%">Unit</th>
                                            <th width="12%">Qty</th>
                                            <th width="18%">Date</th>
                                            <?php if($role =="Admin"){ ?>
                                            <th width="18%"></th>
                                            <?php } ?>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    <?php
                                        $n=0;
                                        $query1 = "SELECT * FROM stock WHERE qty='0' ORDER BY item";
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