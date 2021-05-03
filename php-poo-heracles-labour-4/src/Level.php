<?php

namespace App;


class Level
{
    static public function calculate(int $experience)
    {
        return $LEVEL = ceil($experience / 1000);
    }
}
