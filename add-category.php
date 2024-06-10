<?php 

include "scm_header.php"; 

if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}


if(isset($_POST['save'])){
	include ("config.php");
	
	$CategoryName = mysqli_real_escape_string($conn,$_POST['CategoryName']);
	$DisplayCategory = mysqli_real_escape_string($conn,$_POST['DisplayCategory']);
	$SubCategory = mysqli_real_escape_string($conn,$_POST['SubCategory']);
	$CategoryType = mysqli_real_escape_string($conn,$_POST['CategoryType']);
	$CategoryMode = mysqli_real_escape_string($conn,$_POST['CategoryMode']);
	$Others = mysqli_real_escape_string($conn,$_POST['Others']);
	$Status = mysqli_real_escape_string($conn,$_POST['Status']);
	
	$sql = "SELECT Category_Name FROM categorylist WHERE Category_Name = '{$CategoryName}'";
	$result = mysqli_query($conn, $sql) or die("Quey Failed");
	
	if(mysqli_num_rows($result) > 0){
		echo "<p style='color:red;text-align:center;margin: 10px;'> UserName already Exist </p>";
	}else{
		$sql1 = "INSERT INTO categorylist (CompanyID, Category_Name, Display_Category, Sub_Category, Category_Type, Category_Mode, Others, Status)
		VALUES('{$CompID}','{$CategoryName}','{$DisplayCategory}','{$SubCategory}','{$CategoryType}','{$CategoryMode}','{$Others}','{$Status}')";
	if(mysqli_query($conn, $sql1)){
		?>
		<META HTTP-EQUIV="refresh" CONTENT="0; url=http://localhost/Salwa.sys/scm/scm_category_list.php">
		<?php
	}
	
	}
}

?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> Add Category </title>
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
			  <button type="button" class="Dynamic-Option-Btn"> <a href="scm_category_list.php"> Category List </a> </button>
                  <h1 class="admin-heading">Add Category</h1>
              </div>
              <div class="Form-box">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off"> <br>
                      <div class="form-group">
                          <label></label>
                          <input type="hidden" name="" class="form-control" placeholder="Company ID" required>
                      </div>
					  
					  <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="CategoryName" class="form-control" placeholder="Category Name" required>
                      </div>
					  
					  <div class="form-group">
                          <label>Display Category </label>
                          <input type="text" name="DisplayCategory" class="form-control" placeholder="Display Category" required>
                      </div>
					  
                      <div class="form-group">
                          <label>Sub Category</label>
                          <input type="text" name="SubCategory" class="form-control" placeholder="Sub Category" required>
                      </div>
                      <div class="form-group">
                          <label>Category Type</label>
                           <select class="form-control" name="CategoryType" >
                              <option value="Foods"> Foods </option>
                              <option value="Non-Food"> Non-Food </option>
							  <option value="Other"> Other </option>
                          </select>
                      </div>
					  <div class="form-group">
                          <label>Category Mode</label>
                          <select class="form-control" name="CategoryMode" >
                              <option value="SCM"> SCM </option>
                              <option value="POS"> POS </option>
							  <option value="Other"> Other </option>
                          </select>
                      </div>
					  
					  <div class="form-group">
                          <label>Others</label>
                          <input type="text" name="Others" class="form-control" placeholder="Others" required>
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