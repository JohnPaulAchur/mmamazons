

<?php
include 'connect/conn.php';
$id = $_GET['id'];


if($id){
$sql = "DELETE FROM income WHERE id='$id'";
$res = mysqli_query($connect, $sql);
if($res==True){
    //  echo "<script>alert('Record deleted successfully'); window.location='course.php'</script>";
    $_SESSION['msg'] = "Record deleted successfully";
    header('location:http://localhost/super/income.php');

     }else{
      $_SESSION['msg'] = "Operation Failed !!!";
     }
}


?>
