<?php

include ("config.php");

$Id = $_GET['id'];

$sql = "DELETE FROM itemslist WHERE Item_id = {$Id}";

if(mysqli_query($conn, $sql)){
	header("Location: {$hostname}/scm/scm_product_list.php");
}else{
	echo "<p> Can't Delete the user record </p>";
}

mysqli_close($conn);


?>