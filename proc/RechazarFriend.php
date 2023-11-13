<?php
session_start();
if(isset($_SESSION["id"])){
    if(!empty($_GET["id"])){
        include("conexion.php");
    }else{
        header('Location: '.'../home.php');
        exit();
    }
}else{
    header('Location: '.'../index.php');
    exit();
}
$id = trim(mysqli_real_escape_string($conn, $_GET["id"]));

try {
    mysqli_autocommit($conn,false);
    $stmt1= mysqli_stmt_init($conn);
    mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
    $sqlDelete=  "DELETE FROM peticiones WHERE id_user=? AND id_user_amigo=?";
    mysqli_stmt_prepare($stmt1,$sqlDelete);
    mysqli_stmt_bind_param($stmt1,"ii",$id,$_SESSION["id"]);
    mysqli_stmt_execute($stmt1);
    mysqli_commit($conn);

    mysqli_stmt_close($stmt1);
    echo"Peticion rechazada";
    echo "<br>";
    echo '<a href="../home.php">Volver al Home</a>';
} catch (Exception $e) {
    echo "Ha ocurrido un error con el registro: ".$e->getMessage();
    die();
}