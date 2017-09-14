<?php
session_start();
include_once('includes/dbconnect.php');
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
            <?php
                if($_SESSION['user']=='') {
                    header("Location:login.php");
                } else {
                    $uid = $_SESSION['user'];
                    //$query = "SELECT username FROM members WHERE id = $uid";
        
                    $stmt=$dbh->prepare("SELECT username FROM members WHERE id = ?");
                    $stmt->bind_param('s', $uid);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($username);
                    $stmt->fetch();
                    echo '<center><h2 class="welcometext">Welcome, '.$username.'!</h2></center>';
                    
                    /* Here comes the chat pool and input for new chat subjects */
                    
                }
            ?>
            <center>
                <a href="chat/chat.php">
                    <button>Join Chat!</button>
                </a>
            </center>
       </div>
    </div>
    <footer>
        &copy; Teemas &emsp; &emsp; <a href="terms.php" id="termslink">Terms And Conditions</a>
    </footer>
</body>
</html>