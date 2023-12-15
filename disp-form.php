<?php include 'header.php' ?>

<?php
// ob_start();
$id = $_GET['id'];
$quer = dbconnect()->prepare("SELECT * FROM stock WHERE id=?");
$quer->execute([$id]);
$row = $quer->fetch();
if($no = $quer->rowcount()>0){
    $itemName = $row['item'];
    $qty = $row['qty'];
    

}

$error="";

if(isset($_POST['disperse'])){
// echo "<script>alert('jjhhkjljljl')</script>";
    $emplo = check_input($_POST['employee']);
    $qty = check_input($_POST['disp']);
    // $itm = $itemName;
    $date = date('Y-m-d');

    if(empty($_POST['employee'])){
        //$error = "employee's name is Required !!!";	

        $msg = "employee's name is Required !!!";
        //echo "<script> alert('$msg'); window.location='stock.php';</script>";
    }elseif(empty($_POST['disp'])){
        $msg = "item qty is Required !!!";
        echo "<script> alert('$msg'); window.location='stock.php';</script>";
    }elseif(empty($_POST['item']) || empty($_POST['quant'])){
        $msg = "Some required fields are empty !!!";
        echo "<script> alert('$msg'); window.location='stock.php';</script>";
    }else{

        $query = dbconnect()->prepare("INSERT INTO disperse SET employee=?, qty=?, item=?, date=?");
        $done = $query->execute([$emplo,$qty,$itemName,$date]);
        
        if ($done) {
            
            $remain = $_POST['rem'];
            $query1 = dbconnect()->prepare("UPDATE stock SET qty=? WHERE id=?");
             if($query1->execute([$remain,$id])){
            
            $msg = "Dispersing Successful!!!";
            echo "<script> alert('$msg'); window.location='disperse.php';</script>";
            // $_SESSION['upd'] = "successfully dispersed";
            // header('location:diperse.php');
        }else{
            $msg = "error occured!!!";
            echo "<script> alert('$msg')</script>";
        }
    }
}
}

?>



<div id="layoutSidenav_content">
    <main class="textcenter">
    <div class="container-fluid px-4">

    

<div class="row">

<?php 
if($error !== ""){
	echo "<mark>$error</mark>";
}

 ?>


<div class="col-md-6">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Disperse Details</h5>
            
        </div>
        <form action="disp-form.php?id=<?php echo $id; ?>" method="POST">
        <div class="modal-body">
           
            
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Employee's Name:</label>
                    <input type="text" class="form-control" name="employee" id="employee">
                </div>
            
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label" >Quantity to disperse:</label>
                <input type="number" class="form-control" min="0" oninput="minus()" max="<?php echo $qty; ?>" id="disp" name="disp">
            </div>
            

        </div>
        
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
            <button type="submit" name="disperse" class="btn btn-primary">Disperse</button>
        </div>
        
        </div>
    </div>
    </div>

    

  <div class="col-md-6">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">In Stock Details</h5>
            
        </div>
        <div class="modal-body">
            
            
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Item Name:</label>
                    <input type="text"  class="form-control" value="<?php echo $itemName; ?>" name="item" id="item" readonly>
                </div>
            
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label" >Quantity in stock:</label>
                <input type="number" class="form-control" min="0" value="<?php echo $qty; ?>" id="quant" name="quant" readonly>
            </div>
            <hr>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label" >New Quantity in stock:</label>
                <input type="number" class="form-control" min="0" oninput="minus()" value="" id="rem" name="rem" readonly>
            </div>
                    
            
              </form>  
            

        </div>
        
        
        
        </div>


    </div>
    </div>

    </div>

   </div>
    </main>










<?php include 'footer.php'; ?>