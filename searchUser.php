<?php
session_start();
var_dump($_SESSION);
var_dump($_POST);

if(isset($_SESSION["id"])){
    if(!empty($_POST["search"])){
        include("./proc/conexion.php");
    }else{
        header('Location: '.'../home.php');
        exit();
    }
}else{
    header('Location: '.'../index.php');
    exit();
}
$search = trim(mysqli_real_escape_string($conn, $_POST["search"]));
try {
    $param = "%{$search}%";
    $sqlChk="SELECT user_username as `user`,id_user FROM usuarios WHERE user_username like ? OR user_nom like ?";
    $stmt1 = mysqli_prepare($conn, $sqlChk);
    mysqli_stmt_bind_param($stmt1, "ss", $param,$param);
    mysqli_stmt_execute($stmt1);
    $res = mysqli_stmt_get_result($stmt1);
    
} catch (Exception $e) {
    echo "Ha ocurrido un error con el registro: ".$e->getMessage();
    die();
}
if(mysqli_num_rows($res)==0){
    echo "<p>No se han encontrado usuarios</p>";
}else{
    include("./func/userPeticionStatus.php");
    include("./func/isFriend.php");
    echo"<table>
        <tr>
            <th>Usuario</th>
            <th>Agregar</th>
        </tr>";
        foreach ($res as $user) {
            if($_SESSION["id"] ==$user["id_user"] || Isfriend($_SESSION["id"],$user["id_user"])){
                continue;
            }
            echo"<tr>
                <th>".$user["user"]."</th>
                <th>";
                    echo getUserStatus($_SESSION["id"],$user["id_user"]);
                    // echo'<a href="./proc/addPeticion.php?id='.$user["id_user"].'">Enviar solicitud</a>';
                echo"</th>
            </tr>";
        }
    echo"</table>";
}