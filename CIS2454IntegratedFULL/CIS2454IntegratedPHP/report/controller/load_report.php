<?php 
/*
 * Timothy Ian Anderson 
Timothy Ian Anderson 
CIS 2454
Fall 2017 - Thurs. Afternoon
Integrated Project
 * 
 */
include_once '../model/PurchasedItem.php';
#require('../../globaldb/model/databaseConnect.php');
#require('../../globaldb/model/databaseQueries.php');

/*
$items = [new PurchasedItem('I0004','Hotel','New York Carlton Hotel','03-29-17',500.00), 
    new PurchasedItem('I0007','Hotel','Chicago Plaza Hotel','03-27-17',400.00), 
    new PurchasedItem('I1302','Restaurant','The Brown Hat','03-27-17',87.60)];

$total = 0.00;
 * */
$custID = filter_input(INPUT_GET, 'custID');
$custo = select_from('customer', 'CUST_ID', '=', $custID);
$selected_items = select_from("financialhistory", "FIN_TRANSACTIONAMNT", ">", "0.00");
$f_items = [];
if ($selected_items['FIN_CUSTID'] == $custID) {
    $f_items[] = $selected_items;
}
$selected_items = null;
$p_items = [];
foreach ($f_items as $item) {
    $t_item = select_from('travelitems','ITEM_ID', '=', $item['FIN_ITEMID']);
    $p_items[] = new PurchasedItem(
            $item['FIN_ID'], 
            $item['FIN_CUSTID'], 
            $item['FIN_ITEMID'],
            $t_item['ITEM_TYPE'],
            $t_item['ITEM_DESC'],
            $item['FIN_DATE'],
            $item['FIN_TRANSACTIONAMNT']
            );
}
$total = 0.00;

include('../view/report.php');
exit;
?>

