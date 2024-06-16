<?php
require_once('vendor/autoload.php');
use Dompdf\Dompdf;

include ("config.php");

$bill_id = base64_decode($_GET['id']);
$bills = "SELECT * FROM bills b INNER JOIN companylist c ON b.comp_id = c.CompanyID  where id={$bill_id}";
$cparty = "SELECT * FROM bills b INNER JOIN companylist c ON b.cparty = c.CompanyID  where id={$bill_id}";

$bills_query = mysqli_query($conn, $bills);
$bills_query_data = mysqli_fetch_assoc($bills_query);

$cparty_query = mysqli_query($conn, $cparty);
$cparty_query_data = mysqli_fetch_assoc($cparty_query);
// print_r($bills_query_data); die;
$items_details_count = 1;
function numToWordsRec($number) {
    $words = array(
        0 => 'zero', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five',
        6 => 'six', 7 => 'seven', 8 => 'eight',
        9 => 'nine', 10 => 'ten', 11 => 'eleven',
        12 => 'twelve', 13 => 'thirteen', 
        14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty',
        90 => 'ninety'
    );

    if ($number < 20) {
        return $words[$number];
    }

    if ($number < 100) {
        return $words[10 * floor($number / 10)] .
               ' ' . $words[$number % 10];
    }

    if ($number < 1000) {
        return $words[floor($number / 100)] . ' hundred ' 
               . numToWordsRec($number % 100);
    }

    if ($number < 1000000) {
        return numToWordsRec(floor($number / 1000)) .
               ' thousand ' . numToWordsRec($number % 1000);
    }

    return numToWordsRec(floor($number / 1000000)) .
           ' million ' . numToWordsRec($number % 1000000);
}

$items_html = "";
$items_Details = "SELECT * FROM items_Details WHERE bill_id='$bill_id' ORDER BY id";
$items_details_query = mysqli_query($conn, $items_Details);

// Create an array to store tax options
while ($items_details_data = mysqli_fetch_assoc($items_details_query)) {
    $items_html .= '<tr>
       <td>'.$items_details_count.'</td>
       <td></td>
       <td>'.$items_details_data['item_name'].'</td>
       <td>'.$items_details_data['qty'].'</td>
       <td>'.$items_details_data['uom'].'</td>
       <td>'.$items_details_data['rate'].'</td>
       <td>'.$items_details_data['gst_rate'].'</td>
       <td>'.$items_details_data['gst_amount'].'</td>
       <td>'.$items_details_data['gst_amount'].'</td>
     </tr>';
}

$html = '<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Purchase Order</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
        color: #333;
        font-size: small;
        }
        
        table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
        border: 1px solid #dee2e6;
        }
        th, td {
        padding: 5px;
        text-align: left;
        }
        th {
        background-color: #007bff;
        color: white;
        }
        tbody tr:nth-child(odd) {
        background-color: #f8f9fa;
        }
        tbody tr:hover {
        background-color: #e9ecef;
        }
        p {
        max-width: 800px;
        margin: 20px auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        ol {
        max-width: 800px;
        margin: 20px auto;
        background: white;
        padding: 5px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        list-style: decimal inside;
        }
        ol li {
        /* margin: 10px 0; */
        font-size:x-small
        }
    </style>
    </head>
    <body>
        <table>
            <thead>
            <tr>
                <th>'.$bills_query_data['CompanyName'].'</th>
                <td></td>
            </tr></thead>
            </thead>
            <tbody>
                <tr>
                    <td  width="300px" > '.$bills_query_data['CompanyAddress'].'</td>
                    <td style="padding: 0px 0px 0px 100px;"> PO No. : '.$bills_query_data['bill_number'].'</td>
                </tr>
                <tr>
                    <td  width="300px" >  '.$bills_query_data['CompanyAddress'].'</td>
                    <td style="padding: 0px 0px 0px 100px;"> PO Date : '.$bills_query_data['bill_date'].'</td>
                </tr>
                <tr>
                    <td  width="300px" > Phone No : '.$bills_query_data['ContactNo'].'</td>
                    <td style="padding: 0px 0px 0px 100px;"> Payment Term :  </td>
                </tr>
                <tr>
                    <td  width="300px" > </td>
                    <td style="padding: 0px 0px 0px 100px;"> Delivery Date : '.$bills_query_data['bill_date'].' </td>
                </tr>
            
            </table>
        <h3 style=" text-align: center;">Purchase Order</h3>
        <table>
        <thead>
        <tr>
            <td>Vendor/Supplier Details</td>
            <td>Ship Details</td>
        </tr></thead>
        </thead>
        <tbody>
            <tr>
                <td>
                    '.$cparty_query_data['CompanyName'].'<br>
                    '.$cparty_query_data['CompanyAddress'].'
                    <br/>
                    GST Registration No: '.$cparty_query_data['GSTNo'].'<br>
                    Contract No.: '.$cparty_query_data['ContactNo'].'
            </td>
            <td>
            '.$cparty_query_data['CompanyName'].'<br>
            '.$cparty_query_data['CompanyAddress'].'
            <br/>
            GST Registration No: '.$cparty_query_data['GSTNo'].'<br>
            Contract No.: '.$cparty_query_data['ContactNo'].'
            </td>
            </tr>
        </table>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>HSN Code</th>
            <th>Name</th>
            <th>Qty</th>
            <th>UOM</th>
            <th>Unit Price</th>
            <th>GST %</th>
            <th>GST Amount</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        '.$items_html.'
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="4" style="text-align: right;"> Total</td>
            <td>'.$bills_query_data['total_amount'].' </td>
                
        </tr>
        <tr>
            <td colspan="8" style="text-align: right;"> CGST Amount:</td>
            <td>'.$bills_query_data['cgsttotal'].'</td>
        </tr>
        <tr>
            <td colspan="8" style="text-align: right;"> SGST Amount:</td>
            <td>'.$bills_query_data['sgsttotal'].'</td>
        </tr>
        <tr>
            <td colspan="8" style="text-align: right;"> Grand Total:</td>
            <td>'.$bills_query_data['gtotal'].'</td>
        </tr>
        <tr>
            <td colspan="9" > Amount in words: <strong>Rupees '.numToWordsRec(123546).'</strong></td>
        </tr>

        </tbody>
    </table>
    
    <h4>Terms & Condition</h4>
    <ol>
        <li>Copy of the PO must be attached with the final invoice.</li>
        <li>Packing List must be attached with the final invoice.</li>
        <li>All article supplied in this PO must be packed adequately to prevent any damage in shipment and storage.</li>
        <li>All packages must be properly identified.</li>
        <li>All Product should have 70% of the shelf life at the time of delivery.</li>
        <li>You have to send the delivery with the same invoice without any correction/rectification or anything written by hand.</li>
        <li>This is a system generated document, hence no signature required.</li>
        <li><strong>Note:</strong> Delivery timing will be only from 10:00 am to 4:00 pm only.</li>
        <li>Please take prior appointment 24hr in advance to avoid delay in receiving.</li>
        <li>Payment terms will be considered from the day of delivery, irrespective of the invoice date.</li>
    </ol>
    </body>
    </html>';

$dompdf = new Dompdf();

// echo 'testing html'.$html; die();
// $html = file_get_contents('src\pdfs\invoice.html');
header("Content-type: application/pdf");
$dompdf->loadHtml($html);
$dompdf->render();
echo $dompdf->output();

?>
