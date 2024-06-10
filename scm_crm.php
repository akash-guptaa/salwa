<?php 

include "scm_header.php";

if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}

?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> SCM CRM </title>
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
<h1 class="admin-heading">CRM</h1>


<div class="AdminHomeDynamicinfo" align="center">
	
</div>

</div> 
</body>
</html>