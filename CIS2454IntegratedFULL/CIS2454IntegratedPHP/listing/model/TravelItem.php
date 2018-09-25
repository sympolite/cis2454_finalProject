<?php
/*
 * Timothy Ian Anderson 
 * CIS 2454
 * Fall 2017 - Thurs. Afternoon
 *Integrated Project
 * 
 */
class TravelItem {
    private $item_code;
    private $item_type;
    private $description;
    private $available;
    private $feature_1;
    private $feature_2;
    private $feature_3;
    private $cost;
    
    
    public function __construct($item_code, $item_type,
            $description, $available, $feature_1, 
            $feature_2, $feature_3, $cost) {
        $this->item_code = $item_code;
        $this->item_type = $item_type;
        $this->description = $description;
        $this->available = $available;
        $this->feature_1 = $feature_1;
        $this->feature_2 = $feature_2;
        $this->feature_3 = $feature_3;
        $this->cost = $cost;
    }
    
    public function get_item_code() {
        return $this->item_code;
    }

    public function get_item_type() {
        return $this->item_type;
    }

    public function get_description() {
        return $this->description;
    }

    public function get_available() {
        return $this->available;
    }

    public function get_feature_1() {
        return $this->feature_1;
    }

    public function get_feature_2() {
        return $this->feature_2;
    }

    public function get_feature_3() {
        return $this->feature_3;
    }

    public function get_cost() {
        return $this->cost;
    }

    public function set_item_code($item_code) {
        $this->item_code = $item_code;
    }

    public function set_item_type($item_type) {
        $this->item_type = $item_type;
    }

    public function set_description($description) {
        $this->description = $description;
    }

    public function set_available($available) {
        if (is_numeric($available)) {
            $this->available = $available;
        }
        
    }

    public function set_feature_1($feature_1) {
        $this->feature_1 = $feature_1;
    }

    public function set_feature_2($feature_2) {
        $this->feature_2 = $feature_2;
    }

    public function set_feature_3($feature_3) {
        $this->feature_3 = $feature_3;
    }

    public function set_cost($cost) {
        if (is_numeric($cost)) {
            $this->cost = $cost;
        }
        
    }


}

