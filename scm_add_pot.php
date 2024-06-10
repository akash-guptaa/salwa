
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> SCM Trans </title>
		
		
	</head>
	
	<style>
	table {
		border-collapse: collapse;
		}
	
	.Table-Info{
		background-color:#49c1a2;
		color:#fff;
		height:50px;
		width: 880px;
		border-radius:5px;
		border: 0;
		outline: 0;
		cursor: pointer;
		font-size: 17px;
		margin: 0 0px;
		}
		
	</style>


<body>
<div class="Dynamic-Area">
<h1 class="admin-heading">New Purchase Order Entry Form
<button type="button" class="Dynamic-Option-Btn"> <a href="scm_po_register.php"> Purchase Orders Register </a> </button> </h1>

<br><br>

<center>
<form method="POST" action="#">
	<table>
		<tr>  
			<td>Pre-defined Templates Name :</td>
			<td><select name='RecipeName' placeholder='Enter Item name' id=''>
			<option Select hidden> </option>
			<option> Green Nature Supplier </option>
			</select></td>
		</tr>
	</table>
<br><br>	
	<table>
		<tr>  
			<td>Select Site Name : </td>
			<td><select name='RecipeName' placeholder='Enter Item name' required id=''>
			<option Select hidden> </option>
			<option> Test Site Name </option>
			</select></td>
			
			<td>__________________Select Supplier Name :</td>
			<td><select name='RecipeName' placeholder='Enter Item name' required id=''>
			<option Select hidden> </option>
			<option> Test Supplier Name </option>
			</select></td>
			
		</tr>
		
	</table>
	
	<br>
	<table>
		<tr>
			<td>
				Delivery Date : <input type="date" name="ddate" value="" placeholder="Select Date" required />
				Delivery Time : <input type="time" name="dtime" value="Any" placeholder="Reference" />
								
			</td>
		</tr>
	</table>
	
<br><br><br>
    <table border="1" class="Table-Info">
        <tr>
            <th width='30px' value="1++">	#	</th>
			<th width='350px'>	Item Name		</th>
			<th width='40px'>	Qty				</th>
			<th width='45px'>	Unit			</th>
			<th width='45px'>	Rate			</th>
			<th width='75px'>	Tax				</th>
			<th width='95px'>	Amount			</th>
			<th width='99px'>	Item-Type		</th>
			<th width='100px'>	In-Stock		</th>
			<th width='75px'><button type="button" onclick="addItem();">Add Item</button></th>
        </tr>
        <tbody id="tbody"></tbody>
    </table>
 <br><br><br>
    	
    <input class="SubnBtn" type="submit" name="addInvoice" value="Save">
	
</form>
</center>



<div class="AdminHomeDynamicinfo" align="center">

</div>


</div> 
</body>
</html>

<script>
    var items = 0;
    function addItem() {
        items++;
 
        var html = "<tr>";
            html += "<td width='20px' class='EntryField'>" + items + "</td>";
            html += "<td width='400px' class='EntryField'><input type='text' name='itemName[]'> 						</td>";
            html += "<td width='50px' class='EntryField'><input type='number' name='itemQuantity[]'>					</td>";
			html += "<td width='50px' class='EntryField'><input type='text' value='Gram' name='itemUnit[]'>			</td>";
			html += "<td width='50px' class='EntryField'><input type='number' value='0.1' name='itemRate[]'>			</td>";
			html += "<td width='50px' class='EntryField'><input type='text' value='100' name='itemYield[]'>			</td>";
			html += "<td width='50px' class='EntryField'><input type='number' value='1' name='itemAmount[]'>			</td>";
			html += "<td width='135px' class='EntryField'><input type='text' value='NA' name='itemType[]'>			</td>";
			html += "<td width='125px' class='EntryField'><input type='text' value='NA' name='itemMode[]'>			</td>";
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