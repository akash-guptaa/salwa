<?php 

include "scm_header.php";

if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}

?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> User Roles </title>
		<link rel="stylesheet" type="text/css" href="css/scm_active_stylesheet.css"/>
		
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

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  
              </div>
              <div class="">
				  <button type="button" class="Dynamic-Option-Btn"> <a href="add-userrole.php"> Add User Role </a> </button>
              </div>
              <div class="">
			  
			  <?php
				include("config.php");
				
				$sql = "SELECT * FROM userrolename WHERE COMPANYID='$CompID' ORDER BY UserRole_id";
				$result = mysqli_query($conn, $sql) or die ("Query Failed");
				if(mysqli_num_rows($result) > 0){
				
			  ?>
			  <center>
			  <h1 class="admin-heading">User Roles List</h1>
			  <br>
                  <table class="Admin-User-Table" border="1">
                      <thead>
						  <th>Comp Id</th>
                          <th>User Role Id</th>
                          <th>Role/ Profile Name</th>
                          <th>Status</th>
                          <th>Edit</th>
                          <th>Delete</th>
						  
                      </thead>
                      <tbody>
					  <?php while($row = mysqli_fetch_assoc($result)) { ?>
                          <tr>
							<td> <?php echo $row['CompanyID']; ?> </td>
                            <td class='id'> <?php echo $row['UserRole_id']; ?> </td>
                              <td> <?php echo $row['UserRole_Name']; ?> </td>
                              <td> <?php 
							  
								if($row['Status'] == 1){
									echo "Active";
								}else{
									echo "In-Active";
								}
								
							  ?> </td>
							  <td> <a href='update-userrole.php?id=<?php echo $row["UserRole_id"] ?>'> <button type="button" class="Table-Edit"> Edit </button> </a> </td>
							  <td> <a href='delete-userrole.php?id=<?php echo $row["UserRole_id"] ?>'> <button type="button" class="Table-Del"> Delete </button> </a> </td>
							  
                          </tr>
						  
                         <?php } ?>
                      </tbody>
				</table> <?php } ?>
				</center>
  
              </div>
          </div>
      </div>
  </div>
  
 
</body>
</html>