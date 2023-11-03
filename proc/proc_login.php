<?php
    require 'conexion.php';
    $user = mysqli_real_escape_string($conn,$_POST['user']);
    $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
    //Consulta

    $sql_login = "SELECT user_username, user_pwd from usuarios where user_username = ?";
    $stm_consulta = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stm_consulta, $sql_login);
    mysqli_stmt_bind_param($stm_consulta, "s", $user);

    mysqli_stmt_execute($stm_consulta);
    $verif = mysqli_stmt_get_result($stm_consulta);
    $verif = mysqli_fetch_assoc($verif);

    

    if (password_verify($pwd, $verif['user_pwd'])) {
        echo 'Password is valid!';
        echo "<br>";
        echo "acceso al chat";
        session_start();


    } else {
        echo $pwd;
        echo "<br>";
        echo $userpwd;
        echo "<br>";
        echo 'Invalid password.';
    }