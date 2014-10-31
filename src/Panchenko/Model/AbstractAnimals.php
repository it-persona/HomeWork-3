<?php

namespace Panchenko\Model;

abstract class AbstractAnimals
{
    public $animal;
    public $body;
    public $eyes;
    protected $species;
    protected $tail;
    protected $weight;
    protected $wool;

    abstract protected function checkAnimal($tailValue, $weightValue);

    // Setters

    public function setAnimalEyesColor($eyesColor)
    {
        $this->eyes = $eyesColor;
    }

    public function setAnimalSpecies($setSpecies)
    {
        $this->species = $setSpecies;
    }

    public function setAnimalTail($tailLength)
    {
        if (!is_int($tailLength)) {
            echo "<b style='color: red'>" . "Error: Variable $tailLength not integer type." . "</b>";
            
        } else {
            $this->tail = $tailLength;
        }
        return $tailLength;
    }

    public function setAnimalWeight($setWeight)
    {
        if (!is_int($setWeight)) {
            echo "<b style='color: red'>" . "Error: Variable $setWeight not integer type." . "</b>";
        }
        $this->weight = $setWeight;
        $setWeight  > 65 ? $this->body = "Big" : $this->body = "Normal";
        return $setWeight;
    }

    public function setAnimalWool($setWool)
    {
        $this->wool = $setWool;
    }

    // Getters

    public function getAnimal()
    {
        return $this->animal;
    }
}
