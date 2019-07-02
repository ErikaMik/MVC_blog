<?php

namespace App\Helper;

class InputHelper
{
    //validacija
    //apdirbimai teksto, skaiciu
    //password generatoriai

    public static function passwordGenerator($password)
    {
        return md5(md5($password.'salt'));
    }
}