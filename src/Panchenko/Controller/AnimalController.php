<?php

namespace Panchenko\Controller;

use Symfony\Component\HttpFoundation\Response;
use Panchenko\Model\DoggyClass;
use Panchenko\Model\HorseClass;

class AnimalController
{
    private $sey;

    public function getAnimalsAction()
    {
        return new Response('<h1>Animals page</h1>What animal you are interested in <a href="/animals/dog">King bulldog</a> or Horse <a href="/animals/horse">Mustang</a>');
    }

    public function getAnimalAction($animalId)
    {
        switch ($animalId){
            case 'dog':
                $animal = new DoggyClass();
                $animal->setAnimalSpecies('King bulldog');
                $animal->setAnimalEyesColor('Dark brown');
                $animal->setAnimalWool('Short');
                $this->sey = $animal->animalSay('Woof-Woof!');
                break;
            case 'horse':
                $animal = new HorseClass();
                $animal->setAnimalSpecies('Mustang');
                $animal->setAnimalEyesColor('Black');
                $animal->setAnimalWool('Short');
                break;
            default:
                return new Response(sprintf('<h1 style="color: red">Error:</h1><p style="color: red">Method not found for animal <b>"%s"</b></p>', $animalId));
        }
        return new Response('<h1>' . $animal->getAnimal() . ' object info:</h1><hr>' . $animal . '<br><hr>');
    }
}
