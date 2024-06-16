<?php 

include "scm_header.php";
include ("config.php");

if($_SESSION["Status"] == '0'){
	header("Location: {$hostname}/scm/In-Active.php");
}

$bills = "SELECT * FROM bills b INNER JOIN companylist c ON b.comp_id = c.CompanyID where  bill_type='purchase_orders' ORDER BY id";
$bills_query = mysqli_query($conn, $bills);

if (isset($_GET["addDraft"]))
    {
		// echo "<pre><center>" ;print_r($_GET); die();
		$user_name = $_SESSION["username"];
		$customer_id = $_GET['SiteName'] ?? '';
		$today = date('Y-m-d');
		$due_date = $_GET["ddate"]." ".$_GET["dtime"];
		$grandTotal = $_GET['grandTotal'];
		
		$sql = "INSERT INTO `bills` (`id`, `comp_id`, `bill_type`, `customer_id`, `bill_date`, `due_date`, `total_amount`,`cparty`) VALUES (NULL, '{$CompID}','purchase_orders', '{$user_name}', '{$today}','{$due_date}', '{$grandTotal}','{$CompID}')";

        mysqli_query($conn, $sql);
        $bill_id = mysqli_insert_id($conn);
		// mysqli_close($conn);
		// echo "<pre><center>" ;print_r($_GET); die();
		$bill_number = date('Y').'/'.$bill_id;

		$update_bills_sql = "UPDATE bills
		SET bill_number = $bill_number
		WHERE id = $bill_id";
		mysqli_query($conn, $update_bills_sql);
 		$itemsid = [];

        for ($a = 0; $a < count(@$_GET["itemName"] ?? []); $a++)
        {
			$ddate = $_GET['ddate'] ?? NULL;
			$dtime = $_GET['dtime'] ?? NULL;
			$SiteName = $_GET['SiteName'] ?? NULL;
			$SupplierName = $_GET['SupplierName'] ?? NULL;
			$itemName = $_GET['itemName'][$a] ?? NULL;
			$itemQuantity = $_GET['itemQuantity'][$a] ?? 0;
			$itemUnit = $_GET['itemUnit'][$a] ?? 0;
			$itemRate = $_GET['itemRate'][$a] ?? 0;
			$itemTax = $_GET['itemTax'][$a] ?? 0;
			$itemAmount = $_GET['itemAmount'][$a] ?? 0;
			$CESS = $_GET['CESS'] ?? 0;
			$delcharges = $_GET['delcharges'] ?? 0;
			$gst_delivery_charge = $_GET['gst_delivery_charge'] ?? 0;
			$othercharges = $_GET['othercharges'] ?? 0;
			$gst_on_other_amount = $_GET['gst_on_other_amount'] ?? 0;
			$itemType = $_GET['itemType[]'][$a] ?? "";
			$itemMode = $_GET['itemMode[]'][$a] ?? "";
		
            $itemsql = "INSERT INTO items_Details (
				bill_id,
				po_date,
				delivery_date,
				delivery_time,
				site_name,
				supplier_name,
				item_name,
				qty,
				uom,
				rate,
				gst_rate,
				gst_amount,
				cess_amount,
				delivery_charges,
				gst_delivery_charge,
				others_amount,
				gst_on_other_amount,
				item_type,
				item_ops,
				username
			  )
			  VALUES (
				'{$bill_id}',
				'{$today}',
				'{$ddate}',
				'{$dtime}',
				'{$SiteName}',
				'{$SupplierName}',
				'{$itemName}',
				'{$itemQuantity}',
				'{$itemUnit}',
				'{$itemRate}',
				'{$itemTax}',
				'{$itemAmount}',
				'{$CESS}',
				'{$delcharges}',
				'{$gst_delivery_charge}',
				'{$othercharges}',
				'{$gst_on_other_amount}',
				'{$itemType}',
				'{$itemMode}',
				'{$user_name}'
			  )";		
			
            mysqli_query($conn,$itemsql);
			$itemsid[] = mysqli_insert_id($conn);
        }
		// print_r($bill_number);
        echo "<p>Invoice has been added.</p>";
    }


  
?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale-1.0"/>
		<title> SCM Trans </title>
		<link rel="stylesheet" type="text/css" href="css/scm_active_stylesheet.css"/>
		
	</head>
	
	<style>
	table {
		border-collapse: collapse;
		}
		.Admin-User-Table td {
		padding:10px;
			
		}
	
	.ActiveCompany {
		width:270px;
		height:60px;
	}
	
	.Table-Info {
		background-color:#49c1a2;
		color:#fff;
		height:50px;
		width: 240px;
		border-radius:10px;
		border: 0;
		outline: 0;
		cursor: pointer;
		font-size: 17px;
		margin: 0 10px;
		}
		
	.AdminHomeDynamicinfo{
		display: flex;
		justify-content: center;
		padding: 20px;
		
		}
		
	</style>


<body>
<div class="Dynamic-Area">
<h1 class="admin-heading">Purchase Orders Register
<button type="button" class="Dynamic-Option-Btn"> <a href="scm_add_po.php"> Add PO </a> </button>

</h1>


<div class="AdminHomeDynamicinfo" align="center">
<table border="1">
            <tr>
                <th width='30px' >#</th>
                <th width='350px'>Bill Number</th>
                <th width='100px'>Amount</th>
                <th width='135px'>Action</th>
            </tr>
				<tbody id="tbody">  
				<?php while($bills_data = mysqli_fetch_array($bills_query)):; ?>
							<tr>
								<td><?php echo $bills_data['id']; ?></td>
								<td><?php echo $bills_data['bill_number']; ?></td>
								<td><?php echo $bills_data['total_amount']; ?></td>
								<td>
								<a href="hasGeneratePdf.php?id=<?php echo base64_encode($bills_data['id']); ?>" class="User-sub-menu-link1" target="_blank" > 
									<img src="Menu-icon/help.png" />
									<p> PDF </p>
								</a></td>
								</tr>
				<?php endwhile; ?>
				</tbody>
        </table>
</div>

</div> 
</body>
</html>