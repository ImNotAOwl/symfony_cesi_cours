<?php

namespace App\Service;

class OperationsService
{
    public function calcul(float $nb1, float $nb2, string $op) : string {
        switch ($op) {
            case "plus" :
                $res=$nb1+$nb2;
                break;
            case "moins" :
                $res=$nb1-$nb2;
                break;
            case "mult" :
                $res=$nb1*$nb2;
                break;
            case "div" :
                if ($nb2==0) {
                    $res="Division par zéro impossible";
                }
                else {
                    $res=$nb1/$nb2;
                }
                break;
            default:
                $res="Mauvais opérateur";
                break;
        }
        return $res;
    }

    public function add(float $nb1, float $nb2) : float
    {
        return $nb1+$nb2;
    }

    public function diff(float $nb1, float $nb2) : float
    {
        return $nb1-$nb2;
    }

    public function mult(float $nb1, float $nb2) : float
    {
        return $nb1*$nb2;
    }

    public function div(float $nb1, float $nb2) : float
    {
        return $nb1/$nb2;
    }
}