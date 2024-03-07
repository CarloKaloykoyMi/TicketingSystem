<?php
include ('mysql_connect.php');
session_start();
$user_id =$_SESSION['userid'];
session_destroy();
unset($_SESSION['auth_user']['username']);
unset($_SESSION['userid']);
unset($_SESSION['auth_user']['email']);
unset($_SESSION['auth_user']['role']);

header('Location: emplogin.php');

$stmt = $con->prepare("INSERT INTO audit_trail (user_id,action) VALUES(?,?)");

$action = 'Logout';

$stmt->bind_param("is",$user_id,$action);

if($stmt->execute()){
    echo "c";
}

?>