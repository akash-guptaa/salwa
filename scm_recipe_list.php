<?php 

include "scm_header.php";

if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}

?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> All Recipe </title>
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
				  <button type="button" class="Dynamic-Option-Btn"> <a href="add_recipe.php"> Add Recipe </a> </button>
              </div>
              <div class="">
			  
			  <?php
				include("config.php");
				
				$sql = "SELECT * FROM recipelist WHERE CompId='$CompID' ORDER BY Recipe_ID";
				$result = mysqli_query($conn, $sql) or die ("Query Failed");
				if(mysqli_num_rows($result) > 0){
				
			  ?>
			  <center>
			  <h1 class="admin-heading">All Recipe List</h1>
			  <br>
                  <table class="Admin-User-Table" border="1">
                      <thead>
						  <th>Id</th>
                          <th>Item Name</th>
						  <th>Batch_Qty </th>
                          <th>Batch_Unit </th>
                          <th>Total_Cost </th>
						  <th>Per Unit Cost</th>
						  <th>Sales_Price</th>
						  <th>Food_Cost</th>
						  <th>Staus</th>
                          <th>Edit</th>
                          <th>Delete</th>
						  
                      </thead>
                      <tbody>
					  <?php while($row = mysqli_fetch_assoc($result)) { ?>
                          <tr>
                              <td class='id'> <?php echo $row['Recipe_ID']; ?> </td>
							  <td> <?php echo $row['Recipe_Name']; ?> </td>
                              <td> <?php echo $row['Batch_Qty']; ?> </td>
                              <td> <?php echo $row['Batch_Unit']; ?> </td>
							  <td> <?php echo $row['Total_Cost']; ?> </td>
							  <td> <?php echo $row['Per_Unit_Cost']; ?> </td>
							  <td> <?php echo $row['Sale_Price']; ?> </td>
							  <td> <?php echo $row['Food_Cost']; ?> </td>
                              <td> <?php 
							  
								if($row['Status'] == 1){
									echo "Active";
								}else{
									echo "In-Active";
								}
								
							  ?> </td>
							  <td> <a href='update-item.php?id=<?php echo $row["Recipe_ID"] ?>'> <button type="button" class="Table-Edit"> Edit </button> </a> </td>
							  <td> <a href='delete-item.php?id=<?php echo $row["Recipe_ID"] ?>'> <button type="button" class="Table-Del"> Delete </button> </a> </td>
							  
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