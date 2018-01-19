<?php
session_start();

require 'mysql.php';

$error = 1;

if (!isset($_POST['userid'])) {
    $error = 1;
    $message = 'Invalid POST';
}elseif (!isset($_SESSION['user_id'])) {
    $error = 1;
    $message = 'Not logged in!';
}else {
    $query = "UPDATE users SET player_id='" . $mysqli->real_escape_string($_POST['userid']) . "' WHERE user_id = '".$mysqli->real_escape_string($_SESSION['user_id'])."'";
    mysqli_query($mysqli, $query);

	$query = "INSERT INTO user_players SET user_id='".$mysqli->real_escape_string($_SESSION['user_id'])."', player_id='".$mysqli->real_escape_string($_POST['userid'])."', created=NOW()";
	mysqli_query($mysqli, $query);
	$error = 0;
	$message = 'OK';


}

echo json_encode(array('error'=>$error, 'message'=>$message));