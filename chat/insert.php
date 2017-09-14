<?php 
session_start();
include_once('../includes/dbconnect.php');
$uid = $_SESSION['user'];
$msg = $_REQUEST['msg'];
$stmt = $dbh->prepare("SELECT username FROM members WHERE id = ?");
$stmt->bind_param('s', $uid);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($uname);
$stmt->fetch();

/*$stmt = $dbh->prepare("INSERT INTO logs (username, msg) VALUES (?, ?)");
$stmt->bind_param('ss', $uname, $msg);
$stmt->execute();*/
/*$stmt->store_result();
$stmt->bind_result($result1, $result2, $result3);
$stmt->fetch();*/


$dbh->query("INSERT INTO logs (username, msg) VALUES ('$uname', '$msg')");
$result1 = $dbh->query("SELECT * FROM logs ORDER by id ASC");

while($extract = mysqli_fetch_array($result1)){
	echo "<span class='uname'>" . $extract['username'] . "</span>: <span class='msg'>" . $extract['msg'] . "</span><br>";
}

?>