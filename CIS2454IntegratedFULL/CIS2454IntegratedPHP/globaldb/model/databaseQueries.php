<?php
/* Timothy Ian Anderson
 * CIS 2454 - Thurs Afternoon
 * Integrated Project
 */
#a catch-all select from statement; if the final two arguments are null,
#this is equivalent to "SELECT * FROM table"
function select_from($table, $column = null, $operator = '=', $colval = null) {
    global $db;
    $query = "SELECT * FROM " . $table;
    if ($column != null && $colval != null) {
       $query .= " WHERE " . $column . " " . $operator . " :" .$column;
    }
    try {
        $statement = $db->prepare($query);
        if ($column != null && $colval != null) {
            $statement->bindValue(':'.$column, $colval);
            $statement->execute();
            $result = $statement->fetch();
        }
        else {
            $statement->execute();
            $result = $statement->fetchAll();
        }
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        exit;
    }
}

#a very generic version of insert that takes an array of the record's columns
#and their associated values, including its primary key and value
function insert_into($table, $columns_and_values) {
    global $db;
    $query = 'INSERT INTO ' . $table . ' ';
    $columns = '(';
    $colvals = '(';
    
    #iterate through keys
    while($e = current($columns_and_values)) {
        $column = key($columns_and_values);
        $columns .= ($column . ',');
        $colvals .= (':' . $column . ',');
        next($columns_and_values);
    }
    
    #replace end comma with closing parenthesis
    $columns = substr_replace($columns, ')', strlen($columns)-1);
    $colvals = substr_replace($colvals, ')', strlen($colvals)-1);
    
    $query .= $columns . ' VALUES ' . $colvals;
    
     try {
        $statement = $db->prepare($query);
        foreach($columns_and_values as $column => $value) {
           $statement->bindValue(':' . $column, $value); 
        }
        $statement->execute();
        $statement->closeCursor();
        $product_id = $db->lastInsertId();
        return $product_id;
    } catch (PDOException $e) {
        exit;
    }
}

#a very generic version of UPDATE that takes an array of the record's columns
#and their associated values, and its primary key and value separately
function update($table, $columns_and_values, $primary_key, $pkey_value) {
    global $db;
    $query = 'UPDATE' . $table . ' SET ';
    $where = ' WHERE ' . $primary_key . ' = :' . $primary_key;
    
    #iterate through keys
    $columns = '';
    while($e = current($columns_and_values)) {
        $column = key($columns_and_values);
        $columns .= ($column . ' = :' . $column .', ');
        next($columns_and_values);
    }
    $columns = substr_replace($columns, '', strlen($columns)-2);
    
    $query = $query . $columns . $where;
    
    try {
        $statement = $db->prepare($query);
        foreach($columns_and_values as $column => $value) {
           $statement->bindValue(':' . $column, $value); 
        }
        $statement->bindValue(':' . $primary_key, $pkey_value);
        $statement->execute();
        $statement->closeCursor();
                $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        exit;
    }    
}

#a catch_all delete statement
function delete_from($table, $primary_key, $pkey_value) {
    global $db;
    $query = 'DELETE FROM' . $table . ' WHERE ' . $primary_key . ' = :' . $primary_key;
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':'.$primary_key, $pkey_value);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        exit;
    }
}
?>
