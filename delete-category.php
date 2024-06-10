<?php

include ("config.php");

$Id = $_GET['id'];

$sql = "DELETE FROM categorylist WHERE Category_ID = '$Id'";

if(mysqli_query($conn, $sql)){
	header("Location: {$hostname}/scm/scm_category_list.php");
}else{
	echo "<p> Can't Delete the user record </p>";
}

mysqli_close($conn);


?>