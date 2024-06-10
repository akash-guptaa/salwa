<?php 

include ("scm_header.php"); 


if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}


if(isset($_POST['submit'])){
	include ("config.php");
	
	$UnitID = mysqli_real_escape_string($conn,$_POST['UnitID']);
	$CompID = mysqli_real_escape_string($conn,$_POST['CompID']);
	$UnitName = mysqli_real_escape_string($conn,$_POST['UnitName']);
	$Description = mysqli_real_escape_string($conn,$_POST['Description']);
	$Status = mysqli_real_escape_string($conn,$_POST['Status']);
	
	$sql = "UPDATE unitlist SET CompanyID = '{$CompID}', Unit_Name = '{$UnitName}', Description = '{$Description}', Status = '{$Status}' WHERE Unit_ID = '$UnitID'";
	
	if(mysqli_query($conn, $sql)){
		?>
		
		<META HTTP-EQUIV="refresh" CONTENT="0; url=http://localhost/Salwa.sys/scm/scm_unit_list.php">
		
		<?php
		
		}
	
	}


?>

<html>
<body>
<div class="Dynamic-Area">

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
			  <button type="button" class="Dynamic-Option-Btn"> <a href="scm_unit_list.php"> Unit List </a> </button>
                  <h1 class="admin-heading">Modify Unit Details</h1>
              </div>
              <div class="Form-box">
			  <?php 
				include ("config.php");
				$UnitID = $_GET['id'];
				$sql1 = "SELECT * FROM unitlist WHERE Unit_ID = '$UnitID'";
				$result = mysqli_query($conn, $sql1) or die ("Query Failed");
				if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)){
			  ?>
	<br>	<br>	  
			  
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="UnitID"  class="form-control" value="<?php echo $row['Unit_ID']; ?>" placeholder="" >
                      </div>
					  <div class="form-group">
                          <input type="hidden" name="CompID"  class="form-control" value="<?php echo $row['CompanyID']; ?>" placeholder="" >
                      </div>
					  <div class="form-group">
                          <label>Unit Name</label>
                          <input type="text" name="UnitName" class="form-control" value="<?php echo $row['Unit_Name']; ?>" placeholder="Unit Name" required>
                      </div>
                      <div class="form-group">
                          <label>Description</label>
                          <input type="text" name="Description" class="form-control" value="<?php echo $row['Description']; ?>" placeholder=" Description " required>
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
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
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