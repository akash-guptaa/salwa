<?php 

include ("scm_header.php"); 


if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}


if(isset($_POST['submit'])){
	include ("config.php");
	
	$BrandID = mysqli_real_escape_string($conn,$_POST['BrandID']);
	$CompID = mysqli_real_escape_string($conn,$_POST['CompID']);
	$BName = mysqli_real_escape_string($conn,$_POST['BName']);
	$address = mysqli_real_escape_string($conn,$_POST['address']);
	$LName = mysqli_real_escape_string($conn,$_POST['LName']);
	$Status = mysqli_real_escape_string($conn,$_POST['Status']);
	
	$sql = "UPDATE brandlist SET BrandName = '{$BName}', address = '{$address}', LocationName = '{$LName}', Status = '{$Status}' WHERE BrandID = '$BrandID'";
	
	if(mysqli_query($conn, $sql)){
		?>
		
		<META HTTP-EQUIV="refresh" CONTENT="0; url=http://localhost/Salwa.sys/scm/scm_brand_list.php">
		
		<?php
		
		}
	
	}


?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> Company Details </title>
		<link rel="stylesheet" type="text/css" href="css/scm_active_stylesheet.css"/>
		
	</head>
	
	<style>
		
	</style>


<body>
<div class="Dynamic-Area">

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
			  
                  <h1 class="admin-heading">View Company Details</h1>
              </div>
              <div class="Form-box">
			  <?php 
				include ("config.php");
				
				$sql1 = "SELECT * FROM companylist WHERE CompanyID = '$CompID'";
				$result = mysqli_query($conn, $sql1) or die ("Query Failed");
				if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)){
			  ?>
	<br>	<br>	  
			  
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      
					  <div class="form-group">
                          <input type="text" name="CompID"  class="form-control" value="<?php echo $row['CompanyID']; ?>" placeholder="" >
                      </div>
					  <div class="form-group">
                          <label>Company Name</label>
                          <input type="text" name="BName" class="form-control" value="<?php echo $row['CompanyName']; ?>" placeholder="Brand Name" required>
                      </div>
                      <div class="form-group">
                          <label>Company Address</label>
                          <input type="text" name="address" class="form-control" value="<?php echo $row['CompanyAddress']; ?>" placeholder=" Brand Address" required>
                      </div>
                      <div class="form-group">
                          <label>GST Number</label>
                          <input type="text" name="LName" class="form-control" value="<?php echo $row['GSTNo']; ?>" placeholder="" required>
                      </div>
					  <div class="form-group">
                          <label>PAN Number</label>
                          <input type="text" name="LName" class="form-control" value="<?php echo $row['PANN']; ?>" placeholder="" required>
                      </div>
					  
					  <div class="form-group">
                          <label>TIN Number</label>
                          <input type="text" name="LName" class="form-control" value="<?php echo $row['TIN']; ?>" placeholder="" required>
                      </div>
					  
					  <div class="form-group">
                          <label>Contact Number</label>
                          <input type="text" name="LName" class="form-control" value="<?php echo $row['ContactNo']; ?>" placeholder="" required>
                      </div>
					  
					  <div class="form-group">
                          <label>Email Id</label>
                          <input type="email" name="LName" class="form-control" value="<?php echo $row['Email']; ?>" placeholder="" required>
                      </div>
					  
                      <div class="form-group">
                          <label>Status</label>
                          <select class="form-control" name="Status" value="<?php echo $row['Status']; ?>">
							<?php
								if($row['Status'] == 1){
									echo "<option value='0'>In-Active</option>
										  <option value='1' selected > Active </option>";
								}else{
									echo "<option value='0' selected > In-Active </option>
										  <option value='1'>Active</option>";
								}
							?>	
                          </select>
                      </div>
                     
                  </form>
                  <!-- /Form -->
				  <?php 
					}
				}
				  ?>
              </div>
          </div>
      </div>
  </div>

</body>
</html>