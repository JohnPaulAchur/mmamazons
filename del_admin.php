




<?php


include 'connect/conn.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


$sql = "DELETE FROM admin WHERE id='$id'";


$res = mysqli_query($connect, $sql);




if ($res==TRUE) {

    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
    header("location:accounts.php");
}

else {

    $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again!</div>";
    header("location:accounts.php");
}


?>