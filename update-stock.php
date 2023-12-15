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



if(isset($_POST['update'])){

    $itm = check_input($_POST['item']);
    $qty = check_input($_POST['quant']);
    
   


    if(empty($itm)){
        $msg = "name is Required!!!";
        echo "<script> alert('$msg')</script>";
    }elseif(empty($qty)){
        $msg = "qty Required!!!";
        echo "<script> alert('$msg')</script>";
    }else{
        
        

        $query = dbconnect()->prepare("UPDATE stock SET item='$itm', qty='$qty' WHERE id=?");
        if ($query->execute([$id])){
            $msg = "Update Successful!!!";
            echo "<script> alert('$msg'); window.location='stock.php';</script>";
            // $remain = $_POST['rem'];
            // $query1 = dbconnect()->prepare("UPDATE stock SET qty='$remain' WHERE id=$id");
            // $_SESSION['upd'] = "successfully dispersed";
            // header('location:diperse.php');
        }else{
            $msg = "error occured!!!";
            echo "<script> alert('$msg')</script>";
        }
    }
}


?>



<div id="layoutSidenav_content">
    <main class="textcenter">
    <div class="container-fluid px-4">

    

<div class="row">




  <div class="col-md-6">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update stock</h5>
            <form method="POST">
        </div>
        <div class="modal-body">
            
            
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Item Name:</label>
                    <input type="text"  class="form-control" value="<?php echo $itemName; ?>" name="item" id="item">
                </div>
            
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label" >Quantity in stock:</label>
                <input type="number" class="form-control" min="0" value="<?php echo $qty; ?>" id="quant" name="quant">
            </div>
            <hr>
            <!-- <div class="mb-3">
                <label for="recipient-name" class="col-form-label" >New Quantity in stock:</label>
                <input type="number" class="form-control" min="0" oninput="minus()" value="" id="rem" name="rem">
            </div> -->
            <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
            <button type="submit" name="update" class="btn btn-primary">Update</button>
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