<?php 

include "scm_header.php"; 

if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}

include ("config.php");

$query = "SELECT Item_ID, Item_Name, CompID FROM itemslist WHERE COMPID='$CompID' ORDER BY Item_ID";
$ItemList = mysqli_query($conn, $query);


?>



<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> Add Recipe </title>
		
		
	</head>
	
	<style type="text/css">
    table {
		border-collapse: collapse;
	}
	
	.EnterQty input {
			width: 100%;
			height: 30px;
		}
		
	.OtherQty input {
			width: 100%;
			height: 30px;
		}
	.EnterItem input {
			width: 100%;
			height: 30px;
		}	
</style>
	
<Body>

<div class="Dynamic-Area">
	
<center>
<form method="POST" action="index.php">
	<label> Select Recipe Costing Item Name</label>
	<select name='RecipeName' placeholder='Enter Item name' required id=''>
			<option Select hidden> </option>
			<?php while($row1 = mysqli_fetch_array($ItemList)):; ?>
			<option> <?php echo $row1[1]; ?> </option>
			<?php endwhile; ?>
	</select>
	
	<input type="date" name="date" value="" placeholder="Select Date" required />
	<input type="text" name="Reference" value="Any" placeholder="Reference" required /> <br><br>
	<input type="text" name="TotalCost" value="0" placeholder="Total Cost" required />
	<input type="text" name="PerUnitCost" value="0" placeholder="Per Unit Cost" required />
	<input type="text" name="FoodCost" value="0" placeholder="Food Cost" required />
<br><br><br>
    <table border="1">
        <tr>
            <th width='10px' value="1++">	Sr	</th>
			<th width='250px'>	Item Name		</th>
			<th width='10px'>	Qty				</th>
			<th width='15px'>	Unit			</th>
			<th width='15px'>	Rate			</th>
			<th width='15px'>	Yield%			</th>
			<th width='15px'>	Amount			</th>
			<th width='20px'>	Item-Type		</th>
			<th width='20px'>	Item-Mode		</th>
			 <th><button type="button" onclick="addItem();">Add Item</button></th>
        </tr>
        <tbody id="tbody"></tbody>
    </table>
 <br><br><br>
    	
    <input type="submit" name="addInvoice" value="Add Invoice">
	
</form>
</center>


</div>
</Body>
</html>

<?php
 
   
 
    if (isset($_POST["addInvoice"]))
    {
        $RecipeName = $_POST["RecipeName"];
 
        $sql = "INSERT INTO recipelist (Recipe_Name, Recipe_Entry, Ref) VALUES ('$RecipeName','$date','$Reference')";
        mysqli_query($conn, $sql);
        $RecipeId = mysqli_insert_id($conn);
 
        for ($a = 0; $a < count($_POST["itemName"]); $a++)
        {
            $sql = "INSERT INTO itemrecipe (Recipe_ID, CompanyID, itemName, itemQuantity) VALUES ('$RecipeId','" . $_POST["itemName"][$a] . "', '" . $_POST["itemQuantity"][$a] . "')";
            mysqli_query($conn, $sql);
        }
 
        echo "<p>Invoice has been added.</p>";
    }
 
?>

<script>
    var items = 0;
    function addItem() {
        items++;
 
        var html = "<tr>";
            html += "<td width='20px' class='EnterQty'>" + items + "</td>";
            html += "<td width='300px' class='EnterItem'><input type='text' name='itemName[]'> 						</td>";
            html += "<td width='50px' class='EnterQty'><input type='number' name='itemQuantity[]'>					</td>";
			html += "<td width='50px' class='EnterQty'><input type='text' value='Gram' name='itemUnit[]'>			</td>";
			html += "<td width='50px' class='EnterQty'><input type='number' value='0.1' name='itemRate[]'>			</td>";
			html += "<td width='50px' class='EnterQty'><input type='text' value='100' name='itemYield[]'>			</td>";
			html += "<td width='50px' class='EnterQty'><input type='number' value='1' name='itemAmount[]'>			</td>";
			html += "<td width='135px' class='EnterQty'><input type='text' value='NA' name='itemType[]'>			</td>";
			html += "<td width='125px' class='EnterQty'><input type='text' value='NA' name='itemMode[]'>			</td>";
            html += "<td><button type='button' onclick='deleteRow(this);'>Delete</button>							</td>"
        html += "</tr>";
 
        var row = document.getElementById("tbody").insertRow();
        row.innerHTML = html;
    }
 
function deleteRow(button) {
    items--
    button.parentElement.parentElement.remove();
    // first parentElement will be td and second will be tr.
}
</script>