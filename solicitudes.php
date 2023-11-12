<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de amistad</title>
</head>
<body>
<?php 
    session_start();
    if(!isset($_SESSION["id"])){
        header('Location: '.'../index.php');
        exit();
    }
    include("./proc/conexion.php");
    try {
        $sqlChk="SELECT p.id_user AS 'id',u.user_username AS 'usuario' FROM peticiones `p` INNER JOIN usuarios `u` ON p.id_user = u.id_user WHERE p.id_user_amigo=?;";
        $stmt1 = mysqli_prepare($conn, $sqlChk);
        mysqli_stmt_bind_param($stmt1, "s", $_SESSION["id"]);
        mysqli_stmt_execute($stmt1);
        $res = mysqli_stmt_get_result($stmt1);
        $rows = mysqli_num_rows($res);
        if($rows == 0){
            echo "<p>No hay solicitudes pendientes</p>";
        }else{
            echo"<table>
                <tr>
                    <th>
                        Nombre
                    </th>
                    <th>
                        Aceptar
                    </th>
                    <th>
                        Rechazar
                    </th>
                </tr>";
            foreach ($res as $user) {
                echo"<tr>
                    <th>".$user["usuario"]."</th>";
                    echo'<th><a href="./proc/addFriend.php?id='.$user["id"].'">Aceptar</a></th>';
                    echo'<th><a href="./proc/RechazarFriend.php?id='.$user["id"].'">Rechazar</a></th>';
                echo"</tr>";
                // echo $user["id"]." - ".$user["usuario"];
            }
            echo "</table>";
        }
    } catch (Exception $e) {
        echo "Ha ocurrido un error con el registro: ".$e->getMessage();
        die();
    }
    echo'<a href="home.php">Volver</a>';
?>

</body>
</html>