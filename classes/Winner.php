<?php
class Winner {

    public static function showWinner($playerOne,$playerTwo) {

        if($playerOne->getLife()>$playerTwo->getLife()) {
            $winner = $playerOne->getName();
        } else {
            $winner = $playerTwo->getName();
        }
        return $winner;
        
        echo "The winner is : " .$winner."!<br>";



    }


}