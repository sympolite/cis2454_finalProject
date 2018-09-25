<!DOCTYPE html>
<!--
Timothy Ian Anderson 
CIS 2454
Fall 2017 - Thurs. Afternoon
Integrated Project
-->
<?php require_once 'process_payment.php'?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <p>Currently, you do NOT have enough funds to complete this payment.</p>
        <p><b>Current balance:</b> $<?php echo $balance ?></p>
        <p><b>Attempted payment amount:</b> $<?php echo $payment ?></p>
    </body>
    <?php include '../footer/footer.php';?>
</html>

