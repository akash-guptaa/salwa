<?php 

include "scm_header.php"; 

if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}


if(isset($_POST['save'])){
	include ("config.php");
	
	$DepartName = mysqli_real_escape_string($conn,$_POST['DepartName']);
	$Address = mysqli_real_escape_string($conn,$_POST['Address']);
	$LName = mysqli_real_escape_string($conn,$_POST['LName']);
	$Status = mysqli_real_escape_string($conn,$_POST['Status']);
	
	$sql = "SELECT DepartName FROM departmentlist WHERE DepartName = '{$DepartName}'";
	$result = mysqli_query($conn, $sql) or die("Quey Failed");
	
	if(mysqli_num_rows($result) > 0){
		echo "<p style='color:red;text-align:center;margin: 10px;'> UserName already Exist </p>";
	}else{
		$sql1 = "INSERT INTO departmentlist (CompanyID, DepartName, Address, LocationName, Status)
		VALUES('{$CompID}','{$DepartName}','{$Address}','{$LName}','{$Status}')";
	if(mysqli_query($conn, $sql1)){
		?>
		<META HTTP-EQUIV="refresh" CONTENT="0; url=http://localhost/Salwa.sys/scm/scm_depart_list.php">
		<?php
	}
	
	}
}

?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> Add Brand </title>
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
			  <button type="button" class="Dynamic-Option-Btn"> <a href="scm_depart_list.php"> Department List </a> </button>
                  <h1 class=""> Add Department Form </h1>
              </div>
              <div class="Form-box">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off"> <br>
                      <div class="form-group">
                          <label></label>
                          <input type="hidden" name="" class="form-control" placeholder="Company ID" required>
                      </div>
					  
					  <div class="form-group">
                          <label>Department Name</label>
                          <input type="text" name="DepartName" class="form-control" placeholder="Department Name" required>
                      </div>
                      <div class="form-group">
                          <label>Address</label>
                          <input type="text" name="Address" class="form-control" placeholder="Address" required>
                      </div>
                      <div class="form-group">
                          <label>Location Name</label>
                          <input type="text" name="LName" class="form-control" placeholder="Location Name" required>
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