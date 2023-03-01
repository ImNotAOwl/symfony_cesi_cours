<?php

namespace App\Service;

class HorlogeService
{
    public function getHorloge() : string
    {
        date_default_timezone_set('Europe/Paris');
        return date('d.m.Y H:i:s');
    }
}