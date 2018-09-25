<!DOCTYPE html>
<!--
    Timothy Ian Anderson 
    CIS 2454
    Fall 2017 - Thurs. Afternoon
    Integrated Project
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Payment Results</title>
    </head>
    <body>
        <?php
            require_once('process_payment.php'); 
       ?>
        <h1>Payment Results</h1>
        <h3>Thank you for your payment!</h3>
        <p>Payment Amount: <?php echo $payment;?></p>
        <p>Customer ID: <?php echo $customer;?></p>
        <?php include '../footer/footer.php';?>
    </body>
</html>
