<?php

include ("config.php");

$SiteId = $_GET['id'];

$sql = "DELETE FROM sitelist WHERE site_id = {$SiteId}";

if(mysqli_query($conn, $sql)){
	header("Location: {$hostname}/scm/scm_site_list.php");
}else{
	echo "<p> Can't Delete the user record </p>";
}

mysqli_close($conn);


?>