<?php
require './conexion.php';

if (!filter_has_var(INPUT_POST, 'enviar')) {
    header('Location: '.'./../index.php');
    exit();
} else {
    require_once('./../func/funciones.php');
    
    $empty="";
    
    $user=$_POST['user'];
    $pwd=$_POST['pwd'];

    if (!validaCampoVacio($user)){
        $user=$_POST['user'];
    } else {
        if (!$empty){
           $empty .="?user=true";
        } else {
           $empty .="&user=true";        
        }
    }

    if (!validaCampoVacio($pwd)){
        $pwd=$_POST['pwd'];
    } else {
        if (!$empty){
           $empty .="?pwd=true";
        } else {
           $empty .="&pwd=true";        
        }
    }
    if ($empty!=""){
        echo "hay campos vacios";
        $variables = array('user' => $user);
        $error = http_build_query($variables);
        header("Location: ./../index.php".$empty."&".$error);
        exit();
    }else{
    }
    echo"<form id='login' action='proc_login.php' method='POST'>";
    echo"<input type='hidden' id='user' name='user' value='".$user."'>";
    echo"<input type='hidden' id='pwd' name='pwd' value='".$pwd."'>";
    echo "<script>document.getElementById('login').submit();</script>";

}