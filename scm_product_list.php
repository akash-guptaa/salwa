<?php 

include "scm_header.php";

if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}

?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> All Items </title>
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
<div class="Dynamic-Area">
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  
              </div>
              <div class="">
				  <button type="button" class="Dynamic-Option-Btn"> <a href="add-item.php"> Add Item </a> </button>
              </div>
              <div class="">
			  
			  <?php
				include("config.php");
				
				$sql = "SELECT * FROM itemslist WHERE COMPID='$CompID' ORDER BY Item_ID";
				$result = mysqli_query($conn, $sql) or die ("Query Failed");
				if(mysqli_num_rows($result) > 0){
				
			  ?>
			  <center>
			  <h1 class="admin-heading">Item Master List</h1>
			  <br>
                  <table class="Admin-User-Table" border="1">
                      <thead>
						  <th>Item Id</th>
                          <th>Item Name</th>
                          <th>Default Unit </th>
                          <th>Avg Rate </th>
						  <th>Item Category</th>
						  <th>Item Type</th>
						  <th>Item Mode</th>
						  <th>Item Number</th>
                          <th>Status</th>
                          <th>Edit</th>
                          <th>Delete</th>
						  
                      </thead>
                      <tbody>
					  <?php while($row = mysqli_fetch_assoc($result)) { ?>
                          <tr>
                              <td class='id'> <?php echo $row['Item_ID']; ?> </td>
							  <td> <?php echo $row['Item_Name']; ?> </td>
                              <td> <?php echo $row['Default_Unit']; ?> </td>
                              <td> <?php echo $row['Avg_Rate']; ?> </td>
							  <td> <?php echo $row['Item_Category']; ?> </td>
							  <td> <?php echo $row['Item_Type']; ?> </td>
							  <td> <?php echo $row['Item_Mode']; ?> </td>
							  <td> <?php echo $row['Alter_ItemCode']; ?> </td>
                              <td> <?php 
							  
								if($row['Status'] == 1){
									echo "Active";
								}else{
									echo "In-Active";
								}
								
							  ?> </td>
							  <td> <a href='update-item.php?id=<?php echo $row["Item_ID"] ?>'> <button type="button" class="Table-Edit"> Edit </button> </a> </td>
							  <td> <a href='delete-item.php?id=<?php echo $row["Item_ID"] ?>'> <button type="button" class="Table-Del"> Delete </button> </a> </td>
							  
                          </tr>
						  
                         <?php } ?>
                      </tbody>
				</table> <?php } ?>
				</center>
  
              </div>
          </div>
      </div>
  </div>
  
</div>
</body>
</html>