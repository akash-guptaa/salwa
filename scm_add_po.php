<?php 
include "scm_header.php"; 

if($_SESSION["Status"] == '0'){
    header("Location: {$hostname}/scm/In-Active.php");
}

include ("config.php");

$query = "SELECT site_ID, site_Name, CompanyID FROM sitelist WHERE COMPANYID='$CompID' ORDER BY site_ID";
$SiteList = mysqli_query($conn, $query);

$query = "SELECT SupplierId, SupplierName, SupplierName FROM supplierlist WHERE CompID='$CompID' ORDER BY CompID";
$SuppliList = mysqli_query($conn, $query);

$query = "SELECT TaxId, TaxName, CompId FROM taxlist WHERE CompId='$CompID' ORDER BY TaxId";
$TaxList1 = mysqli_query($conn, $query);

$query = "SELECT TaxId, TaxName, CompId FROM taxlist WHERE CompId='$CompID' ORDER BY TaxId";
$TaxList2 = mysqli_query($conn, $query);

$query = "SELECT TaxId, TaxName, CompId FROM taxlist WHERE CompId='$CompID' ORDER BY TaxId";
$TaxList3 = mysqli_query($conn, $query);


$query = "SELECT * FROM itemslist WHERE COMPID='$CompID' ORDER BY Item_ID";
$ItemList = mysqli_query($conn, $query);

$items = [];
while ($row = mysqli_fetch_assoc($ItemList)) {
    $items[] = [
		'name' => $row['Display_Item'] ?? "",
        'unit' => $row['Default_Unit'] ?? "",
        'rate' => $row['Avg_Rate'] ?? "",
        'tax' => $row['Tax'] ?? "", // TODO : need to add default tax in item list
        'amount' => $row['Amount'] ?? "",
        'item_type' => $row['Item_Type'] ?? "",
        'item_ops' => $row['Item_Mode'] ?? ""
    ];
}
$items_json = json_encode($items);


$querys = "SELECT * FROM taxlist WHERE COMPID='$CompID' ORDER BY TaxPercen";
$taxListResult = mysqli_query($conn, $querys);

// Create an array to store tax options
$taxOptions = [];
while ($row = mysqli_fetch_assoc($taxListResult)) {
    $taxOptions[] = [
        'value' => $row['TaxPercen'],
        'description' => $row['TaxName']
    ];
}
$taxOptionsJSON = json_encode($taxOptions);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title> Add Recipe </title>
	<!-- TODO : Add all js and cdn file in local level -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

</head>

<style type="text/css">
    table {
        border-collapse: collapse;
    }

    .EnterQty input, .EnterItem input {
        width: 100%;
        height: 30px;
    }
        .tax-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .tax-wrapper input {
            padding-right: 20px;
            box-sizing: border-box;
        }

        .tax-wrapper::after {
            content: '%';
            position: absolute;
            right: 10px;
        }
    </style>
</style>

<body>

