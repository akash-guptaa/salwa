<?php 

include ("scm_header.php"); 


if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}


if(isset($_POST['submit'])){
	include ("config.php");
	
	$UserId = mysqli_real_escape_string($conn,$_POST['user_id']);
	$CompID = mysqli_real_escape_string($conn,$_POST['CompID']);
	$FName = mysqli_real_escape_string($conn,$_POST['f_name']);
	$LName = mysqli_real_escape_string($conn,$_POST['l_name']);
	$user = mysqli_real_escape_string($conn,$_POST['username']);
	$password = mysqli_real_escape_string($conn,md5($_POST['password']));
	$Status = mysqli_real_escape_string($conn,$_POST['Status']);
	
	$sql = "UPDATE userslist SET CompID = '{$CompID}', first_name = '{$FName}', last_name = '{$LName}', username = '{$user}', password = '{$password}', Status = '{$Status}' WHERE user_id = {$UserId}";
	
	if(mysqli_query($conn, $sql)){
		?>
		
		<META HTTP-EQUIV="refresh" CONTENT="0; url=http://localhost/Salwa.sys/scm/scm_users_list.php">
		
		<?php
		
		}
	
	}


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
			  <button type="button" class="Dynamic-Option-Btn"> <a href="scm_users_list.php"> Users List </a> </button>
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="Form-box">
			  <?php 
				include ("config.php");
				$userID = $_GET['id'];
				$sql1 = "SELECT * FROM userslist WHERE user_id = {$userID}";
				$result = mysqli_query($conn, $sql1) or die ("Query Failed");
				if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)){
				
			  ?>
	<br>	<br>	  
<center>			  
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="" >
                      </div>
					  <div class="form-group">
                          <label>Company ID</label>
                          <input type="text" name="CompID" class="form-control" value="<?php echo $row['CompID']; ?>" placeholder="Company ID" required>
                      </div>
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                      </div>
					  
					  <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" value="<?php  ?>" placeholder="" required>
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
                  </form> <center/>
                  <!-- /Form -->
				  <?php 
					}
				}
				  ?>
              </div>
          </div>
      </div>
  </div>
