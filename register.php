<?php
include_once('includes/dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
   <header>
       <img src="images/teemaslogoedited.png" id="teemaslogo" alt="Teemas Logo">
   </header>
   <div class="wrapper">
       <div class="content">
          <br><br><br><br>
           <form class="registerform" action="register.php" method="POST">
               <table width="300" cellpadding="4" cellspacing="1">
                    <tr>
                        <td colspan="3"><strong>Register</strong></td>
                    </tr>
                    <tr>
                        <td width="78">E-Mail</td><td width="6">:</td>
                        <td width="294"><input size="25" name="email" type="text"></td>
                    </tr>
                    <tr>
                        <td width="78">Username</td><td width="6">:</td>
                        <td width="294"><input size="25" name="user" type="text"></td>
                    </tr>
                    <tr>
                        <td>Password</td><td>:</td><td><input name="pass" size="25" type="password"></td><!--subinsiby -->
                    <tr>
                        <td></td><td></td><td><button name="submit">Register</button></td>
                    </tr>
                </table>
                 <?php
  if(isset($_POST['submit'])) {
      if(isset($_POST['user']) && isset($_POST['pass'])) {
          $password=$_POST['pass'];
          $stmt = $dbh->prepare("SELECT COUNT(*) FROM `members` WHERE `username`=?");
          $stmt->bind_param('s', $_POST['user']);
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($result);
          $stmt->fetch();
          
          if($result != 0) {
              echo "<center>User Exists</center>";
          } else {
              $stmt = $dbh->prepare("SELECT COUNT(*) FROM `members` WHERE `email`=?");
              $stmt->bind_param('s', $_POST['email']);
              $stmt->execute();
              $stmt->store_result();
              $stmt->bind_result($result);
              $stmt->fetch();
              
              if($result != 0) {
                  echo "<center>Email already in use!</center>";
              } else {
                  function rand_string($length) {
                  $str="";
                  $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                  $size = strlen($chars);
                  
                  for($i = 0;$i < $length;$i++) {
                      $str .= $chars[rand(0,$size-1)];
                  }
                  return $str; /* http://subinsb.com/php-generate-random-string */
              }
                  $p_salt = rand_string(20); /* http://subinsb.com/php-generate-random-string */
                  $site_salt="subinsblogsalt"; /*Common Salt used for password storing on site.*/
                  $salted_hash = hash('sha256', $password.$site_salt.$p_salt);
                  $stmt = $dbh->prepare("INSERT INTO members(username, email, password, salt) VALUES (?, ?, ?, ?);");
                  $stmt->bind_param('ssss', $_POST['user'], $_POST['email'], $salted_hash, $p_salt);
                  $stmt->execute();/*
                  $stmt->store_result();
                  $stmt->bind_result($result);
                  $stmt->fetch();*/
                  //$sql->execute(array($_POST['user'], $_POST['email'], $salted_hash, $p_salt));
                  echo "<center>Successfully Registered.</center>";
                  echo '<a class="loginlink" href="login.php"><img src="images/loginpic.png" id="loginimg" alt=""></a>';
              }
          }
      }
  }
?>
                  <!--<table>
                   <tr>
                       <td colspan="3"><strong>Username</strong></td>
                       <td><input size="25" name="user" type="text"></td>
                   </tr>
                   <tr>
                       <td colspan="3"><strong>Password</strong></td>
                       <input name="pass" type="password"/>
                   </tr>
                   <td><button name="submit">Register</button></td>
               </table>-->
            <!--<label>E-Mail <input name="user" /></label><br/>
            <label>Password <input name="pass" type="password"/></label><br/>
            <button name="submit">Register</button>-->
            </form>
       </div>
   </div>
    <footer>
        &copy; Teemas &emsp; &emsp; <a href="terms.php" id="termslink">Terms And Conditions</a>
    </footer>
</body>
</html>