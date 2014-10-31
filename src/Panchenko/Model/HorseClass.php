<?php

namespace Panchenko\Model;

class HorseClass extends AbstractAnimals implements AnimalsInterface
{
    const MAX_TAIL = 95, MAX_WEIGHT = 120;

    public function __construct()
    {
        $this->animal = "Horse";
    }

    public function animalSay($message)
    {
        return $message;
    }

    public function checkAnimal($tailVal, $weightVal)
    {
        return $message = "$this->animal not checked now!";
    }
}
