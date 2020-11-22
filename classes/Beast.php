<?php

class Beast {
    private $name;
    private $life;
    private $power;
    private $defence;
    private $speed;
    private $chance;

   public function __construct() {

    }


    public function printStatus() {
      
        return $this->name."( 
            Life level: ". $this->life." ".
            "Power level: ". $this->power." ".
            "Defence level: ".$this->defence." ".
            "Speed: ".$this->speed." ".
            "Chance: ".$this->chance. ")";
    }
    
    /**
     * Get the value of life
     */ 
    public function getLife()
    {
        return $this->life;
    }

    /**
     * Get the value of power
     */ 
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Get the value of defence
     */ 
    public function getDefence()
    {
        return $this->defence;
    }

    /**
     * Get the value of speed
     */ 
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Get the value of chance
     */ 
    public function getChance()
    {
        return $this->chance;
    }

    /**
     * Set the value of life
     *
     * @return  self
     */ 
    public function setLife($life)
    {
        $this->life = $life;

        return $this;
    }

    /**
     * Set the value of power
     *
     * @return  self
     */ 
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Set the value of defence
     *
     * @return  self
     */ 
    public function setDefence($defence)
    {
        $this->defence = $defence;

        return $this;
    }

    /**
     * Set the value of speed
     *
     * @return  self
     */ 
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Set the value of chance
     *
     * @return  self
     */ 
    public function setChance($chance)
    {
        $this->chance = $chance;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
