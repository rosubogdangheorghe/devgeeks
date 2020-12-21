<?php

class Fight {


    const MAGIC_SHIELD_CHANCE = 20;


    public static function fightResult($damage, $attacker, $defender)
    {


        $damage =  $attacker->getPower() - $defender->getDefence();
        if ($damage < 0) {
            $damage = 0;
        }
        if ($damage > 100) {
            $damage = 100;
        }
        if (FloatRand::float_rand(0, 1) > $attacker->getChance()) { //attacatorul rateaza(nu produce damage la atacat pt valori mai mari ca si valoarea $chance generata)
            $damage = 0;
        }
        $defender->setLife($defender->getLife() - $damage);

        echo 'damage: ' . $damage . "<br>";
    }


    // functie pe calcularea valorii atacului si a rezultatului atacului lui Beast asupra lui Carl.
    // Am optat pt functii separate pt a executa atacurile fiecaruia pt ca a aplica Scutul fermecat in cazul atacului lui Beast

    public static function fightResultMagicShield($damage, $attacker, $defender)
    {


        $damage =  $attacker->getPower() - $defender->getDefence();
        if ($damage < 0) {
            $damage = 0;
        }
        if ($damage > 100) {
            $damage = 100;
        }
        if (FloatRand::float_rand(0, 1) > $attacker->getChance()) { //attacatorul rateaza(nu produce damage la atacat pt valori mai mari ca si valoarea $chance generata)
            $damage = 0;
        }
        if (mt_rand(1, 100) <= self::MAGIC_SHIELD_CHANCE) {

            $damage = round($damage / 2);
        }
        $defender->setLife($defender->getLife() - $damage);

        echo 'damage: ' . $damage . "<br>";
    }
}