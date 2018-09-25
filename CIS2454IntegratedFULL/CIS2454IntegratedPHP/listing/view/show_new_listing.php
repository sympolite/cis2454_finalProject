<!--
Timothy Ian Anderson 
CIS 2454
Fall 2017 - Thurs. Afternoon
Integrated Project
-->
<?php

require_once('../model/TravelItem.php');
require_once('../controller/process_action.php');

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
        <table>
            <tr>
                    <th>Item Code</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Available</th>
                    <th>Feature 1</th>
                    <th>Feature 2</th>
                    <th>Feature 3</th>
                    <th>Cost</th>
                </tr>
        <?php
        create_items();
        global $itemsarr;
        foreach ($itemsarr as $item) {?>
            <tr>
                <td><?php echo $item->get_item_code();?></td>
                <td><?php echo $item->get_item_type();?></td>
                <td><?php echo $item->get_description();?></td>
                <td><?php echo $item->get_available();?></td>
                <td><?php echo $item->get_feature_1();?></td>
                <td><?php echo $item->get_feature_2();?></td>
                <td><?php echo $item->get_feature_3();?></td>
                <td>$<?php echo $item->get_cost();?></td>
            </tr>
        <?php
        }
        ?>
        </table>
    </body>
</html>

