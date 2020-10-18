<?php 
require_once('database.php');

class Calculation {
    public $a;
    public $b;

    function __construct($a, $b){
        $this->a = mysql_real_escape_string($a);
        $this->b = mysql_real_escape_string($b);
        $calc = new DatabaseClass();
        $calc->Insert("Insert into `calculation`( `a` , `b` , `average` , `area` , `s_area`) values ( :a , :b , :average , :area , :s_area)", [
            'a' => $this->a,
            'b' => $this->b,
            'average' => $this->average(),
            'area' => $this->area(),
            's_area' => $this->areaSquared(),
        ]);
    }
        
    function area() {

        return $this->a * $this->b;
    }

    function areaSquared() {
        return ($this->a * $this->b)^2;
    }

    function average() {
        return ($this->a + $this->b)/2;
    }
}