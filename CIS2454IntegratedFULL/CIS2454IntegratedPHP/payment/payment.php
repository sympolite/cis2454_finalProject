<!DOCTYPE html>
<!--
Timothy Ian Anderson 
CIS 2454
Fall 2017 - Thurs. Afternoon
Integrated Project
-->
<?php require_once 'load_payment_info.php';?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reservation Payment</title>
        <!-- Just to help the table stand out more -->
        <style>
            table,th,td {
                border:1px solid black;
            }
        </style>
    </head>
    <body>        
        <h1>Reservation Payment</h1>
        <p>Customer name: <?php echo $name;?></p>
        
        <h3>Items selected:</h3>
        <table>
            <tr>
                <td>Item Code</td>
                <td>Type</td>
                <td>Description</td>
                <td>Travelers</td>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Cost</td>
            </tr>
            <?php if (is_array($items[0])) {
                    foreach ($items as $item) {
                        $travitem = select_from('travelitems', 'TRAVITEM_ID', '=', $item['RES_ITEMID']);
                ?>
            <tr>
                <td><?php echo $item['RES_ID'];?></td>
                <td><?php echo $travitem['TRAVITEM_TYPE'];?></td>
                <td><?php echo $travitem['TRAVITEM_DESC'];?></td>
                <td><?php echo $item['RES_TRAVELERS'];?></td>
                <td><?php echo $item['RES_STARTDATE'];?></td>
                <td><?php echo $item['RES_ENDDATE'];?></td>
                <td><?php echo $item['TRAVITEM_COST'];?></td>
            </tr>
                    <?php }} else {
                $travitem = select_from('travelitems', 'TRAVITEM_ID', '=', $items['RES_ITEMID']);
                ?>
            <tr>
                <td><?php echo $items['RES_ID'];?></td>
                <td><?php echo $travitem['TRAVITEM_TYPE'];?></td>
                <td><?php echo $travitem['TRAVITEM_DESC'];?></td>
                <td><?php echo $items['RES_TRAVELERS'];?></td>
                <td><?php echo $items['RES_STARTDATE'];?></td>
                <td><?php echo $items['RES_ENDDATE'];?></td>
                <td><?php echo $travitem['TRAVITEM_COST'];?></td>
            </tr>
            <?php } ?>
        </table>
        
        <h3>Total Due = <?php echo $total;?></h3>
        
        <form action ="process_payment.php" method="POST">
            Customer ID: <input type="text" name="customerID"></br>
            Payment: $<input type="text" name="payment"></br>
            Customer Account Number: <input type="text" name="customerAccount"></br>
            <input type="submit">
        </form>
        <?php include '../footer/footer.php';?>
    </body>
</html>
