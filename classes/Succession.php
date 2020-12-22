<?php

class Succession
{

    public $playerOneTurn = true;


    // functie pentru stabilirea ordinii de start pentru atac
    public static function initialTurnPlay($playerOne, $playerTwo)
    {

        //  echo("New Game!"."<br>");

        if ($playerOne->getSpeed() > $playerTwo->getSpeed()) {

            $playerOneTurn = true;
        } else if ($playerOne->getSpeed() < $playerTwo->getSpeed()) {

            $playerOneTurn = false;
        } else {
            if ($playerOne->getChance() >= $playerTwo->getChance()) {
                $playerOneTurn = true;
            } else {

                $playerOneTurn = false;
            }
        }

        return $playerOneTurn;
    }
    public static function showFirstAttacker($playerOne, $playerTwo)
    {
        global $playerOneTurn;
        if ($playerOneTurn) {
            $result =  $playerOne->getName(); //'Carl atacks first';

        } else {
            $result = $playerTwo->getName(); //'Beast attacks first';

        }
        return $result;
    }

    public static function turnPlay($damage, $playerOne, $playerTwo)
    {
        global $playerOneTurn;
        $playerOne->setChance(FloatRand::float_rand(Constants::MIN_P_ONE_CHANCE, Constants::MAX_P_ONE_CHANCE));
        $playerTwo->setChance(FloatRand::float_rand(Constants::MIN_P_TWO_CHANCE, Constants::MAX_P_TWO_CHANCE));

        if ($playerOneTurn) {

            $damage = Fight::fightResult($damage, $playerOne, $playerTwo);

            //apelare functie Forta Dragonului care dubleaza puterea lui Carl
            if (mt_rand(1, 100) <= Constants::DRAGON_FORCE_CHANCE) {
                $playerOne->dragonForce();
            }
        } else {

            $damage =   Fight::fightResultMagicShield($damage, $playerTwo, $playerOne);
        }
        $playerOneTurn = !$playerOneTurn;
        return $damage;
    }
}
