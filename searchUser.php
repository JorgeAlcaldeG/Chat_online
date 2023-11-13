<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/home.css">
    <title>🔎 Buscando...</title>
</head>
<body>
    <?php
    session_start();
    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="./home.php"><h1>Bienvenido <?php echo  $_SESSION["nom"]?></h1></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
          <form class="d-flex" role="search">
        <button type="button" class="btn btn-danger"><a href="./proc/cerrarSesion.php">Cerrar sesión</a></button>
          </form>
        </div>
      </div>
    </nav>
<?php
// CONSULTA DE DATOS QUE NOS DEVUELVE
// var_dump($_SESSION);
// var_dump($_POST);

if(isset($_SESSION["id"])){
    if(!empty($_POST["search"])){
        include("./proc/conexion.php");
    }else{
        header('Location: '.'home.php');
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
    echo '<br> <div class="cont-center" <h2>No se han encontrado usuarios</h2> </div>';
}else{
    include("./func/userPeticionStatus.php");
    include("./func/isFriend.php");
    $resultados=0;

    echo'<div class="cont-center">';
        foreach ($res as $user) {
            if($_SESSION["id"] ==$user["id_user"] || Isfriend($_SESSION["id"],$user["id_user"])){
                continue;
            }
            echo'<div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"> '.$user["user"].'</h5>
                    '.getUserStatus($_SESSION["id"],$user["id_user"]).'
                </div>
            </div>';
            $resultados++;
        }
    echo"</div> <br>";

    if($resultados==0){
        echo "<p>No se han encontrado usuarios</p>";
    }
    echo'<a class="btn btn-warning" href="home.php">Volver</a>';
}
?>
</body>
</html>