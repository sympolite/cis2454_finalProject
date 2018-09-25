<!--
Timothy Ian Anderson 
CIS 2454
Fall 2017 - Thurs. Afternoon
Integrated Project
-->
<?php

require_once('../../globaldb/model/databaseConnect.php');
require_once('../../globaldb/model/databaseQueries.php');
require_once('../model/TravelItem.php');


$itemsarr = [];

function create_items() {
    global $itemsarr;
    $clean_post = array_filter($_POST);

    foreach ($clean_post['item_code'] as $code) {
        if (strlen($code) > 0) {
        
            
            $type = current($clean_post['type']);
            $description = current($clean_post['description']);
            $available = current($clean_post['available']);
            $feature_1 = current($clean_post['feature_1']);
            $feature_2 = current($clean_post['feature_2']);
            $feature_3 = current($clean_post['feature_3']);
            $cost = current($clean_post['cost']);
            
            $item = new TravelItem($code, $type, $description, $available,
                    $feature_1, $feature_2, $feature_3, $cost);
        
            $itemsarr[] = $item;
            
            insert_into('travelitems', 
                    ['TRAVITEM_ID' => "'". $code . "'", 
                        'TRAVITEM_TYPE' => "'" . $type . "'",
                        'TRAVITEM_DESC' => "'" . $description . "'", 
                        'TRAVITEM_COST' => $cost,
                        'TRAVITEM_AVAIL' => $available,
                        'TRAVITEM_FEAT1' => "'" . $feature_1 . "'",
                        'TRAVITEM_FEAT2' => "'" . $feature_2 . "'", 
                        'TRAVITEM_FEAT3' => "'" . $feature_3 . "'"]);
            
            $type = next($clean_post['type']);
            $description = next($clean_post['description']);
            $available = next($clean_post['available']);
            $feature_1 = next($clean_post['feature_1']);
            $feature_2 = next($clean_post['feature_2']);
            $feature_3 = next($clean_post['feature_3']);
            $cost = next($clean_post['cost']);
            
        }
    }
}
include("../view/show_new_listing.php");
exit;
?>

