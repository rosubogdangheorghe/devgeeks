<?php

class Battle {
    const DRAGON_FORCE_CHANCE = 10;
  
    private $damage;
    private $carl;
    private $beast;
    private $isCarlTurn = true;


    public function __construct() {

        $this->carl = new Player();
        $this->beast = new Player();

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
    const MIN_CARL_CHANCE =  0.10;
    const MAX_CARL_CHANCE =  0.30;
    const MIN_BEAST_CHANCE = 0.25;
    const MAX_BEAST_CHANCE = 0.40;

        private function turnPlay() {

            $this->carl->setChance(FloatRand::float_rand(self::MIN_CARL_CHANCE, self::MAX_CARL_CHANCE));
             $this->beast->setChance(FloatRand::float_rand(self::MIN_BEAST_CHANCE, self::MAX_BEAST_CHANCE));

        if($this->isCarlTurn) {

           Fight::fightResult($this->damage,$this->carl,$this->beast);

            //apelare functie Forta Dragonului care dubleaza puterea lui Carl
            if(mt_rand(1,100)<= self::DRAGON_FORCE_CHANCE) {
            $this->carl->dragonForce();
            }  

        } else {
           
            Fight::fightResultMagicShield($this->damage,$this->beast,$this->carl);       
          
        }
          $this->isCarlTurn = !$this->isCarlTurn;

          echo ("\t-".$this->carl->printStatus()."<br>");
          echo ("\t-".$this->beast->printStatus()."<br>");
          echo "<br>";
         
          
    }

    

        // initializarea jucatorilor

        public function playerInitialization() {
            $this->carl->setName('Carl');
            $this->carl->setLife(mt_rand(65,95));
            $this->carl->setPower(mt_rand(60,70));
            $this->carl->setDefence(mt_rand(40,50));
            $this->carl->setSpeed(mt_rand(40,50));
            $this->carl->setChance(FloatRand::float_rand(0.10,0.30));
            echo 'Here is Carl: '."<br>";
            echo "\t-".$this->carl->printStatus()."<br>";

            $this->beast->setName('Beast');
            $this->beast->setLife(mt_rand(55,80));
            $this->beast->setPower(mt_rand(50,80));
            $this->beast->setDefence(mt_rand(35,55));
            $this->beast->setSpeed(mt_rand(40,60));
            $this->beast->setChance(FloatRand::float_rand(0.25,0.40));    
            echo 'Here is Beast: '."<br>";
            echo "\t-".$this->beast->printStatus()."<br>";
        }

        // executarea jocului si afisarea castigatorului
        public function play(){
            $this->playerInitialization();

            $gameOver = new EndGame();


            echo "3...2...1...Start"."<br>";
            echo "<br>";
           

            $this->initialTurnPlay();

            if($this->isCarlTurn) {
                echo 'Carl atacks first'."<br>";
            } else {
                echo 'Beast Attacks first'."<br>";
            }

            $i = 1;

            while(!$gameOver->gameOver($this->carl->getLife(),$this->beast->getLife()) && $i <= 20) {
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