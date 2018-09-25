<?php
/*
 * Timothy Ian Anderson 
CIS 2454
Fall 2017 - Thurs. Afternoon
Integrated Project
 * 
 */
include_once ('../../globaldb/model/databaseConnect.php');
include_once ('../../globaldb/model/databaseQueries.php');

class PurchasedItem {
    private $fin_code;
    private $item_code;
    private $cust_code;
    private $type;
    private $description;
    private $date;
    private $cost;
       
    public function __construct($fcode = 'F0000', $ccode = 'C0000', $icode = 'I0000', $type = '', $description = '', $date = '1970-01-01', $cost = 0.00) {
        $this->fin_code = $fcode;
        $this->cust_code = $ccode;
        $this->item_code = $icode;
        $this->type = $type;
        $this->description = $description;
        $this->date = $date;
        $this->cost = $cost;
    }
    
    public function get_item_code() {
        return $this->item_code;
    }

    public function get_type() {
        return $this->type;
    }

    public function get_date() {
        return $this->date;
    }

    public function get_cost() {
        return number_format($this->cost,2);
    }

    public function set_item_code($item_code) {
        $this->item_code = $item_code;
    }

    public function set_type($type) {
        $this->type = $type;
    }

    public function set_date($date) {
        $this->date = $date;
    }

    public function set_cost($cost) {
        if (is_numeric($cost)) {
            $this->cost = $cost;
        }
    }
    
    public function get_description() {
        return $this->description;
    }

    public function set_description($description) {
        $this->description = $description;
    }


}