<div class="Dynamic-Area">
    <center>
    <form method="GET" action="scm_PO_Register.php">
        <table class="invoiceTable">
            <tr>
                <td>Pre-defined Templates Name :</td>
                <td>
                    <select name='TemplatesName' placeholder='Enter Item name' id=''>
                        <option Select hidden> </option>
                        <option> Green Nature Supplier </option>
                    </select>
                </td>
            </tr>
        </table>
        <br><br>
        <table>
            <tr>
                <td>Select Site Name : </td>
                <td>
                    <select name='SiteName' placeholder='Enter Item name' required id=''>
                        <option Select hidden> </option>
                        <option> Test Site Name </option>
                    </select>
                </td>
                <td>. __________Select Supplier Name :</td>
                <td>
                    <select name='SupplierName' placeholder='Enter Item name' required id=''>
                        <option Select hidden> </option>
                        <option> Test Supplier Name </option>
                    </select>
                </td>
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
        <table border="1">
            <tr>
                <th width='30px' value="1++">#</th>
                <th width='350px'>Item Name</th>
                <th width='100px'>Qty</th>
                <th width='115px'>Unit</th>
                <th width='100px'>Rate</th>
                <th width='115px'>Tax</th>
                <th width='100px'>Amount</th>
                <th width='135px'>Item-Type</th>
                <th width='135px'>Item-Ops</th>
                <th><button type="button" onclick="addItem();">Add Item</button></th>
            </tr>
            <tbody id="tbody"></tbody>
			
        </table>
        <br><br>
        <table>
		<tr>
			<td>
				CESS Amount : <input type="No" name="CESS" value="0" placeholder="CESS Amount" /> 
				Delivery Charges : <input type="No" name="delcharges" value="0" placeholder="Delivery Charges" /> 
				Others Charges : <input type="No" name="othercharges" value="0" placeholder="Others Charges" /> <br><br><br>
				Tax On CESS : <select class="form-control" name="ItemMode" id="SearchDropeDown2" >
							   <option Select hidden> </option>
                              <?php while($row1 = mysqli_fetch_array($TaxList1)):; ?>
							<option> <?php echo $row1[1]; ?> </option>
							<?php endwhile; ?>
							</select>
							
				Tax On Delivery : <select class="form-control" name="ItemMode" id="SearchDropeDown2" >
							   <option Select hidden> </option>
                              <?php while($row1 = mysqli_fetch_array($TaxList2)):; ?>
							<option> <?php echo $row1[1]; ?> </option>
							<?php endwhile; ?>
							</select>

				Tax On Others : <select class="form-control" name="ItemMode" id="SearchDropeDown2" >
							   <option Select hidden> </option>
                              <?php while($row1 = mysqli_fetch_array($TaxList3)):; ?>
							<option> <?php echo $row1[1]; ?> </option>
							<?php endwhile; ?>
							</select>
                            
                            <br/>
                            <!-- Total Amount :<input type="No" name="total" id="total" placeholder="Total" readOnly />
                            <br/>
                            Total Tax Amount :<input type="No" name="totalTax" id="totalTax" placeholder="Total Tax" readOnly />
                            <br/> -->
                            Total Amount :<input type="No" name="grandTotal" id="grandTotal" placeholder="Total Total" readOnly />
                </td>
		</tr>
	</table>
        <br><br><br>
        <input type="submit" name="addDraft" value="Save as Draft">
        <input type="submit" name="addPO" value="Request Approval">
    </form>
</center>
</div>

