<?php
require_once '../globaldb/model/databaseConnect.php';
require_once '../globaldb/model/databaseQueries.php';
session_start();
$payment = floatval(filter_input(INPUT_POST, 'payment'));
$customer = filter_input(INPUT_POST, 'customerID');
$ctable = select_from('customer', 'CUST_ID', '=', $customer);
$current_balance = floatval($ctable['CUST_DEBITBALANCE']);
echo $current_balance;
if ($current_balance < $payment) {
    include_once('not_enough_money.php');
    exit;
}
$num_rewards = floor($payment/1000);
$new_balance = $current_balance - $payment;
update('customer', array('cust_debitbalance' => $new_balance), 'cust_id', $_SESSION['custID']);
$today = date("Y/m/d");

$finID = 1000;
$finID_ok = false;
while (!$finID_ok) {
    try {
        insert_into('financialhistory',
                array(
                    'FIN_ID' => 'C'.$finID,
                    'FIN_ITEMID' => '',
                    'FIN_CUSTID' => $customer,
                    'FIN_TRANSACTIONAMNT' => $payment,
                    'FIN_DATE' => $today
                )
                );
        $finID_ok = true;
    } catch (Exception $ex) {
        $finID++;
    }
}

for ($i = 0; $i < $num_rewards; $i++) {
    $rewID = 1000;
    $rewID_ok = false;
    while (!$rewID_ok) {
        try {
            insert_into('rewards',
                    array('REWARD_ID' => 'R'.$rewID, 
                        'REWARD_CUSTID' => $customer, 
                        'REWARD_BALANCE' => 100.00,
                        'REWARD_DATE' => $today)
                    );
            $rewID_ok = true;
        } catch (Exception $ex) {
            $rewID++;
        }
    }
}

$travitem = null;
$items = null;

include_once 'display_results.php';
exit;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

