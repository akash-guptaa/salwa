<?php 

include "scm_header.php"; 

if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}


if(isset($_POST['save'])){
	include ("config.php");
	
	$CompID = mysqli_real_escape_string($conn,$_POST['CompID']);
	$FName = mysqli_real_escape_string($conn,$_POST['fname']);
	$LName = mysqli_real_escape_string($conn,$_POST['lname']);
	$user = mysqli_real_escape_string($conn,$_POST['user']);
	$password = mysqli_real_escape_string($conn,md5($_POST['password']));
	$Status = mysqli_real_escape_string($conn,$_POST['Status']);
	
	$sql = "SELECT username FROM userslist WHERE username = '{$user}'";
	$result = mysqli_query($conn, $sql) or die("Quey Failed");
	
	if(mysqli_num_rows($result) > 0){
		echo "<p style='color:red;text-align:center;margin: 10px;'> UserName already Exist </p>";
	}else{
		$sql1 = "INSERT INTO userslist (CompID, first_name, last_name, username, password, Status)
		VALUES('{$CompID}','{$FName}','{$LName}','{$user}','{$password}','{$Status}')";
	if(mysqli_query($conn, $sql1)){
		?>
		
		<META HTTP-EQUIV="refresh" CONTENT="0; url=http://localhost/Salwa.sys/scm/scm_users_list.php">
		
		<?php
	}
	
	}
}

?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> Add User </title>
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
			  <button type="button" class="Dynamic-Option-Btn"> <a href="scm_users_list.php"> Users List </a> </button>
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="Form-box">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off"> <br>
                      <div class="form-group">
                          <label>Company ID</label>
                          <input type="text" name="CompID" class="form-control" placeholder="Company ID" required>
                      </div>
					  
					  <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
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