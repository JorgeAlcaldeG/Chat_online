    <?php
        session_start();
        if(!isset($_SESSION["id"])){
            header('Location: '.'../index.php');
            exit();
        }else{
            if(isset($_GET["id"])){
                include("./proc/conexion.php");
                $id = trim(mysqli_real_escape_string($conn, $_GET["id"]));
            }else{
                header('Location: '.'../index.php');
                exit();
            }
        }
        $sqlUsr="SELECT user_username FROM `usuarios` WHERE id_user=?";
        $stmt1 = mysqli_prepare($conn, $sqlUsr);
        mysqli_stmt_bind_param($stmt1, "i", $id);
        mysqli_stmt_execute($stmt1);
        $res = mysqli_stmt_get_result($stmt1);
        foreach ($res as $user) {
            $user = $user['user_username'];
        }
        // echo $id;
        // echo "</br>";
        // echo $_SESSION["id"];
        $sqlChat="SELECT chat_msg AS 'msg', fecha, user_origen,user_destino FROM `chat` WHERE user_origen=? OR user_origen = ? AND user_destino=? or user_destino=? ORDER BY fecha ASC";
        $stmt2 = mysqli_prepare($conn, $sqlChat);
        mysqli_stmt_bind_param($stmt2, "iiii", $id,$_SESSION["id"],$id,$_SESSION["id"]);
        mysqli_stmt_execute($stmt2);
        $resChat = mysqli_stmt_get_result($stmt2);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat con <?php echo $user;?></title>
</head>
<body>
    <h1>Chat con <?php echo $user;?></h1>
    <!-- Cargamos el chat -->
    <?php
        foreach ($resChat as $msg) {
            // var_dump($msg);
            echo "Mensaje de ".$msg['user_destino']." => ".$msg['msg']." - ".$msg['fecha']."";
            echo"</br>";
        }
    ?>

    <!-- Enviar mensaje -->
    <form action="./proc/procChat.php" method="post">
        <input type="text" name="msg" id="msg">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <button type="submit">Enviar</button>
    </form>
    <a href="home.php">Volver</a>
</body>
</html>
<?php
