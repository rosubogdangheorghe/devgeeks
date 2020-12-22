<?php

class Succession {

     public $playerOneTurn = true;


// functie pentru stabilirea ordinii de start pentru atac
    public static function initialTurnPlay($playerOne, $playerTwo) {

        echo("New Game!"."<br>");

        if($playerOne->getSpeed() > $playerTwo->getSpeed()) {
          
            $playerOneTurn = true;

        } else if($playerOne->getSpeed() < $playerTwo->getSpeed()) {
          
            $playerOneTurn = false;

        } else {
            if($playerOne->getChance() >= $playerTwo->getChance()) {
                $playerOneTurn = true;
             
            } else {
               
                $playerOneTurn = false;
            }        
        }
        
        return $playerOneTurn;
      
    }

    
    // functie pentru executarea atacului pe rand
    // const MIN_CARL_CHANCE =  0.10;
    // const MAX_CARL_CHANCE =  0.30;
    // const MIN_BEAST_CHANCE = 0.25;
    // const MAX_BEAST_CHANCE = 0.40;
    // const DRAGON_FORCE_CHANCE = 10;

        public static function turnPlay($damage,$playerOne,$playerTwo) {
           global $playerOneTurn;
            $playerOne->setChance(FloatRand::float_rand(Constants::MIN_P_ONE_CHANCE, Constants::MAX_P_ONE_CHANCE));
            $playerTwo->setChance(FloatRand::float_rand(Constants::MIN_P_TWO_CHANCE, Constants::MAX_P_TWO_CHANCE));

        if($playerOneTurn) {

           Fight::fightResult($damage,$playerOne,$playerTwo);

            //apelare functie Forta Dragonului care dubleaza puterea lui Carl
            if(mt_rand(1,100)<= Constants::DRAGON_FORCE_CHANCE) {
                $playerOne->dragonForce();
            }  
          

        } else {
           
            Fight::fightResultMagicShield($damage,$playerTwo,$playerOne); 
          
          
        }
          $playerOneTurn = !$playerOneTurn;

          echo ("\t-".$playerOne->printStatus()."<br>");
          echo ("\t-".$playerTwo->printStatus()."<br>");
          echo "<br>";
         
          
    }
}