<?php include 'header.php'; ?>

<?php
// ob_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
}





if(isset($_POST['update'])){

    $new_username = check_input($_POST['new_username']);
    $new_email = check_input($_POST['new_email']);
    $new_phone = check_input($_POST['new_phone']);
    
   


    if(empty($new_username)){
        $msg = "Username is Required!!!";
        echo "<script> alert('$msg')</script>";
    }elseif(empty($new_email)){
        $msg = "Email is Required!!!";
        echo "<script> alert('$msg')</script>";
    }elseif(empty($new_phone)){
        $msg = "Phone Number is Required!!!";
        echo "<script> alert('$msg')</script>";
    }else{
        
        

        $query = dbconnect()->prepare("UPDATE admin SET username='$new_username', email='$new_email', Phone='$new_phone' WHERE id=?");
        if ($query->execute([$id])){
            $msg = "Update Successful!!!";
            echo "<script> alert('$msg'); window.location='logout.php';</script>";
        }else{
            $msg = "error occured!!!";
            echo "<script> alert('$msg')</script>";
        }
    }
}


?>















<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Update Profile</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="accounts.php">Accounts</a></li>
                            <li class="breadcrumb-item active">Update Profile</li>
                        </ol>
                        <div class="inthebox">
                        <div class="carod">

                               <div class="carodjr">
                                   <div class="card-header">
                                      <b> Current Details:</b>
                                   </div>
                                   <div class="currentdet">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label"><b>Username:</b></label>
                                          <?php echo $username; ?>          
                                    </div> 
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label"><b>E-mail:</b></label>
                                          <?php echo $email; ?>          
                                    </div> 
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label"><b>Phone Number:</b></label>
                                          <?php echo $phone; ?>          
                                    </div> 
                                </div>
                                </div>
                        
                            <div class="carodjr">
                                    <div class="card-header">
                                    <b>New Details:</b>
                                   </div>
                                   <div class="currentdetnew">
                                   <form action="" method="POST">
                                   <div class="">
                                        <label for="recipient-name" class="col-form-label">Username:</label>
                                        <input type="text"  class="form-control driph" name="new_username">         
                                    </div> 
                                    <div class="">
                                        <label for="recipient-name" class="col-form-label">E-mail:</label>
                                        <input type="text"  class="form-control driph" name="new_email">            
                                    </div> 
                                    <div class="">
                                        <label for="recipient-name" class="col-form-label">Phone Number:</label>
                                        <input type="text"  class="form-control driph" name="new_phone">         
                                    </div> 
                                    <button class="updateBtn btn-primary btn-block" name="update">Update</button>
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                                   
                                    </form>
                </div>
            </main>





































<!-- 
<div id="layoutSidenav_content">
    <main>
    <div class="container-fluid px-4">

    

<div class="row">




 
            <h5>Update stock</h5>
            <form method="POST">
        <div class="modal-body">
            
            
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Item Name:</label>
                    <input type="text"  class="form-control" value="php echo itemname" name="item" id="item">
                </div>
            
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label" >Quantity in stock:</label>
                <input type="number" class="form-control" min="0" value="php echo qty" id="quant" name="quant">
            </div>
            <hr> -->
            <!-- <div class="mb-3">
                <label for="recipient-name" class="col-form-label" >New Quantity in stock:</label>
                <input type="number" class="form-control" min="0" oninput="minus()" value="" id="rem" name="rem">
            </div> -->
            <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
            <!-- <button type="submit" name="update" class="btn btn-primary">Update</button>
        </div>
            
              </form>  
            

        </div>
        
        
        
        </div>


    </div>
    </div>

    </div>

   </div>
    </main> -->




<?php include 'footer.php'; ?>