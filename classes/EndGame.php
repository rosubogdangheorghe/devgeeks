<?php

class EndGame {

    // functia pentru opriea jocului
    
    public function gameOver($playerOne,$playerTwo) {
        return  ($playerOne <1 || $playerTwo<1 );

    }

}

//   return  ($this->carl->getLife() <1 || $this->beast->getLife()<1 );