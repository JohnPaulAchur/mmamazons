<?php
function dbconn(){
    try{
        $servername = 'localhost';
        $username = 'root';
        $password = '';

        $con = new pdo("mysql:host=$servername; dbname=havilah", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    }catch(PDOException $e){
        echo 'Erro extablishing connection'. $e->getMessage();
    }
}

function check_inpu($name){
    $data =trim($name);
    $data =stripslashes($name);
    $data =htmlspecialchars($name);
    return $data;
}
?>
<?php
$connect = mysqli_connect('localhost','root','','havilah');

?>
