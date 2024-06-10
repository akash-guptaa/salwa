<?php

include ("config.php");

$Id = $_GET['id'];

$sql = "DELETE FROM userrolename WHERE UserRole_Id = '$Id'";

if(mysqli_query($conn, $sql)){
	header("Location: {$hostname}/scm/scm_userroles_list.php");
}else{
	echo "<p> Can't Delete the user record </p>";
}

mysqli_close($conn);


?>