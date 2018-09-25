<!--
Timothy Ian Anderson 
CIS 2454
Fall 2017 - Thurs. Afternoon
Integrated Project
-->
<?php session_start();?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Listing</title>
        <style>
            table, tr, td, th {
                border:1px black solid;
            }
        </style>
    </head>
    <body>
        <h1>Company Info Edit Form</h1>
        <p>Company: <?php echo $_SESSION['business_name'];?></p>
        <form action ="../controller/process_action.php" method="POST">
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
                <tr>
                    <td><input type ="text" name ="item_code[]"></td>
                    <td><input type ="text" name ="type[]"></td>
                    <td><input type ="text" name ="description[]"></td>
                    <td><input type ="text" name ="available[]"></td>
                    <td><input type ="text" name ="feature 1[]"></td>
                    <td><input type ="text" name ="feature 2[]"></td>
                    <td><input type ="text" name ="feature 3[]"></td>
                    <td><input type ="text" name ="cost[]"></td>
                </tr>
                <tr>
                    <td><input type ="text" name ="item_code[]"></td>
                    <td><input type ="text" name ="type[]"></td>
                    <td><input type ="text" name ="description[]"></td>
                    <td><input type ="text" name ="available[]"></td>
                    <td><input type ="text" name ="feature 1[]"></td>
                    <td><input type ="text" name ="feature 2[]"></td>
                    <td><input type ="text" name ="feature 3[]"></td>
                    <td><input type ="text" name ="cost[]"></td>
                </tr>
                <tr>
                    <td><input type ="text" name ="item_code[]"></td>
                    <td><input type ="text" name ="type[]"></td>
                    <td><input type ="text" name ="description[]"></td>
                    <td><input type ="text" name ="available[]"></td>
                    <td><input type ="text" name ="feature 1[]"></td>
                    <td><input type ="text" name ="feature 2[]"></td>
                    <td><input type ="text" name ="feature 3[]"></td>
                    <td><input type ="text" name ="cost[]"></td>
                </tr>
                <tr>
                    <td><input type ="text" name ="item_code[]"></td>
                    <td><input type ="text" name ="type[]"></td>
                    <td><input type ="text" name ="description[]"></td>
                    <td><input type ="text" name ="available[]"></td>
                    <td><input type ="text" name ="feature 1[]"></td>
                    <td><input type ="text" name ="feature 2[]"></td>
                    <td><input type ="text" name ="feature 3[]"></td>
                    <td><input type ="text" name ="cost[]"></td>
                </tr>
            </table>
            <input type="submit" value ="Submit">
        </form>
    </body>
</html>
