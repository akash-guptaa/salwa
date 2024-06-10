<?php

include ("config.php");

$UserId = $_GET['id'];

$sql = "DELETE FROM userslist WHERE user_id = {$UserId}";

if(mysqli_query($conn, $sql)){
	header("Location: {$hostname}/scm/scm_users_list.php");
}else{
	echo "<p> Can't Delete the user record </p>";
}

mysqli_close($conn);


?>