<?php


    class FloatRand {



          // functie pentru valori random de tip float rotunjite la 2 zecimale pentru a genera valorice variabilei $chance.
        public static function float_rand($min, $max) {
        $randomfloat = $min + mt_rand() / mt_getrandmax() * ($max - $min);
        return round($randomfloat,2);

    }
    }
