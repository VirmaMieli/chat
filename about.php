<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us</title>
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
       <div class="aboutcontent">
          <div class="leftcontent">
              <h1 class="aboutsize">What is Teemas?</h1>
              <br>
              <p class="italic aboutsize">Share, listen & learn</p>
              <br>
              <p class="aboutsize">Everything starts with communicating. <br> Teemas is all about sharing thoughts and challenging one another with respect. </p>
          </div>
          <div class="rightcontent">
              <h1 class="aboutsize">Who are we?</h1>
              <br><br><br>
              <p class="aboutsize">Three guys from Finland who started to wonder <br> if there could be new ways of global, everyday communication possibilities. <br> We wanted to create a platform for everybody interested <br> in talking about world wide events.</p>
          </div>
       </div>
    </div>
    <footer>
        <p class="footerp">&copy; Teemas &emsp; &emsp; <a href="terms.php" id="termslink">Terms And Conditions</a></p>
    </footer>
</body>
</html>