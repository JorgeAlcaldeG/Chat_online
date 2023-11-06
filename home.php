<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            session_start();
            $_SESSION["id"] = "3";
            $_SESSION["nom"] = "JorgeAG";
            if(!isset($_SESSION["id"])){
                header('Location: '.'../index.php');
                exit();
            }

        ?>
    <title>Home <?php echo " de ".$_SESSION["nom"]; ?></title>
</head>
<body>
    <h1>Bienvenido <?php echo  $_SESSION["nom"]?></h1>
</body>
</html>