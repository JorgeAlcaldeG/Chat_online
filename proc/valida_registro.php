<?php
if (filter_has_var(INPUT_POST, 'registrarse')) {
    include("../func/campoVacio.php");

}else{
    header('Location: '.'../form_registro.php');  
    exit();
}
var_dump($_POST);

$errores = "";
if(validaCampoVacio($_POST["user"])){
    if (!$errores){
        $errores .="?userVacio=true";
    } else {
        $errores .="&userVacio=true";        
    }
}else{
    $user = $_POST["user"];
    if(strlen($user)>=15){
        if (!$errores){
            $errores .="?userMaxLength=true";
        } else {
            $errores .="&userMaxLength=true";        
        }
    }
}

if(validaCampoVacio($_POST["nombre"])){
    if (!$errores){
        $errores .="?nombreVacio=true";
    } else {
        $errores .="&nombreVacio=true";        
    }
}else{
    $nombre = $_POST["nombre"];
}

if(validaCampoVacio($_POST["apellido"])){
    if (!$errores){
        $errores .="?apellidoVacio=true";
    } else {
        $errores .="&apellidoVacio=true";        
    }
}else{
    $apellido = $_POST["apellido"];
}

if(validaCampoVacio($_POST["pwd1"])){
    if (!$errores){
        $errores .="?pwd1Vacio=true";
    } else {
        $errores .="&pwd1Vacio=true";        
    }
}else{
    $pwd1 = $_POST["pwd1"];
}

if(validaCampoVacio($_POST["pwd2"])){
    if (!$errores){
        $errores .="?pwd2Vacio=true";
    } else {
        $errores .="&pwd2Vacio=true";        
    }
}else{
    $pwd2 = $_POST["pwd2"];
}

if(isset($pwd1)&&isset($pwd2)){
    if($pwd1 === $pwd2){
        $pwdFinal = $pwd1;
    }else{
        if (!$errores){
            $errores .="?pwdUnmatch=true";
        } else {
            $errores .="&pwdUnmatch=true";        
        }
    }
}
if ($errores!=""){
    $datosRecibidos = array(
        'user' => $user,
        'nombre' => $nombre,
        'apellido' => $apellido,
    );
    $datosDevueltos=http_build_query($datosRecibidos);
    header("Location: ../form_registro.php". $errores. "&". $datosDevueltos);
    exit();
}else{
    echo'<form action="./proc_registro.php" method="post" id="RegistroCheck">
        <input type="text" name="user" id="user" value="'.$user.'" hidden>
        <input type="text" name="nombre" id="nombre" value="'.$nombre.'"hidden>
        <input type="text" name="apellido" id="apellido" value="'.$apellido.'"hidden>
        <input type="password" name="pwd" id="pwd" value="'.$pwdFinal.'"hidden>
        <input type="text" name="validado" value="validado"hidden>
        <button type="submit" name="RegistroCheck" hidden>Enviar</button>
        </form>
        <script>
            console.log(document.getElementById("RegistroCheck"))
            document.getElementById("RegistroCheck").submit();
        </script>';
}




