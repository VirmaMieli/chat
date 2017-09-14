<?php
include_once('includes/dbconnect.php');
session_start();
if(isset($_SESSION['user']) && $_SESSION['user']!='') {
    header("Location:home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/main.css">
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <header>
       <img src="images/teemaslogoedited.png" id="teemaslogo" alt="Teemas Logo">
    </header>
    <div class="wrapper">
        <div class="content">
            <br><br><br>
            <?php if(isset($_GET['error'])) : ?>
                <p class="loginerror">Error logging in!</p>
            <?php endif; ?>
            <br><br>
            <form class="loginform" method="POST" action="includes/process_login.php">
                <table width="300" cellpadding="4" cellspacing="1">
                    <tr>
                        <td colspan="3"><strong>User Login</strong></td>
                    </tr>
                    <tr>
                        <td width="78">E-Mail</td><td width="6">:</td>
                        <td width="294"><input size="25" name="mail" type="text"></td>
                    </tr>
                    <tr>
                        <td>Password</td><td>:</td><td><input name="pass" size="25" type="password"></td><!--subinsiby -->
                    <tr>
                        <td></td><td></td><td><input type="submit" name="Submit" value="Login"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <footer>
        <p class="footerp">&copy; Teemas &emsp; &emsp; <a href="terms.php" id="termslink">Terms And Conditions</a></p>
    </footer>
</body>
</html>