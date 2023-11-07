<?php
    function Isfriend($userID,$friendID){
        $sqlFriend="SELECT id_amigo FROM amigos WHERE id_user = ? AND id_user_amigo = ?";
        $stmt1 = mysqli_prepare($conn, $sqlFriend);
        mysqli_stmt_bind_param($stmt1, "ii", $userID,$friendID);
        mysqli_stmt_execute($stmt1);
        $res = mysqli_stmt_get_result($stmt1);
        if(mysqli_num_rows($res)>0){
            return true;
        }else{
            return false;
        }
    }
?>