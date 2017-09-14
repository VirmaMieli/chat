<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Landing Page</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
   <header>
       <div class="navbar">
        <div class="buttons">
          <a href="index.php">Home</a>
          <a href="about.php">About</a>
          <a href="chat/chat.php">Chat</a>
          <?php if(isset($_SESSION['user']) && $_SESSION['user']!='') : ?>
              <a href="logout.php">Logout</a>
          <?php endif; ?>
        </div>
       </div>
       <br><br>
       <a class="logolink" href="index.php">
          <img src="images/teemaslogoedited.png" id="teemaslogo" alt="Teemas Logo">
       </a>
   </header>
    
    <div class="wrapper">
       <div class="content">
           <br><br><br>
           <?php if(isset($_GET['logout']) && $_GET['logout'] == 1) : ?>
               <p class="logouttext">You are now logged out.</p>
           <?php endif; ?>
           <br><br>
            <a class="loginlink" href="login.php">
                <img src="images/loginpic.png" id="loginimg" alt="">
            </a>
            
            <a class="registerlink" href="register.php">
                <img src="images/Register.PNG" id="registerimg" alt="">
            </a>
       </div>
    </div>
    <footer>
        &copy; Teemas &emsp; &emsp; <a href="terms.php" id="termslink">Terms And Conditions</a>
    </footer>
</body>
</html>