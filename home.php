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
    <?php
        $sqlFriends = "SELECT a.id_user AS 'ID1',u.user_username AS 'nombre1',a.id_user_amigo AS 'ID2',u2.user_username AS 'nombre2' FROM `amigos` a INNER JOIN `usuarios` u on a.id_user = u.id_user INNER JOIN `usuarios` u2 ON u2.id_user =a.id_user_amigo WHERE a.id_user = ? OR a.id_user_amigo = ?"; 
        $stmt1 = mysqli_prepare($conn, $sqlFriends);
        mysqli_stmt_bind_param($stmt1, "ii", $_SESSION["id"],$_SESSION["id"]);
        mysqli_stmt_execute($stmt1);
        $res = mysqli_stmt_get_result($stmt1);
        $rows = mysqli_num_rows($res);
        ?>
    
    <h1>Amigos</h1>
    <?php
        foreach ($res as $friend) {
            // var_dump($friend);
            if($friend["ID1"] == $_SESSION["id"]){
                echo'<a href="chat.php?id='.$friend["ID2"].'">'.$friend["nombre2"].'</a>';
            }else{
                echo'<a href="chat.php?id='.$friend["ID1"].'">'.$friend["nombre1"].'</a>';
            }
        } 
    ?>
    <a href="./proc/cerrarSesion.php">Volver</a>
</body>
</html>