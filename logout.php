<?php 

include 'connect/conn.php';

session_destroy();

header("location:index.php");


?>