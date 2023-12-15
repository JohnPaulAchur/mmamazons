
       <!-- TOTALS FOR EXPENSES -->
       
       
       <?php
        $query = "SELECT SUM(total) AS sum FROM expenses WHERE DATE BETWEEN '$from' AND '$to'";
        $data = mysqli_query($connect,$query);

        while($row = mysqli_fetch_assoc($data)){

            $sumTot = $row['sum'];
        }
        
        
        
        ?>





       <!-- TOTALS FOR INCOME -->
