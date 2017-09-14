<?php
    session_start();
    include_once('../includes/dbconnect.php');

    $uid = $_SESSION['user'];
    //$query = "SELECT username FROM members WHERE id = $uid";
        
    $stmt = $dbh->prepare("SELECT username FROM members WHERE id = ?");
    $stmt->bind_param('s', $uid);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($username);
    $stmt->fetch();
?>

<html>
<head>
	<title>Chat Box</title>
	<link rel="stylesheet" type="text/css" href="../styles/chat.css"/>
	<link rel="stylesheet" type="text/css" href="../styles/main.css">
	<link rel="stylesheet" href="../styles/semantic.min.css">
	<script src="http://code.jquery.com/jquery-1.9.0.js"></script>
	<script src="../js/semantic.min.js"></script>
	<script>
		$("#s").keypress(function(e) {
		    if(e.which == 13) {
		        alert('You pressed enter!');
		    	$("#sendBtn").click();
		    }
		});
		function submitChat(){
			const msgbox = document.getElementById('chatlogs');
			if(form1.msg.value == '' ){
				alert('Enter your message!');
				return;
				}
			var msg = form1.msg.value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open('GET','insert.php?msg='+msg, true);
			xmlhttp.send();
			$("#sendArea").val('');
			setInterval(function () {
			   $("#msgbox").animate({
			        scrollTop: $("#msgbox")[0].scrollHeight}, -500);}, 1000);			
		}
		$(document).ready(function(e){
			$.ajaxSetup({cache:false});
			setInterval(function(){$('#chatlogs').load('logs.php');}, 2000);
			msgbox.scrollTop = msgbox.scrollHeight;
		});
	</script>
</head>
<body>
    <header>
        <div class="navbar">
         <div class="buttons">
             <a href="../index.php">Home</a>
             <a href="../about.php">About</a>
             <a href="../chat/chat.php">Chat</a>
             <?php if(isset($_SESSION['user']) && $_SESSION['user']!='') : ?>
                 <a href="../logout.php">Logout</a>
             <?php endif; ?>
         </div>
        </div>
     <br><br>
      <a class="logolink" href="index.php">
          <img src="../images/teemaslogoedited.png" id="teemaslogo" alt="Teemas Logo">
      </a>
    </header>
       <br><br>
        <div id="wrapper">
            <div id="content">  
	            <div id="menu">
		            <p class="welcome">
			            Welcome: <b><?php echo $username; ?></b>
		            </p>
		            <p class="logout"><a href="../logout.php" class="mini ui red button" id="sendBtn">Logout</a></p>
	            </div>
	            <div id="chatlogs">
	            </div>
	            <form name="form1">
	   	            <div class="ui input"> 
		    	        <input class="" name="msg" type="text" id="sendArea" size="50" />
		            </div>
		            <a href="#" onclick="submitChat()" class="mini ui inverted button">Send</a>
	            </form>
            </div>
        </div>
<!--
	<form name="form1">
	<table border="1" align="center">
		<tr>
			<td colspan="2">Welcome: <b><?php //echo $_SESSION["username"]; ?></b>    <a href="logout.php" class="mini ui red button" id="logoutBtn">Logout</a></td>
		</tr>
		
		<tr>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td id="chatlogs">
				LOADING CHATLOGS PLEASE WAIT... 
			</td>
		</tr>
		<tr>
			<td>Your Message:</td>
			<td><textarea name="msg" styles="width:200px; height: 70px" id="sendArea"></textarea></td>
		</tr>
	</table>
	</form>
-->
    <footer>
        <p class="footerp">&copy; Teemas &emsp; &emsp; <a href="../terms.php" id="termslink">Terms And Conditions</a></p>
    </footer>
    </body>
</html>