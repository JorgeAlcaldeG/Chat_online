<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Comporbmos variables de sesión -->
    <?php
        session_start();
        $_SESSION["id"] = "5";
        $_SESSION["nom"] = "joalga";
        echo $_SESSION["id"];
        if(!isset($_SESSION["id"])){
            header('Location: '.'../index.php');
            exit();
        }

    ?>
    <title>Home <?php echo " de ".$_SESSION["nom"]; ?></title>
</head>
<body>
    <?php 
        include("./proc/conexion.php");
        try {
            $sqlChk="SELECT id_peticion FROM `peticiones` WHERE id_user_amigo=?";
            $stmt1 = mysqli_prepare($conn, $sqlChk);
            mysqli_stmt_bind_param($stmt1, "s", $_SESSION["id"]);
            mysqli_stmt_execute($stmt1);
            $res = mysqli_stmt_get_result($stmt1);
            $rows = mysqli_num_rows($res);
            echo'<a href="./solicitudes.php"?>Ver solicitudes('.$rows.')</a>';
        } catch (Exception $e) {
            echo "Ha ocurrido un error con el registro: ".$e->getMessage();
            die();
        }
    ?>
    <h1>Bienvenido <?php echo  $_SESSION["nom"]?></h1>
    <!-- Formulario de búsqueda de usuarios -->
    <form action="./searchUser.php" method="post">
        <input type="text" name="search">
        <button type="submit">Buscar</button>
    </form>
</body>
</html>