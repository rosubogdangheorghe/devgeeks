<?php

class EndGame {

    // functia pentru opriea jocului
    
    public function gameOver($playerOne,$playerTwo) {
        return  ($playerOne <1 || $playerTwo<1 );

    }

}

