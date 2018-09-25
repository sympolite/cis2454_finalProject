<?php
require_once('../globaldb/model/databaseConnect.php');
require_once('../globaldb/model/databaseQueries.php');
$cid = filter_input(INPUT_GET, 'custID');
$cust = select_from("customer", "CUST_ID", "=", $cid);
$_SESSION['custID'] = $cid;
$name = $cust['CUST_NAME'];
$items = select_from("reservations", "RES_CUSTID", "=", $cid);
echo gettype($items);
$total = 0.00;
$balance = $cust['CUST_DEBITBALANCE'];
if ($items != false) {
    if (is_array($items[0])) {
        foreach ($items as $item) {
            echo $item;
            $t = select_from('travelitems', 'TRAVITEM_ID', '=', $item['RES_ITEMID']);
            $total += floatval($t['TRAVITEM_COST']);
        }
    }
    else {
        $t = select_from('travelitems', 'TRAVITEM_ID', '=', $items['RES_ITEMID']);
        $total += floatval($t['TRAVITEM_COST']);
        echo $total;
    }
    
}

include_once("payment.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

