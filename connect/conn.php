<?php

session_start();
function dbconnect(){
    try{
        $servername = 'localhost';
        $username = 'root';
        $password = '';

        $con = new pdo("mysql:host=$servername; dbname=foodlicious", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    }catch(PDOException $e){
        echo 'Error establishing connection'. $e->getMessage();
    }
}

function check_input($name){
    $data =trim($name);
    $data =stripslashes($name);
    $data =htmlspecialchars($name);
    return $data;
}


?>


<?php
$connect = mysqli_connect('localhost','root','','foodlicious');
$conn = new mysqli('localhost', 'root', '', 'foodlicious');

if($conn->connect_error){
    die('connect fail'.$conn->connect_error);
}


?>
