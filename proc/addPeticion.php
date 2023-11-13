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
    $stmt1= mysqli_stmt_init($conn);
    $sqlInsert=  "INSERT INTO peticiones (id_peticion, id_user, id_user_amigo, fecha) VALUES (NULL, ?,?,curdate());";
    mysqli_stmt_prepare($stmt1,$sqlInsert);
    mysqli_stmt_bind_param($stmt1,"ii",$_SESSION["id"],$id);
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_close($stmt1);
    echo"Petición enviada correctamente";
    echo "<br>";
    echo '<a href="../home.php">Volver al Home</a>';

} catch (Exception $e) {
    echo "Ha ocurrido un error con el registro: ".$e->getMessage();
    die();
}
