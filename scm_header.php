<?php
include ("config.php");
session_start();

if(!isset($_SESSION["username"])){
	header("Location: {$hostname}/scm/index.php");
}

$CompID = $_SESSION["CompID"];
$CompName = $_SESSION["CompName"];


?>

<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<link rel="stylesheet" type="text/css" href="css/scm_header_stylesheet.css"/>
		
	</head>
	
	<style>
			
	</style>

<body>
	<div class="Full-Page">
		
		<nav>
			<label class="NavCompHead"> Company Name: <?php echo $_SESSION["CompName"] ?> </label>
			<a href="SCM-Home.php"> <//img src="Menu-Icon/SCM-HomeBTN.png" class="Nav-HomeBTN"> </a>
			
			<ul>
			<button type="submit" class="NavOption-Btn"> <a href="scm_home.php">  Home </a> </button> 
			
			<button type="submit" class="NavOption-Btn" onclick="toggleMenu1()"> Functions </button>
				<div class="sub-menu-Wrap1" id="subMenu1">
				<div class="User-Sub-Menu1">
					<div class="User-info1">
						<img src="Menu-Icon/DataMapp.png"/>
						<h3>Function (Masters List / Data Mapping)</h3>
					</div>
					
					<hr>
						
					<table class="NavBar-Table">
						
						<tr>
							<td><a href="scm_product_list.php" class="User-sub-menu-link1"> 
							<img src="Menu-icon/profile.png"/>
							<p> Items List </p> </a> 
							
							</td>
							
							<td> 
							<a href="scm_category_list.php" class="User-sub-menu-link1"> 
							<img src="Menu-icon/setting.png"/>
							<p> Category List </p> </a>
							</td>
							
							<td> 
							<a href="scm_unit_list.php" class="User-sub-menu-link1"> 
							<img src="Menu-icon/setting.png"/>
							<p> Unit List </p> </a>
							</td>
							
							<td> 
							<a href="scm_site_list.php" class="User-sub-menu-link1"> 
							<img src="Menu-icon/setting.png"/>
							<p> Sites List </p> </a>
							</td>
							
						</tr>
						
						<tr>
							<td><a href="scm_supplier_list.php" class="User-sub-menu-link1"> 
							<img src="Menu-icon/profile.png" />
							<p> Supplers List </p> </a> 
							
							</td>
							
							<td> 
							<a href="#" class="User-sub-menu-link1"> 
							<img src="Menu-icon/setting.png" />
							<p> Item Supplers Mapping </p> </a>
							</td>
							
							<td> 
							<a href="scm_tax_list.php" class="User-sub-menu-link1" > 
							<img src="Menu-icon/setting.png" />
							<p> Tax List </p> </a>
							</td>
							
							<td> 
							<a href="scm_paymentmodes_list.php" class="User-sub-menu-link1" > 
							<img src="Menu-icon/setting.png" />
							<p> Payment Modes </p> </a>
							</td>
							
						</tr>
						
						<tr> 
						<td> 
						<a href="scm_users_list.php" class="User-sub-menu-link1"> 
							<img src="Menu-icon/help.png" />
							<p> Users List </p>
			
						</a>
						</td>
						
						<td> 
						<a href="scm_userroles_list.php" class="User-sub-menu-link1"> 
							<img src="Menu-icon/help.png" />
							<p> User Role List </p>
			
						</a>
						</td>
						
						<td> 
						<a href="scm_depart_list.php" class="User-sub-menu-link1"> 
							<img src="Menu-icon/help.png" />
							<p> Department List </p>
			
						</a>
						</td>
						
						<td> 
						<a href="scm_recipe_list" class="User-sub-menu-link1" > 
							<img src="Menu-icon/help.png" />
							<p> Recipe List </p>
			
						</a>
						</td>
						
						</tr>
						
						<tr>
						<td>
						<a href="Data-Import.php" class="User-sub-menu-link1" > 
							<img src="Menu-icon/logout.png" />
							<p> Data Import </p>
							
						</a>
						</td>
						<td>
						<a href="Data-Import.php" class="User-sub-menu-link1" > 
							<img src="Menu-icon/logout.png" />
							<p> Data Import </p>
							
						</a>
						</td>
						</tr>
						
					</table>
				</div>
				
			</div>
				
			
			<button type="submit" class="NavOption-Btn" onclick="openPopup()"> Settings </button>
				<div class="NavMaster-Popup" id="popup">
				<br>
				<h2> Settings / Control Pannel </h2>
					<hr>
					<br>
					<button type="button" class="NavPopup-Btn"> <a href="#" > Define Company Details </a> </button>
					<button type="button" class="NavPopup-Btn"> <a href="scm_brand_list.php" > Brand List </a></button> 
					<button type="button" class="NavPopup-Btn"> <a href="#" > Bill Series </a></button> <br><br>
					<button type="button" class="NavPopup-Btn"> SCM Access Control </button>
					<button type="button" class="NavPopup-Btn"> POS Access Control </button> 
					<button type="button" class="NavPopup-Btn"> Other Access Control </button> <br><br>
					<button type="button" class="NavPopup-Btn"> Partners Control Pannel</button>
					<button type="button" class="NavPopup-Btn"> Templates List </button>
					<button type="button" class="NavPopup-Btn"> Combo Offer List </button> <br><br>
					<button type="button" class="NavPopup-Btn"> <a href="uat.php" > UAT Page </a></button>
					<button type="button" class="NavPopup-Btn"> <a href="data-import.php" > Data Import </a></button>
					<button type="button" class="NavPopup-Btn">	<a href="data-export.php" > Data Export </a> </button>
					
					<br>
					<button type="submit" class="NavMaster-Close" onclick="closepopup()"> Close </button>
					
				</div>
				
				
				<li> <a href="#"> Tools	 				</a></li>
				
			</ul>
			
			<img src="Images/Dummy-User.png" class="NavUser-pic" onclick="toggleMenu()"/>
			<div class="sub-menu-Wrap" id="subMenu">
				<div class="User-Sub-Menu">
					<div class="User-info">
						<img src="users-image/Dummy-User.png" />
						<h3>User : <?php echo $_SESSION["username"] ?> </h3>
					</div>
					
					<hr>
					
						<a href="#" class="User-sub-menu-link"> 
							<img src="Menu-icon/profile.png" />
							<p> Edit Profile </p>
							<span> > </span>
						</a>
					
						<a href="#" class="User-sub-menu-link"> 
							<img src="Menu-icon/setting.png" />
							<p> Settings & Privacy </p>
							<span> > </span>
						</a>
						
						<a href="#" class="User-sub-menu-link"> 
							<img src="Menu-icon/help.png" />
							<p> Help & Support </p>
							<span> > </span>
						</a>
						
						<a href="Logout.php" class="User-sub-menu-link"> 
							<img src="Menu-icon/logout.png" />
							<p> Logout </p>
							<span> > </span>
						</a>
					
				</div>
			</div>
			
		</nav>
		
		
