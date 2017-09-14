<?php
session_start();
include_once('dbconnect.php');

if(isset($_POST) && $_POST['mail']!='' && $_POST['pass']!='') {
    $email = $_POST['mail'];
    $password = $_POST['pass'];
    $stmt = $dbh->prepare("SELECT id, username, password, salt FROM members WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $username, $db_password, $salt);
    $stmt->fetch();
    $site_salt="subinsblogsalt";/*Common Salt used for password storing on site. You can't change it. If you want to change it, change it when you register a user.*/
    $salted_hash = hash('sha256',$password.$site_salt.$salt);
    if($db_password == $salted_hash) {
    $_SESSION['user']=$user_id;
        header("Location:../home.php");
    } else {
        header("Location:../login.php?error=1");
    }
}
?>