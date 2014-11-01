<?php

namespace Panchenko\Model;

use Exception;

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

    public function __toString()
    {
        $animalInfo = array('species'       =>  empty($this->species) ? 'undefined' : $this->species,
                            'eyes'          =>  empty($this->eyes)    ? 'undefined' : $this->eyes,
                            'tail_length'   =>  empty($this->tail)    ? 0           : $this->tail,
                            'weight_value'  =>  empty($this->weight)  ? 0           : $this->weight,
                            'body_type'     =>  empty($this->body)    ? 'undefined' : $this->body,
                            'wool_length'   =>  empty($this->wool)    ? 'undefined' : $this->wool
                            );

        return implode("<br>", $animalInfo);
    }
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
            echo '<b style="color: red">' . 'Error: Variable $tailLength not integer type</b>';
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
