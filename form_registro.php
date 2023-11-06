<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(isset($_GET["userExist"])){echo "<p>El nombre de usuario ya existe</p>";} ?>
    <form action="./proc/valida_registro.php" method="post" id=""registrarse"">
        <?php if(isset($_GET["userVacio"])){echo "<p>El campo es obligatorio</p>";} ?>
        <?php if(isset($_GET["userMaxLength"])){echo "<p>El campo debe tener menos de 16 caracteres</p>";} ?>
        <label for="user">Usuario</label>
            <input type="text" name="user" id="user" value="<?php if(isset($_GET["user"])){echo $_GET["user"];} ?>">
            <br>
        <?php if(isset($_GET["nombreVacio"])){echo "<p>El campo es obligatorio</p>";} ?>
        <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?php if(isset($_GET["nombre"])){echo $_GET["nombre"];} ?>">
            <br>
        <?php if(isset($_GET["apellidoVacio"])){echo "<p>El campo es obligatorio</p>";} ?>
        <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" value="<?php if(isset($_GET["apellido"])){echo $_GET["apellido"];} ?>">
            <br>
        <?php if(isset($_GET["pwd1Vacio"])){echo "<p>El campo es obligatorio</p>";} ?>
        <label for="pwd1">Contraseña</label>
            <input type="password" name="pwd1" id="pwd1">
            <br>
        <?php if(isset($_GET["pwd2Vacio"])){echo "<p>El campo es obligatorio</p>";} ?>
        <label for="pwd2">Repite la contraseña</label>
            <input type="password" name="pwd2" id="pwd2">
            <br>
        <?php if(isset($_GET["pwdUnmatch"])){echo "<p>La contraseña no coincide en ambos campos</p>";} ?>
        <button type="submit" name="registrarse">Enviar</button>
    </form>
</body>
</html>