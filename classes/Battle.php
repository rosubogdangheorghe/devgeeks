<?php

class Battle {
  
  
    private $damage;
    private $carl;
    private $beast;
    private $isCarlTurn = true;
   


    public function __construct() {

        $this->carl = new Player();
        $this->beast = new Player();

    }

        // initializarea jucatorilor

        private function playerInitialization() {
            $this->carl->setName('Carl');
            $this->carl->setLife(mt_rand(Constants::MIN_P_ONE_LIFE,Constants::MAX_P_ONE_LIFE));
            $this->carl->setPower(mt_rand(Constants::MIN_P_ONE_POWER,Constants::MAX_P_ONE_POWER));
            $this->carl->setDefence(mt_rand(Constants::MIN_P_ONE_DEFENCE,Constants::MAX_P_ONE_DEFENCE));
            $this->carl->setSpeed(mt_rand(Constants::MIN_P_ONE_SPEED,Constants::MAX_P_ONE_SPEED));
            $this->carl->setChance(FloatRand::float_rand(Constants::MIN_P_ONE_CHANCE,Constants::MAX_P_ONE_CHANCE));
            echo 'Here is Carl: '."<br>";
            echo "\t-".$this->carl->printStatus()."<br>";

            $this->beast->setName('Beast');
            $this->beast->setLife(mt_rand(Constants::MIN_P_TWO_LIFE,Constants::MAX_P_TWO_LIFE));
            $this->beast->setPower(mt_rand(Constants::MIN_P_TWO_POWER,Constants::MAX_P_TWO_POWER));
            $this->beast->setDefence(mt_rand(Constants::MIN_P_TWO_DEFENCE,Constants::MAX_P_TWO_DEFENCE));
            $this->beast->setSpeed(mt_rand(Constants::MIN_P_TWO_SPEED,Constants::MAX_P_TWO_SPEED));
            $this->beast->setChance(FloatRand::float_rand(Constants::MIN_P_TWO_CHANCE,Constants::MAX_P_TWO_CHANCE));    
            echo 'Here is Beast: '."<br>";
            echo "\t-".$this->beast->printStatus()."<br>";
        }

        // executarea jocului si afisarea castigatorului
        public function play(){
            $this->playerInitialization();

            $gameOver = new EndGame();
           

            echo "3...2...1...Start"."<br>";
            echo "<br>";
           

            $this->isCarlTurn=Succession::initialTurnPlay($this->carl,$this->beast);


            if($this->isCarlTurn) {
                echo 'Carl atacks first'."<br>";
            } else {
                echo 'Beast Attacks first'."<br>";
            }

            $i = 1;

            while(!$gameOver->gameOver($this->carl->getLife(),$this->beast->getLife()) && $i <= 20) {
                echo 'Round: '. $i;
                echo "<br>";
                Succession::turnPlay($this->damage,$this->carl,$this->beast);
              
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