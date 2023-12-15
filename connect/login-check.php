
<?php

if(!isset($_SESSION['user'])){
    $_SESSION['nologin'] = "<br>Please Login to access the Dashboard !!!</br>";
    header('location:index.php');
}

?>
