<?php

include ('uat_connectect.php');

$term = $_POST['term'];

$query = "select name from products where name like '%".$term."%'";

$result3 = mysqli_query($connec, $query);

$output = '';

while($data=mysqli_fetch_array($result3))
{
	$output.="<li onclick='putdata(this.innerHTML)'>".$data['name']."</li>";
}

echo $output;

?>