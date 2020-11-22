<?php

class Battle {
    private $dragonForceChance = 10;
    private $magicShieldChance = 20;
    private $damage;
    private $carl;
    private $beast;
    private $isCarlTurn = true;
  


    public function __construct() {

        $this->carl = new Carl();
        $this->beast = new Beast();

    }
    // functie pentru valori random de tip float rotunjite la 2 zecimale pentru a genera valorice variabilei $chance.
    public function float_rand($min, $max) {
        $randomfloat = $min + mt_rand() / mt_getrandmax() * ($max - $min);
        return round($randomfloat,2);
    }
   
    
    // functie pe calcularea valorii atacului si a rezultatului atacului lui Carl asupra lui Beast.

    private function fightResult($damage,$attacker,$defender) {
        // reinitialzare la fiecare runda a valorilor pt $chance pentru a implementa posibilitatea de ratare a atacului
        $this->carl->setChance($this->float_rand(0.10,0.30));
        $this->beast->setChance($this->float_rand(0.25,0.40));

       
        $damage =  $attacker->getPower() - $defender->getDefence();
        if($damage < 0) {
            $damage = 0;
        }
        if($damage>100) {
            $damage =100;
        }
        if($this->float_rand(0,1) > $this->carl->getChance() ) {//attacatorul rateaza(nu produce damage la atacat pt valori mai mari ca si valoarea $chance generata)
            $damage = 0;

        }
        $defender->setLife($defender->getLife()-$damage);

        echo 'damage: '.$damage."<br>"; 
       
    }
     // functie pe calcularea valorii atacului si a rezultatului atacului lui Beast asupra lui Carl.
     // Am optat pt functii separate pt a executa atacurile fiecaruia pt ca a aplica Scutul fermecat in cazul atacului lui Beast

    private function fightResultMagicShield($damage,$attacker,$defender) {
         // reinitialzare la fiecare runda a valorilor pt $chance pentru a implementa posibilitatea de ratare a atacului
        $this->carl->setChance($this->float_rand(0.10,0.30));
        $this->beast->setChance($this->float_rand(0.25,0.40));

        $damage =  $attacker->getPower() - $defender->getDefence();
        if($damage < 0) {
            $damage = 0;
        }
        if($damage>100) {
            $damage =100;
        }
        if($this->float_rand(0,1) > $this->beast->getChance() ) { //attacatorul rateaza(nu produce damage la atacat pt valori mai mari ca si valoarea $chance generata)
            $damage = 0;

        }
        if(mt_rand(1,100)<=$this->magicShieldChance) {
        
             $damage = round($damage/2);
          
         }
        $defender->setLife($defender->getLife()-$damage);

        echo 'damage: '.$damage."<br>"; 
       
    }

    // functie pentru stabilirea ordinii de start pentru atac

    private function initialTurnPlay() {
        echo("New Game!"."<br>");

        if($this->carl->getSpeed() > $this->beast->getSpeed()) {
          
            $this->isCarlTurn = true;

        } else if($this->carl->getSpeed() < $this->beast->getSpeed()) {
          
            $this->isCarlTurn = false;

        } else {
            if($this->carl->getChance() >= $this->beast->getChance()) {
                $this->isCarlTurn = true;
             
            } else {
               
                $this->isCarlTurn = false;
            }        
        }
        
        
        return $this->isCarlTurn;
    }

    // functie pentru executarea atacului pe rand

        private function turnPlay() {
           

        if($this->isCarlTurn) {

            $this->fightResult($this->damage,$this->carl,$this->beast);

            //apelare functie Forta Dragonului care dubleaza puterea lui Carl
            if(mt_rand(1,100)<=$this->dragonForceChance) {
            $this->carl->dragonForce();
            }  

        } else {
           
            $this->fightResultMagicShield($this->damage,$this->beast,$this->carl);       
          
        }
          $this->isCarlTurn = !$this->isCarlTurn;

          echo ("\t-".$this->carl->printStatus()."<br>");
          echo ("\t-".$this->beast->printStatus()."<br>");
          echo "<br>";
         
        
          
    }

        // functia pentru opriea jocului
        private function gameOver() {
            return  ($this->carl->getLife() <1 || $this->beast->getLife()<1 );

        }

        // initializarea jucatorilor

        public function playerInitialization() {
            $this->carl->setName('Carl');
            $this->carl->setLife(mt_rand(65,95));
            $this->carl->setPower(mt_rand(60,70));
            $this->carl->setDefence(mt_rand(40,50));
            $this->carl->setSpeed(mt_rand(40,50));
            $this->carl->setChance($this->float_rand(0.10,0.30));
            echo 'Here is Carl: '."<br>";
            echo "\t-".$this->carl->printStatus()."<br>";

            $this->beast->setName('Beast');
            $this->beast->setLife(mt_rand(55,80));
            $this->beast->setPower(mt_rand(50,80));
            $this->beast->setDefence(mt_rand(35,55));
            $this->beast->setSpeed(mt_rand(40,60));
            $this->beast->setChance($this->float_rand(0.25,0.40));    
            echo 'Here is Beast: '."<br>";
            echo "\t-".$this->beast->printStatus()."<br>";
        }

        // executarea jocului si afisarea castigatorului
        public function play(){
            $this->playerInitialization();

            echo "3...2...1...Start"."<br>";
            echo "<br>";
           

            $this->initialTurnPlay();

            if($this->isCarlTurn) {
                echo 'Carl atacks first'."<br>";
            } else {
                echo 'Beast Attacks first'."<br>";
            }

            $i = 1;
            while(!$this->gameOver() && $i <= 20) {
                echo 'Round: '. $i;
                echo "<br>";
                $this->turnPlay();
              
                echo "<br>";
                $i++;
            }

            echo "END GAME"."<br>";

            if($this->carl->getLife()>$this->beast->getLife()) {
                $winner = $this->carl->getName();
            } else {
                $winner = $this->beast->getName();
            }
            echo "The winner is : " .$winner."!<br>";
        }

}