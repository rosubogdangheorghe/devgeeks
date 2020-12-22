<?php

class Battle
{


    private $damage;
    private $carl;
    private $beast;
    public $carlStatus;


    public function __construct()
    {

        $this->carl = new Player();
        $this->beast = new Player();
    }


    // initializarea jucatorilor

    public function playerOneInitialization()
    {
        $this->carl->setName('Carl');
        $this->carl->setLife(mt_rand(Constants::MIN_P_ONE_LIFE, Constants::MAX_P_ONE_LIFE));
        $this->carl->setPower(mt_rand(Constants::MIN_P_ONE_POWER, Constants::MAX_P_ONE_POWER));
        $this->carl->setDefence(mt_rand(Constants::MIN_P_ONE_DEFENCE, Constants::MAX_P_ONE_DEFENCE));
        $this->carl->setSpeed(mt_rand(Constants::MIN_P_ONE_SPEED, Constants::MAX_P_ONE_SPEED));
        $this->carl->setChance(FloatRand::float_rand(Constants::MIN_P_ONE_CHANCE, Constants::MAX_P_ONE_CHANCE));
       
        return $this->carlStatus = $this->carl->printStatus();
    }
    public function playerTwoInitialization()
    {
        $this->beast->setName('Beast');
        $this->beast->setLife(mt_rand(Constants::MIN_P_TWO_LIFE, Constants::MAX_P_TWO_LIFE));
        $this->beast->setPower(mt_rand(Constants::MIN_P_TWO_POWER, Constants::MAX_P_TWO_POWER));
        $this->beast->setDefence(mt_rand(Constants::MIN_P_TWO_DEFENCE, Constants::MAX_P_TWO_DEFENCE));
        $this->beast->setSpeed(mt_rand(Constants::MIN_P_TWO_SPEED, Constants::MAX_P_TWO_SPEED));
        $this->beast->setChance(FloatRand::float_rand(Constants::MIN_P_TWO_CHANCE, Constants::MAX_P_TWO_CHANCE));
       
        return $this->beastStatus = $this->beast->printStatus();
    }

    // executarea jocului si afisarea castigatorului
    public function play()
    {


        $gameOver = new EndGame();


        $i = 1;
        $array = [];

        while (!$gameOver->gameOver($this->carl->getLife(), $this->beast->getLife()) && $i <= 20) {

            $this->newDamage = Succession::turnPlay($this->damage, $this->carl, $this->beast);

            $result1 = $this->carl->printStatus();
            $result2 = $this->beast->printStatus();
            $array[] = [$this->newDamage, $result1, $result2];


            $i++;
        }

        return $array;
    }


    /**
     * Get the value of carl
     */
    public function getCarl()
    {
        return $this->carl;
    }

    /**
     * Set the value of carl
     *
     * @return  self
     */
    public function setCarl($carl)
    {
        $this->carl = $carl;

        return $this;
    }

    /**
     * Get the value of beast
     */
    public function getBeast()
    {
        return $this->beast;
    }

    /**
     * Set the value of beast
     *
     * @return  self
     */
    public function setBeast($beast)
    {
        $this->beast = $beast;

        return $this;
    }

    /**
     * Get the value of damage
     */
    public function getDamage()
    {
        return $this->damage;
    }
}
