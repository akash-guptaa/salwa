<?php 

include "scm_header.php"; 

if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}


if(isset($_POST['save'])){
	include ("config.php");
	
	$URName = mysqli_real_escape_string($conn,$_POST['URName']);
	$Status = mysqli_real_escape_string($conn,$_POST['Status']);
	
	$sql = "SELECT UserRole_Name FROM userrolename WHERE UserRole_Name = '{$BName}'";
	$result = mysqli_query($conn, $sql) or die("Quey Failed");
	
	if(mysqli_num_rows($result) > 0){
		echo "<p style='color:red;text-align:center;margin: 10px;'> UserName already Exist </p>";
	}else{
		$sql1 = "INSERT INTO userrolename (CompanyID, UserRole_Name, Status)
		VALUES('{$CompID}','{$URName}','{$Status}')";
	if(mysqli_query($conn, $sql1)){
		?>
		<META HTTP-EQUIV="refresh" CONTENT="0; url=http://localhost/Salwa.sys/scm/scm_userroles_list.php">
		<?php
	}
	
	}
}

?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> Add User Role </title>
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
			  <button type="button" class="Dynamic-Option-Btn"> <a href="scm_userroles_list.php"> User Role List </a> </button>
                  <h1 class=""> Add User Role </h1>
              </div>
              <div class="Form-box">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off"> <br>
                      <div class="form-group">
                          <label></label>
                          <input type="hidden" name="" class="form-control" placeholder="Company ID" required>
                      </div>
					  
					  <div class="form-group">
                          <label>Role Name</label>
                          <input type="text" name="URName" class="form-control" placeholder="User Role Name" required>
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