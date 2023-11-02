<?php

    $servername = "localhost"; // Nombre del servidor
    $username = "chatonline"; // Nombre de usuario
    $password = "qweQWE123"; // Contraseña
    $dbname = "db_chatonline"; // Nombre de la base de datos
    try {
        $conn = @mysqli_connect($servername, $username, $password, $dbname);
        // Verificar si la conexión se estableció correctamente
        if (!$conn) {
            // echo "La conexión a la base de datos ha fallado: " . mysqli_connect_error();
            die(); // Otra opción es usar exit() para finalizar el script
        }
        // echo "conectado a server <br/>";
    } catch (Exception $e) {
        // Capturar la excepción y mostrar el mensaje de error
        echo "Error en la conexión a la base de datos: " . $e->getMessage();
        die();
    }


    