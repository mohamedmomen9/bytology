<?php 
require_once('database.php');

class History {
        
    function getLast() {
        $db = new DatabaseClass();
        $result = $db->select("select `a` , `b` , `average` , `area` , `s_area` from  `calculation` order by id desc limit 5");    
        return $result;
    }

    function generateDoc() {
        $this->getLast();
        return true;
    }
}