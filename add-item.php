<?php 

include "scm_header.php"; 

if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}


if(isset($_POST['save'])){
	include ("config.php");
	
	$ItemName = mysqli_real_escape_string($conn,$_POST['ItemName']);
	$ItemDisplay = mysqli_real_escape_string($conn,$_POST['ItemDisplay']);
	$DefaultUnit = mysqli_real_escape_string($conn,$_POST['DefaultUnit']);
	$AvgRate = mysqli_real_escape_string($conn,$_POST['AvgRate']);
	$SaleRate = mysqli_real_escape_string($conn,$_POST['SaleRate']);
	$SaleUnit = mysqli_real_escape_string($conn,$_POST['SaleUnit']);
	$PurchRate = mysqli_real_escape_string($conn,$_POST['PurchRate']);
	$PurchUnit = mysqli_real_escape_string($conn,$_POST['PurchUnit']);
	$TransRate = mysqli_real_escape_string($conn,$_POST['TransRate']);
	$TransUnit = mysqli_real_escape_string($conn,$_POST['TransUnit']);
	$AltItemCode = mysqli_real_escape_string($conn,$_POST['AltItemCode']);
	$Barcode = mysqli_real_escape_string($conn,$_POST['Barcode']);
	$ItemType = mysqli_real_escape_string($conn,$_POST['ItemType']);
	$ItemMode = mysqli_real_escape_string($conn,$_POST['ItemMode']);
	$ItemCategory = mysqli_real_escape_string($conn,$_POST['ItemCategory']);
	$SubCategory = mysqli_real_escape_string($conn,$_POST['SubCategory']);
	$RecipeStatus = mysqli_real_escape_string($conn,$_POST['RecipeStatus']);
	$Item_Desc = mysqli_real_escape_string($conn,$_POST['Item_Desc']);
	$Yield = mysqli_real_escape_string($conn,$_POST['Yield']);
	$Convert_Factor = mysqli_real_escape_string($conn,$_POST['Convert_Factor']);
	$ProductionDepart = mysqli_real_escape_string($conn,$_POST['ProductionDepart']);
	$ShelfLife = mysqli_real_escape_string($conn,$_POST['ShelfLife']);
	$Status = mysqli_real_escape_string($conn,$_POST['Status']);
	
	$sql = "SELECT Item_Name FROM itemslist WHERE Item_Name = '{$ItemName}'";
	$result = mysqli_query($conn, $sql) or die("Quey Failed");
	
	if(mysqli_num_rows($result) > 0){
		echo "<p style='color:red;text-align:center;margin: 10px;'> UserName already Exist </p>";
	}else{
		$sql1 = "INSERT INTO itemslist (CompID, Item_Name, Display_Item, Default_Unit, Avg_Rate, Sale_Rate, Sale_Unit, Purch_Rate, Purch_Unit,
				Trans_Rate, Trans_Unit, Alter_ItemCode, Barcode, Item_Type, Item_Mode, Item_Category, Sub_Category, Recipe_Status, Item_Desc,
				Yield, Convert_Factor, Production_Depart, ShelfLife, Status)
				VALUES('{$CompID}','{$ItemName}','{$ItemDisplay}','{$DefaultUnit}','{$AvgRate}','{$SaleRate}','{$SaleUnit}','{$PurchRate}','{$PurchUnit}',
				'{$TransRate}','{$TransUnit}','{$AltItemCode}','{$Barcode}','{$ItemType}','{$ItemMode}','{$ItemCategory}','{$SubCategory}','{$RecipeStatus}','{$Item_Desc}',
				'{$Yield}','{$Convert_Factor}','{$ProductionDepart}','{$ShelfLife}','{$Status}')";
	if(mysqli_query($conn, $sql1)){
		?>
		<META HTTP-EQUIV="refresh" CONTENT="0; url=http://localhost/Salwa.sys/scm/scm_product_list.php">
		<?php
	}
	
	}
}

?>

<?php 
$query = "SELECT unit_ID, Unit_Name, CompanyID FROM unitlist WHERE COMPANYID='$CompID' ORDER BY unit_ID";
$UnitList = mysqli_query($conn, $query);

$query = "SELECT TaxId, TaxName, CompId FROM taxlist WHERE CompId='$CompID' ORDER BY TaxId";
$TaxList = mysqli_query($conn, $query);

$query = "SELECT unit_ID, Unit_Name, CompanyID FROM unitlist WHERE COMPANYID='$CompID' ORDER BY unit_ID";
$UnitList1 = mysqli_query($conn, $query);

