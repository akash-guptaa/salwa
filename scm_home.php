<?php 

include "scm_header.php";

if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}

?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> SCM Oneview </title>
		<link rel="stylesheet" type="text/css" href="css/xxxx.css"/>
		
	</head>
	
	<style>
	table {
		border-collapse: collapse;
		}
		.Admin-User-Table td {
		padding:10px;
			
		}
	
	.ActiveCompany {
		width:270px;
		height:60px;
	}
	
	.Table-Info {
		background-color:#49c1a2;
		color:#fff;
		height:50px;
		width: 240px;
		border-radius:10px;
		border: 0;
		outline: 0;
		cursor: pointer;
		font-size: 17px;
		margin: 0 10px;
		}
		
	.AdminHomeDynamicinfo{
		display: flex;
		justify-content: center;
		padding: 20px;
		
		}
		
	</style>


<body>
<div class="Dynamic-Area">
<center> <img src="images/Current-Company.jpg" class="ActiveCompany" /> </center>


<div class="AdminHomeDynamicinfo" align="center">
		<div class="Table-Info"> 
			[India Date] :
						<?php
						date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
						echo date('d-m-Y');;
						?>	<br>
						
			[India Time] :
						<?php
						date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
						echo date('h:i:sa');;
						?>	
		</div>
		
		<div class="Table-Info"> 
					[Qatar Date] :
						<?php
						date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
						echo date('d-m-Y');;
						?>	<br>
						
					[Qatar Time] :
						<?php
						date_default_timezone_set("Asia/Qatar");   //India time (GMT+5:30)
						echo date('h:i:sa');;
						?>	
		</div>
		
		<div class="Table-Info"> 
			Active Werehouse :  <?php 
								$query = "SELECT * FROM companylist WHERE COMPANYID='$CompID' AND STATUS='1'";
								$data = mysqli_query($conn, $query);
								$total = mysqli_num_rows($data);
								echo "$total"; 
							 ?>	<br>
			In-Active Werehouse : <?php 
								$query = "SELECT * FROM companylist WHERE COMPANYID='$CompID' AND STATUS='0'";
								$data = mysqli_query($conn, $query);
								$total = mysqli_num_rows($data);
								echo "$total"; 
							 ?>	<br>
		</div>
		<div class="Table-Info"> 
			Active Brand :  <?php 
								$query = "SELECT * FROM brandlist WHERE COMPANYID='$CompID' AND STATUS='1'";
								$data = mysqli_query($conn, $query);
								$total = mysqli_num_rows($data);
								echo "$total"; 
							 ?>	<br>
			In-Active Brand : <?php 
								$query = "SELECT * FROM brandlist WHERE COMPANYID='$CompID' AND STATUS='0'";
								$data = mysqli_query($conn, $query);
								$total = mysqli_num_rows($data);
								echo "$total"; 
							 ?>	<br>
		</div>
<br>
		<div class="Table-Info"> 
			Active Users : <?php 
								$query = "SELECT * FROM userslist WHERE COMPID='$CompID' AND STATUS='1'";
								$data = mysqli_query($conn, $query);
								$total = mysqli_num_rows($data);
								echo "$total"; 
							 ?>	<br>
			In-Active Users : <?php 
								$query = "SELECT * FROM userslist WHERE COMPID='$CompID' AND STATUS='0'";
								$data = mysqli_query($conn, $query);
								$total = mysqli_num_rows($data);
								echo "$total"; 
							 ?>	<br>
		</div>
</div>

</div> 
</body>
</html>