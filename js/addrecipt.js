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
		const delcharges = parseFloat($("input[name='delcharges']").val())
		const othercharges = parseFloat($("input[name='othercharges']").val())

        $("input[name='itemAmount[]']").each(function() {
            total += parseFloat($(this).val()) || 0;
        });

        $("select[name='itemTax[]']").each(function() {
            totalTax += parseFloat($(this).val()) || 0;
        });

        var grandTotal = total + (total * totalTax / 100) + delcharges + othercharges ;

        $("#total").text(total.toFixed(2));
        $("#totalTax").text(totalTax.toFixed(2));
        $("#grandTotal").text(grandTotal.toFixed(2));
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