$query = "SELECT unit_ID, Unit_Name, CompanyID FROM unitlist WHERE COMPANYID='$CompID' ORDER BY unit_ID";
$UnitList2 = mysqli_query($conn, $query);

$query = "SELECT unit_ID, Unit_Name, CompanyID FROM unitlist WHERE COMPANYID='$CompID' ORDER BY unit_ID";
$UnitList3 = mysqli_query($conn, $query);

$query = "SELECT Category_ID, Category_Name, CompanyID FROM categorylist WHERE COMPANYID='$CompID' ORDER BY Category_ID";
$CATEGORYLIST = mysqli_query($conn, $query);

$query = "SELECT Site_ID, Site_Name, CompanyID FROM sitelist WHERE COMPANYID='$CompID' ORDER BY Site_ID";
$SITELIST = mysqli_query($conn, $query);

?>

<html>
	<head>
		<meta charset="UTF-8"/>
		<meta http-equiv="X-UA-Compatable" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
				
		<link rel="stylesheet" type="text/css" href="css/Register-stylesheet.css"/>
		<title> Add Item </title>
		
	</head>
	
	<style>
		
	</style>


<body>
<div class="Dynamic-Area">
<button type="button" class="Dynamic-Option-Btn"> <a href="scm_product_list.php"> All Items List </a> </button>
	<div class="container">
		<header> Add New Item </header>
		<form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off"> <br>
			<div class="form first">
				<div class="Details Personal">
					<span class="title"> Section 1 | Item Details </span>
					
					<div class="fields">
									
						<div class="input-field">
							<label> Item Name</label>
							<input type="text" name="ItemName" placeholder="Item Name" required />
						</div>
						
						<div class="input-field">
							<label> Item Display Name</label>
							<input type="text" name="ItemDisplay" placeholder="Display Name" required />
						</div>
						
						<div class="input-field">
							<label> Item Category Name</label>
							<select class="form-control" name="ItemCategory" placeholder="Item Category" id="SearchDropeDown5" required >
							<option Select hidden>  </option>
							<?php while($row1 = mysqli_fetch_array($CATEGORYLIST)):; ?>
							<option> <?php echo $row1[1]; ?> </option>
							<?php endwhile; ?>
							</select>
						</div>
						
						<div class="input-field">
							<label> Default Unit</label>
							<select class="form-control" name="DefaultUnit" id="SearchDropeDown3" required >
							<option Select hidden> </option>
							<?php while($row1 = mysqli_fetch_array($UnitList)):; ?>
							<option> <?php echo $row1[1]; ?> </option>
							<?php endwhile; ?> <br><br><br>
							</select>
						</div>
						<br>						
						<div class="input-field">
							<label> Average Rate </label>
							<input type="number" name="AvgRate" step="any" placeholder="Average Rate" required />
						</div>
						
						<div class="input-field">
							<label> Sub Category Name </label>
							<input type="text" name="SubCategory" value="N/A" placeholder="Item Sub Category" required />
						</div>
						
						<div class="input-field">
							<label> Item Type</label>
							<select class="form-control" name="ItemType" id="SearchDropeDown1" required >
							  <option Select hidden> </option>
                              <option value="Raw-Items"> Raw-Item </option>
							  <option value="Semi-Items"> Semi-Item </option>
							  <option value="Finished"> Finished </option>
                              <option value="Menu-Items"> Menu-Items </option>
							  <option value="DirectSale-Items"> Direct Sale Items </option>
							  <option value="Services"> Services </option>
							</select>
						</div>
						
						<div class="input-field">
							<label> Tax </label>
							<select class="form-control" name="ItemMode" id="SearchDropeDown2" required >
							   <option Select hidden> </option>
                              <?php while($row1 = mysqli_fetch_array($TaxList)):; ?>
							<option> <?php echo $row1[1]; ?> </option>
							<?php endwhile; ?>
							</select>
						</div>
						
						<div class="input-field">
							<label> Item Type [Foods / Non-Food] </label>
							<select class="form-control" name="ItemMode" id="SearchDropeDown6" >
							  <option value="Others"> Other </option>
                              <option value="Foods"> Foods </option>
                              <option value="Non-Food"> Non-Food </option>
							</select>
						</div>
						
					</div>
				</div>
				
				<div class="Details Personal">
					<span class="title"> Section 2 | Transaction Parameter </span>
					
					<div class="fields">
									
						<div class="input-field">
							<label> Sale Rate </label>
							<input type="number" name="SaleRate" value="0.00" placeholder="Sale Rate" required />
						</div>
						
						<div class="input-field">
							<label> Purch Rate </label>
							<input type="number" name="PurchRate" value="0.00" placeholder="Purch Rate" required />
						</div>
						
						<div class="input-field">
							<label> Trans Rate </label>
							<input type="number" name="TransRate" value="0.00" placeholder="Trans Rate" required />
						</div>
						
						<div class="input-field">
							<label> Sale Unit</label>
							<select class="form-control" name="SaleUnit" value="Not Define" id="SearchDropeDown9">
							<option Select hidden> </option>
							<?php while($row1 = mysqli_fetch_array($UnitList1)):; ?>
							<option> <?php echo $row1[1]; ?> </option>
							<?php endwhile; ?> <br><br><br>
							</select>
						</div>
						
						<div class="input-field">
							<label> Purch Unit</label>
							<select class="form-control" name="PurchUnit" value="Not Define" id="SearchDropeDown10">
							<option Select hidden> </option>
							<?php while($row1 = mysqli_fetch_array($UnitList2)):; ?>
							<option> <?php echo $row1[1]; ?> </option>
							<?php endwhile; ?> <br><br><br>
							</select>
						</div>
						
						<div class="input-field">
							<label> Trans Unit</label>
							<select class="form-control" name="TransUnit" value="Not Define" id="SearchDropeDown11">
							<option Select hidden> </option>
							<?php while($row1 = mysqli_fetch_array($UnitList3)):; ?>
							<option> <?php echo $row1[1]; ?> </option>
							<?php endwhile; ?> <br><br><br>
							</select>
						</div>

						
					</div>
				</div>
				
				
				<div class="Details Identity">
					<span class="title"> Section 3 | Production & Others </span>
					
					<div class="fields">
						
						<div class="input-field">
							<label> Production Site / Department </label>
							<select class="form-control" name="ProductionDepart" value="Not Define" placeholder="Production Site or Department Name" id="SearchDropeDown8" >
							<option Select hidden>  </option>
							<?php while($row1 = mysqli_fetch_array($SITELIST)):; ?>
							<option> <?php echo $row1[1]; ?> </option>
							<?php endwhile; ?>
							</select>
						</div>
						
						<div class="input-field">
							<label> Shelf Life (No of Days) </label>
							<input type="text" name="ShelfLife" value="N/A" placeholder="Shelf Life" required />
						</div>
						
						
						<div class="input-field">
							<label> Recipe Status </label>
							<select class="form-control" name="RecipeStatus" id="SearchDropeDown4" >
                              <option value="Pending"> Pending </option>
                              <option value="Done"> Done </option>
							</select>
						</div>
						
						<div class="input-field">
							<label> Yield Percentage (%) </label>
							<input type="Number" name="Yield" value="100" placeholder="Yield" min="1" max="100" required />
						</div>
						
						<div class="input-field">
							<label> Convert_Factor </label>
							<input type="number" name="Convert_Factor" value="1" placeholder="Convert_Factor" required />
						</div>
												
						<div class="input-field">
							<label> Item Description </label>
							<input type="text" name="Item_Desc" value="N/A" placeholder="Item Description" required />
						</div>
						
						<div class="input-field">
							<label> Barcode </label>
							<input type="text" name="Barcode"  value="N/A" placeholder="Barcode" required />
						</div>
						
						<div class="input-field">
							<label> HSN Code </label>
							<input type="text" name="AltItemCode"  value="N/A" placeholder="Assign Item Number" required />
						</div>
						
						<div class="input-field">
							 <select class="form-control" name="Status" id="SearchDropeDown7" >
                              <option value="1">Active</option>
                              <option value="0">In-Active</option>
							</select>
						</div>
						
					</div>
									
					<button class="Next-Btn" name="save" value="Save"> 
						<span class="Btn-Text"> Submit	 </span>
						<i class="uil uil-navigator">  </i>
					</button>
					
					
				</div>
				
			</div>
		</form>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>

<script>
	
	$("#SearchDropeDown1").select2();
	$("#SearchDropeDown2").select2();
	$("#SearchDropeDown3").select2();
	$("#SearchDropeDown4").select2();
	$("#SearchDropeDown5").select2();
	$("#SearchDropeDown6").select2();
	$("#SearchDropeDown7").select2();
	$("#SearchDropeDown8").select2();
	$("#SearchDropeDown9").select2();
	$("#SearchDropeDown10").select2();
	$("#SearchDropeDown11").select2();

</script>


</div>
</body>
</html>