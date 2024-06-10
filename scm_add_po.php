<?php 
include "scm_header.php"; 

if($_SESSION["Status"] == '0'){
    header("Location: {$hostname}/scm/In-Active.php");
}

include ("config.php");

$query = "SELECT * FROM itemslist ORDER BY Item_ID";
$ItemList = mysqli_query($conn, $query);

$items = [];
while ($row = mysqli_fetch_assoc($ItemList)) {
    $items[] = [
		'name' => $row['Display_Item'] ?? "",
        'unit' => $row['Default_Unit'] ?? "",
        'rate' => $row['Avg_Rate'] ?? "",
        'tax' => $row['Tax'] ?? "",
        'amount' => $row['Amount'] ?? "",
        'item_type' => $row['Item_Type'] ?? "",
        'item_ops' => $row['Item_Ops'] ?? ""
    ];
}
$items_json = json_encode($items);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title> Add Recipe </title>
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
    <form method="POST" action="index.php">
        <table>
            <tr>
                <td>Pre-defined Templates Name :</td>
                <td>
                    <select name='RecipeName' placeholder='Enter Item name' id=''>
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
                    <select name='RecipeName' placeholder='Enter Item name' required id=''>
                        <option Select hidden> </option>
                        <option> Test Site Name </option>
                    </select>
                </td>
                <td>. __________Select Supplier Name :</td>
                <td>
                    <select name='RecipeName' placeholder='Enter Item name' required id=''>
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
                    Delivery Charges : <input type="No" name="delcharges" value="0" placeholder="Delivery Charges" /> <br>
                    Others Charges : <input type="No" name="othercharges" value="0" placeholder="Others Charges" />
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
            html += "<td width='100px' class='EnterQty'><input type='number' name='itemQuantity[]' class='calculate'></td>";
            html += "<td width='115px' class='EnterQty'><input type='text' name='itemUnit[]' class='autocomplete item-unit'></td>";
            html += "<td width='100px' class='EnterQty'><input type='number' name='itemRate[]' class='autocomplete item-rate calculate'></td>";
			html += "<td width='115px' class='EnterQty'><div class='tax-wrapper'><input type='number' name='itemTax[]' class='autocomplete item-tax calculate'></div></td>";
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
                    $(this).closest('tr').find('.item-tax').val(selectedItem.tax);
                    $(this).closest('tr').find('.item-amount').val(selectedItem.amount);
                    $(this).closest('tr').find('.item-type').val(selectedItem.item_type);
                    $(this).closest('tr').find('.item-ops').val(selectedItem.item_ops);
                }
            }
        });

        $(".calculate").on('input', function() {
            calculateAmount($(this).closest('tr'));
        });
    }

    function deleteRow(button) {
        items--;
        button.parentElement.parentElement.remove();
    }

    function calculateAmount(row) {
        var qty = parseFloat(row.find("input[name='itemQuantity[]']").val()) || 0;
        var rate = parseFloat(row.find("input[name='itemRate[]']").val()) || 0;
        var tax = parseFloat(row.find("input[name='itemTax[]']").val()) || 0;

        var amount = qty * rate * (1 + tax / 100);
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
                    $(this).closest('tr').find('.item-tax').val(selectedItem.tax);
                    $(this).closest('tr').find('.item-amount').val(selectedItem.amount);
                    $(this).closest('tr').find('.item-type').val(selectedItem.item_type);
                    $(this).closest('tr').find('.item-ops').val(selectedItem.item_ops);
                }
            }
        });

        $(".calculate").on('input', function() {
            calculateAmount($(this).closest('tr'));
        });
    });
</script>

</body>
</html