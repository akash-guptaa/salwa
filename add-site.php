<?php 

include "scm_header.php"; 

if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}


if(isset($_POST['save'])){
	include ("config.php");
	
	$SiteName = mysqli_real_escape_string($conn,$_POST['SiteName']);
	$SiteDisplay = mysqli_real_escape_string($conn,$_POST['SiteDisplay']);
	$SiteType = mysqli_real_escape_string($conn,$_POST['SiteType']);
	$SiteAddress = mysqli_real_escape_string($conn,$_POST['SiteAddress']);
	$Status = mysqli_real_escape_string($conn,$_POST['Status']);
	
	$sql = "SELECT Site_Name FROM sitelist WHERE Site_Name = '{$SiteName}'";
	$result = mysqli_query($conn, $sql) or die("Quey Failed");
	
	if(mysqli_num_rows($result) > 0){
		echo "<p style='color:red;text-align:center;margin: 10px;'> UserName already Exist </p>";
	}else{
		$sql1 = "INSERT INTO sitelist (CompanyID, Site_name, Site_Display, Site_Type, Site_Address, Status)
		VALUES('{$CompID}','{$SiteName}','{$SiteDisplay}','{$SiteType}','{$SiteAddress}','{$Status}')";
	if(mysqli_query($conn, $sql1)){
		?>
		
		<META HTTP-EQUIV="refresh" CONTENT="0; url=http://localhost/Salwa.sys/scm/scm_site_list.php">
		
		<?php
	}
	
	}
}

?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> Add Site </title>
		<link rel="stylesheet" type="text/css" href="css/scm_active_stylesheet.css" />
		
	</head>
	
	<style>
		table {
			border-collapse: collapse;
			}
		.Admin-User-Table td {
			padding:10px;
			
		}	
		.Admin-User-Table th {
			padding:10px;
			background:#00b4d8;
			color: white;
			
		}	
		
	</style>


<body>
<div class="Dynamic-Area">

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
			  <button type="button" class="Dynamic-Option-Btn"> <a href="scm_site_list.php"> All Site List </a> </button>
                  <h1 class="admin-heading">Add Site</h1>
              </div>
              <div class="Form-box">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off"> <br>
                      <div class="form-group">
                          <label>Site Name</label>
                          <input type="text" name="SiteName" class="form-control" placeholder="Site Name" required>
                      </div>
					  
					  <div class="form-group">
                          <label>Site Display</label>
                          <input type="text" name="SiteDisplay" class="form-control" placeholder="Site Display" required>
                      </div>
					  <div class="form-group">
                          <label>Site Type</label>
                          <select class="form-control" name="SiteType" >
                              <option value="Others">Others</option>
                              <option value="POS">POS</option>
							  <option value="Section">Section</option>
							  <option value="Depart">Department</option>
							  <option value="Werehouse">Werehouse</option>
                          </select>
                      </div>
					  
                      <div class="form-group">
                          <label>Site Addres</label>
                          <input type="text" name="SiteAddress" class="form-control" placeholder="Site Address" required>
                      </div>
                     
                      <div class="form-group">
                          <label>Status</label>
                          <select class="form-control" name="Status" >
                              <option value="1">Active</option>
                              <option value="0">In-Active</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>

</div>
</body>
</html>