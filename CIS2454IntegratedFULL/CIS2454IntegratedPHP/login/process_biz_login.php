<?php
session_start();
require('../globaldb/model/databaseConnect.php');
require('../globaldb/model/databaseQueries.php');

$business_name = filter_input(INPUT_POST, 'login');
$_SESSION['business_name'] = $business_name;

include('businessactions.html');
exit;