<script>
    var items = 0;
    var availableItems = <?php echo $items_json; ?>;

    function addItem() {
        items++;

	var html = "<tr>";
    html += "<td width='30px' class='EnterQty'>" + items + "</td>";
    html += "<td width='300px' class='EnterItem'><input type='text' name='itemName[]' class='EnterItemautocomplete item-name'></td>";
    html += "<td width='100px' class='EnterQty'><input type='number' name='itemQuantity[]' class='calculate item-qty' ></td>";
    html += "<td width='115px' class='EnterQty'><input type='text' name='itemUnit[]' class='autocomplete item-unit'></td>";
    html += "<td width='100px' class='EnterQty'><input type='number' step='0.1' name='itemRate[]' class='autocomplete item-rate calculate'></td>";
    html += "<td width='115px' class='EnterQty'><select name='itemTax[]' class='autocomplete item-tax calculate'>";
    // html += "<option value=''>Select Tax</option>";
    var taxOptions = <?php echo $taxOptionsJSON; ?>;
    taxOptions.forEach(function(option) {
        html += "<option value='" + option.value + "'>" + option.description + "</option>";
    });
    html += "</select></td>";
    html += "<td width='100px' class='EnterQty'><input type='number' name='itemAmount[]' class='item-amount' readonly></td>";
    html += "<td width='135px' class='EnterQty'><input type='text' name='itemType[]' class='autocomplete item-type'></td>";
    html += "<td width='135px' class='EnterQty'><input type='text' name='itemMode[]' class='autocomplete item-ops'></td>";
    html += "<td><button type='button' onclick='deleteRow(this);'>Delete</button></td>";
    html += "</tr>";	

        var row = document.getElementById("tbody").insertRow();
        row.innerHTML = html;

        $(".EnterItemautocomplete").autocomplete({
            source: function(request, response) {
                var results = $.ui.autocomplete.filter(availableItems.map(item => item.name), request.term);
                response(results.slice(0, 10));
            },
            select: function(event, ui) {
                var selectedItem = availableItems.find(item => item.name === ui.item.value);
                if (selectedItem) {
                    $(this).closest('tr').find('.item-unit').val(selectedItem.unit);
                    $(this).closest('tr').find('.item-rate').val(selectedItem.rate);
                    // $(this).closest('tr').find('.item-tax').val(selectedItem.tax);
                    //$(this).closest('tr').find('.item-qty').val(1);
                    $(this).closest('tr').find('.item-amount').val(selectedItem.amount);
                    $(this).closest('tr').find('.item-type').val(selectedItem.item_type);
                    $(this).closest('tr').find('.item-ops').val(selectedItem.item_ops);
                }
            }
        });

        $(".calculate").on('input', function() {
            calculateAmount($(this).closest('tr'));
			calculateTotal();
        });
    }

    function deleteRow(button) {
        items--;
        button.parentElement.parentElement.remove();
    }

	function calculateTotal() {
        var total = 0;
        var totalTax = 0;
		const delcharges = parseFloat($("input[name='delcharges']").val()) || 0
		const othercharges = parseFloat($("input[name='othercharges']").val()) || 0

        $("input[name='itemAmount[]']").each(function() {
            total += parseFloat($(this).val()) || 0;
        });

        $("select[name='itemTax[]']").each(function() {
            totalTax += parseFloat($(this).val()) || 0;
        });

        var grandTotal = total + (total * totalTax / 100) + delcharges + othercharges ;
        console.log('total',total,'totalTax',totalTax,'grandTotal',grandTotal);
        $("#total").val(total.toFixed(2));
        $("#totalTax").val(totalTax.toFixed(2));
        $("#grandTotal").val(grandTotal.toFixed(2));
    }
    function calculateAmount(row) {
        var qty = parseFloat(row.find("input[name='itemQuantity[]']").val()) || 0;
        var rate = parseFloat(row.find("input[name='itemRate[]']").val()) || 0;
        var tax = parseFloat(row.find("select[name='itemTax[]']").val()) || 0;

        var inamount = qty * rate;
		var taxAmount = inamount * (tax / 100)
		var amount = inamount + taxAmount
		console.log('inamount',inamount,'taxAmount',taxAmount,tax,'amount',amount);
        row.find("input[name='itemAmount[]']").val(amount.toFixed(2));
    }

    $(document).ready(function() {
        $(".EnterItemautocomplete").autocomplete({
            source: function(request, response) {
                var results = $.ui.autocomplete.filter(availableItems.map(item => item.name), request.term);
                response(results.slice(0, 10));
            },
            select: function(event, ui) {
                var selectedItem = availableItems.find(item => item.name === ui.item.value);
                if (selectedItem) {
                    $(this).closest('tr').find('.item-unit').val(selectedItem.unit);
                    $(this).closest('tr').find('.item-rate').val(selectedItem.rate);
                    // $(this).closest('tr').find('.item-tax').val(selectedItem.tax);
                    //$(this).closest('tr').find('.item-qty').val(1);
                    $(this).closest('tr').find('.item-amount').val(selectedItem.amount);
                    $(this).closest('tr').find('.item-type').val(selectedItem.item_type);
                    $(this).closest('tr').find('.item-ops').val(selectedItem.item_ops);
                }
            }
        });

        $(".calculate").on('input', function() {
            calculateAmount($(this).closest('tr'));
			calculateTotal();
        });
    });

document.getElementById('generatePDFButton').addEventListener('click', function() {
	var doc = new jsPDF();
  doc.autoTable({ html: '#invoiceTable' });
  doc.save('invoice.pdf');
});


</script>

</body>
</html
