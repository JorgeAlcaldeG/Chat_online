<?php
    require 'conexion.php';
    $user = mysqli_real_escape_string($conn,$_POST['user']);
    $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);

    //Consulta
    mysqli_autocommit($conn, false);
    
    $sql_login = "SELECT user_username, user_pwd from usuarios where user_username = ?";
    $stm_consulta = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stm_consulta, $sql_login);
    mysqli_stmt_bind_param($stm_consulta, "s", $user);

    var_dump(mysqli_stmt_execute($stm_consulta));

    if (password_verify('qweQWE123', $pwd)) {
        echo 'Password is valid!';
        echo "<br>";
        echo "acceso al chat";
        session_start();

    } else {
        echo 'Invalid password.';
    }