<?php

namespace Panchenko\Model;

class DoggyClass extends AbstractAnimals implements AnimalsInterface
{
    private $maxTail;
    private $maxWeight;

    public function __construct()
    {
        $this->animal       = "Dog";
        $this->maxWeight    = 70;
        $this->maxTail      = 60;
    }

    public function animalSay($voice)
    {
        return $voice;
    }

    public function checkAnimal($tailValue, $weightValue)
    {
        if ($weightValue > $this->maxWeight || $tailValue > $this->maxTail) {
            if ($weightValue > $this->maxWeight && $tailValue > $this->maxTail) {
                $arrMsg[0] = "This " . strtolower($this->animal) . " have really big weight! May be it is not normal?";
                $arrMsg[1] = "Are you sure that the tail length " . $tailValue . " sm for $this->animal it is normal?<br>";
                return $msg = implode("<br>", $arrMsg);
            } elseif ($weightValue > $this->maxWeight) {
                $arrMsg[0] = "Your animal so really big! May be it is not normal?";
            } else {
                $arrMsg[1] = "Normal weight!";
            }
            if ($tailValue > $this->maxTail) {
                $arrMsg[0] = "Are you sure that the tail length " . $tailValue . " sm for $this->animal it is normal?<br>";
            } else {
                $arrMsg[1] = "Normal tail!";
            }
                return $msg = implode("<br>", $arrMsg);
        }
            return $msg = "Congratulations! Tail and weight values - normal.";
    }
}
