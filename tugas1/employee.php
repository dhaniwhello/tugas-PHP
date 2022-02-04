<?php

    class Employee{
        public $name;
        public $age;
        public $division;
        public $salary;
        public function __construct($name, $age, $division, $salary){
            $this->name = $name;
            $this->age = $age;
            $this->division = $division;
            $this->salary = $salary;
        }
        
        
    }


?>