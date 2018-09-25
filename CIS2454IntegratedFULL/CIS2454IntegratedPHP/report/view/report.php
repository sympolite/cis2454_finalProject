<?php
include_once '../model/PurchasedItem.php';
#require('../../globaldb/model/databaseConnect.php');
#require('../../globaldb/model/databaseQueries.php');
require_once '../controller/load_report.php';
?>

<html>
    <head>
        <title>CE4</title>
        <style>
            table, tr, td, th {
                border:1px black solid;
            }
        </style>
    </head>
    <body>
        <h1>Financial Report for <?php echo $custID?></h1>
        <h3>Purchases</h3>
        <table>
            <tr>
                <th>Item code</th>
                <th>Type</th>
                <th>Description</th>
                <th>Date</th>
                <th>Cost</th>
            </tr>
            <?php foreach ($p_items as $item) { ?>
            <tr>
                <td><?php echo $item->get_item_code();?></td>
                <td><?php echo $item->get_type();?></td>
                <td><?php echo $item->get_description();?></td>
                <td><?php echo $item->get_date();?></td>
                <td>$<?php echo $item->get_cost(); $total += floatval($item->get_cost());?></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan ="4">Total:</td>
                <td>$<?php echo number_format($total, 2);?></td>
            </tr>
        </table>
        <h3>Payments</h3>
        <?php 
            $ppayments = select_from('financialhistory', 'FIN_TRANSACTIONAMNT', '<', 0.00);
            $payments = [];
            foreach ($ppayments as $pmnt) {
                if ($pmnt['FIN_CUSTID'] === $custID && $pmnt['FIN_TRANSACTIONAMNT'] < 0) {
                    $payments[] = $pmnt;
                }
            }
            $totalpayments = 0.00;
            #select from financialhistory where amount less than 0
            #since a payment is taking away from your balance
            ?>
        <table>
            <tr>
                <th>Date</th>
                <th>Amount</th>
            </tr>
            <?php foreach ($payments as $payment) {?>
            <tr>
                <td><?php echo $payment['FIN_DATE'];?></td>
                <td>$<?php echo number_format(-$payment['FIN_TRANSACTIONAMNT'], 2);?>
            </tr>
            <?php $totalpayments += $payment['FIN_TRANSACTIONAMNT'];}?>
            <tr>
                <td>Balance due:</td>
                <td>$<?php $total += ($totalpayments); echo number_format($total, 2);?></td>
            </tr>
        </table>
        <?php include '../../footer/footer.php';?>
    </body>
</html>

