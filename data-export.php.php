<?php

session_start();
error_reporting(0);
include("MySQL_SCM-Conn.php");

$UserProfile = $_SESSION['username'];
if($UserProfile==true)
 {
	
 }
else 
 {
header("Location:SCM-LoginPage.php");
 }

include("SCM-PageHead.php");

?>


<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> Data Import </title>
		<link rel="stylesheet" type="text/css" href="css/XXXX.css"/>
		
	</head>
	
	

<body>

<div class="Page-Info">
	
<h2> Import Excel to Database </h2>
<hr><hr>
<br><br>

	<form action="" method="POST">	
				POS Consumption	: <input type="file" name="CompID" value="" /> 
				<input type="submit" name="submit" value="Import"/>
				<input type="reset" name="Clear"/>
	</form>

</div>
</div>
	

</div>
	
</body>

</html>

<?php

					$query = "SELECT * FROM USERSLIST WHERE 'CompanyID'";
					$data = mysqli_query($conne, $query);
					$total = mysqli_num_rows($data);
					$result = mysqli_fetch_assoc($data);
					 echo $result['CompanyID'];
					?>