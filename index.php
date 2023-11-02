<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <!-- 
    Variables Forumlario:
        - USER -> user
        - PASSWORD -> pwd
        - ENVIAR -> submit
     -->
    <form action="./proc/proc_val.php" method="post">
        <label for="user">Usuario</label>
        <input type="text" name="user" id="user">
        <label for="user">Contraseña</label>
        <input type="password" name="pwd" id="pwd">
        <input type="submit" value="enviar" name="enviar">
    </form>
    
</body>
</html>