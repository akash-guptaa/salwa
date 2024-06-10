<?php

include ("config.php");

$UnitId = $_GET['id'];

$sql = "DELETE FROM unitlist WHERE Unit_id = {$UnitId}";

if(mysqli_query($conn, $sql)){
	header("Location: {$hostname}/scm/scm_unit_list.php");
}else{
	echo "<p> Can't Delete the user record </p>";
}

mysqli_close($conn);


?>