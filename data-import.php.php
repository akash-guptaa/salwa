<?php
include "scm_header.php";

if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}



?>


<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> Data Import </title>
		<link rel="stylesheet" type="text/css" href="css/XXXX.css"/>
		
	</head>
	
	

<body>
<div class="Dynamic-Area">

	<div class="Page-Info">
	
	<h2> Import from Excel to Sql Database </h2>
	<hr><hr>
	<br><br>
	
	<form action="" method="POST">	
				POS Consumption	: <input type="file" name="CompID" value="" /> 
				<input type="submit" name="submit" value="Import"/>
				<input type="reset" name="Clear"/>
	</form>
	<br><hr><br>
	<form action="" method="POST">	
				POS Discounts	: <input type="file" name="CompID" value="" /> 
				<input type="submit" name="submit" value="Import"/>
				<input type="reset" name="Clear"/>
	</form>
	<br><hr><br>
	<form action="" method="POST">	
				POS Complementory	: <input type="file" name="CompID" value="" /> 
				<input type="submit" name="submit" value="Import"/>
				<input type="reset" name="Clear"/>
	</form>
	<br><hr><br>
	<form action="" method="POST">	
				Issueance	: <input type="file" name="CompID" value="" /> 
				<input type="submit" name="submit" value="Import"/>
				<input type="reset" name="Clear"/>
	</form>
	<br><hr><br>
	<form action="" method="POST">	
				Purchases	: <input type="file" name="CompID" value="" /> 
				<input type="submit" name="submit" value="Import"/>
				<input type="reset" name="Clear"/>
	</form>
	<br><hr><br>
	<form action="" method="POST">	
				Recipes	: <input type="file" name="CompID" value="" /> 
				<input type="submit" name="submit" value="Import"/>
				<input type="reset" name="Clear"/>
	</form>
	
</div>
</div>
	

</div>


</div>	
</body>
</html>
