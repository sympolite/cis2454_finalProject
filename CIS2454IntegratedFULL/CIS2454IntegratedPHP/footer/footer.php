<?php $url = 'localhost:8080/CIS2454_IntegratedJava/NavigationServlet?viaPHP=true&action=';
echo '<hr /><a href ="' . $url . 'reserve">Search for reservations</a> -' .
'<a href ="../../payment/load_payment_info.php">Make a payment</a> - 
<a href="' . $url . 'review">Review confirmed reservations</a> - 
<a href="'.  $url . 'status">Review rewards status</a> - 
<a href="../../report/controller/load_report.php">View financial history</a>';

