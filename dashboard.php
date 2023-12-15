

<?php

include 'header.php'

?>




<?php
$query = "SELECT SUM(total) AS sum FROM expenses";
$data = mysqli_query($connect,$query);

while($row = mysqli_fetch_assoc($data)){

    $sumTotal = $row['sum'];
}
?>

<?php
$query = "SELECT SUM(total) AS sum FROM income";
$data = mysqli_query($connect,$query);

while($row = mysqli_fetch_assoc($data)){

    $sumTot = $row['sum'];
}
?>

<?php

    $outstock= 0;
    $query = "SELECT id FROM stock WHERE qty='0'";
    $data = mysqli_query($connect, $query);
    $numn = mysqli_num_rows($data);
    while($row = mysqli_fetch_assoc($data)){
        $outstock++;
    }

?>


<?php
	// $year = date('Y');

    // Get today's date in "Y-m-d" format
    $today = date("Y-m-d");

    // Initialize an array to store dates
    $dateArray = array();

    // Get dates for the last 10 days
    for ($i = 0; $i <= 5; $i++) {
        $date = date("Y-m-d", strtotime("-$i days"));
        // Add each date to the array
        $dateArray[] = date("M j",strtotime($date));

        //income query
		$queryInc = $connect->query("SELECT SUM(total) AS sumInc FROM income WHERE date=$date");

		// inc loop to get array
		while ($row=$queryInc->fetch_array()) {

			$gottenincTotals = $row['sumInc'];
			$eachIncTotal[] = $gottenincTotals;
			}
        
    }
    
	$dateFetch = $connect->query("SELECT DISTINCT DATE(date) AS unique_dates
    FROM income
    WHERE date BETWEEN CURDATE() - INTERVAL 10 DAY AND CURDATE();
    ");


	
	while ($row=$dateFetch->fetch_array()) {
		$date = $row['unique_dates'];
		
		//income query
		$queryInc = $connect->query("SELECT SUM(total) AS sumInc FROM income WHERE date=$date");



		// //sales query
		// $quer = $connect->query("SELECT sum(total) AS sumTotal FROM sales WHERE month=$month AND year=$year");

        $timeSt = strtotime($date);
		$eachDay[] = date('M j',$timeSt);



		// purchase loop to get array
		while ($row=$queryInc->fetch_array()) {

			$gottenincTotals = $row['sumInc'];
			$eachIncTotal[] = $gottenincTotals;
			}

		// sales loop to get array	
		// while ($brow=$quer->fetch_array()) {

		// 	$gottenTotals = $brow['sumTotal'];
		// 	$eachTotal[] = $gottenTotals;
		// 	}


	}
	
	?>


 


            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                            <div class="card bg-info text-white mb-4 bigger">
                                    <div class="card-body">Total Income <br><span style="color: #5e5656;"><b>( N )<?php echo $sumTot; ?></b></span></div> 
                                    <div class="card-footer d-flex align-items-center justify-content-between"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4 bigger">
                                    <div class="card-body">Total Expense <br><span style="color: #5e5656;"><b>( N )<?php echo $sumTotal; ?></b></span></div> 
                                    <div class="card-footer d-flex align-items-center justify-content-between"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                            <div class="card bg-cooler text-white mb-4 bigger">
                                    <div class="card-body">Profit<br><span style="color: #5e5656;"><b>( N )<?php echo $sumTot; ?></b></span></div> 
                                    <div class="card-footer d-flex align-items-center justify-content-between"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4 bigger">
                                    <div class="card-body">Out of Stock<br><span style="color: #5e5656;"><b><?php echo $numn; ?> Items</b></span></div> 
                                    <div class="card-footer d-flex align-items-center justify-content-between"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Income Chart
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
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
                                            <th width="3%"> </th>
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
                                            <td>
                                                <?php

                                                 if($role =="Admin"){
                                                     echo"<a href='del_exp.php?id=$id' class='btn text-danger'><span class='fa fa-trash'></span></a>";
                                                 }else{

                                                 }
                                                 ?>
                                            </td>
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
                                            <td>
                                                <?php

                                                 if($role =="Admin"){
                                                     echo"<a href='del_exp.php?id=$id' class='btn text-danger'><span class='fa fa-trash'></span></a>";
                                                 }else{

                                                 }
                                                 ?>
                                            </td>
                                        </tr>


                                        <?php } }?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                

<?php

        include 'footer.php';

?>

<!-- <script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($dateArray) ?>,
        datasets: [{
        label: "Sessions",
        lineTension: 0.3,
        backgroundColor: "rgba(2,117,216,0.2)",
        borderColor: "rgba(2,117,216,1)",
        pointRadius: 5,
        pointBackgroundColor: "rgba(2,117,216,1)",
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(2,117,216,1)",
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: <?php echo json_encode($eachIncTotal) ?>,
        }],
    },
    options: {
        scales: {
        xAxes: [{
            time: {
            unit: 'date'
            },
            gridLines: {
            display: false
            },
            ticks: {
            maxTicksLimit: 7
            }
        }],
        yAxes: [{
            ticks: {
            min: 0,
            max: 40000,
            maxTicksLimit: 5
            },
            gridLines: {
            color: "rgba(0, 0, 0, .125)",
            }
        }],
        },
        legend: {
        display: false
        }
    }
    });

</script> -->