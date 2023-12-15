<?php


include 'header.php';


?>



<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dispersed Items</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Dispersed Items Table</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                            Dispersed items are recorded here.
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                            
                                
                            </div>
                            <div class="card-body">
                            <table id="example" class="display">
                                    <thead>
                                        <tr>
                                            <th width="3%">SN</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Date</th>
                                            <th>Employee</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                    <?php
                                        $n=0;
                                        $query1 = "SELECT * FROM disperse ORDER BY id DESC";
                                        $data1 = mysqli_query($connect,$query1);
                                        while($row = mysqli_fetch_assoc($data1)) {
                                            $n++;
                                            $id = $row['id'];
                                            $item = $row['item'];
                                            $qty = $row['qty'];
                                            $date = $row['date'];
                                            $employee = $row['employee'];
                                            ?>
                                    
                                        <tr>
                                            <td style="width: 3px;"><?php echo $n; ?></td>
                                            <td><?php echo $item; ?></td>
                                            <td ><?php echo $qty; ?></td>
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo $employee; ?></td>
                                            

                                <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        </div>
                        
                </main>
            </div>
</div>




<?php


include 'footer.php';


?>