<?php 

include "scm_header.php";

if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}

?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> SCM Trans </title>
		<link rel="stylesheet" type="text/css" href="css/scm_active_stylesheet.css"/>
		
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
<h1 class="admin-heading">PO/TO/GRN Transactions
<button type="button" class="Dynamic-Option-Btn"> <a href="#"> Goods Returned </a> </button>
<button type="button" class="Dynamic-Option-Btn"> <a href="#"> Goods Received </a> </button>
<button type="button" class="Dynamic-Option-Btn"> <a href="#"> Transfer Orders </a> </button>
<button type="button" class="Dynamic-Option-Btn"> <a href="scm_PO_Register.php"> Purchase Orders </a> </button>
</h1>


<div class="AdminHomeDynamicinfo" align="center">
	
</div>

</div> 
</body>
</html>