<br><br><br>

<div class="Main-Page">
	<div class="side-menu">
			<ul>
				<li> <a href="scm_transactions.php"> Transactions	</a></li>
				<li> <a href="#"> Productions	</a></li>
				<li> <a href="#"> Stocks		</a></li>
				<li> <a href="#"> Accounts		</a></li>
				<li> <a href="scm_crm.php"> CRM </a></li>
				<li> <a href="#"> Events 		</a></li>
				<li> <a href="#"> Task List 	</a></li>
				<li> <a href="#"> Checklists 	</a></li>
				<li> <a href="#"> Timelines 	</a></li>
				<li> <a href="#"> Imp Notes 	</a></li>
				<li> <a href="scm_report.php"> Reports 		</a></li>
			</ul>
			
	</div>	

</div>
</div>

<script>
		let subMenu = document.getElementById("subMenu");
		
		function toggleMenu(){
			subMenu.classList.toggle("open-menu");
		}
	
		let subMenu1 = document.getElementById("subMenu1");
		
		function toggleMenu1(){
			subMenu1.classList.toggle("open-menu1");
		}
	
		let popup = document.getElementById("popup");
	
		function openPopup(){
		popup.classList.add("open-popup");
		}
	
		function closepopup(){
		popup.classList.remove("open-popup");
		}
		
</script>	



</body>

</html>