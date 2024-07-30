<?php

namespace App;

class Level
{
    static public function calculate(int $experience)
    {
        return ceil($experience / 1000);
    }
}