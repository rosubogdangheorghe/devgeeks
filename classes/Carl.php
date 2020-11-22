<?php 

  
 class Carl extends Beast {

    private $name;
    private $life;
    private $power;
    private $defence;
    private $speed;
    private $chance;

    
   public function __construct() {
        
    }

    public function dragonForce() {
        $this->power = 2*$this->power;
        return $this->power;
    }
    

    
}