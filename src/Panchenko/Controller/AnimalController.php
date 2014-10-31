<?php

namespace Panchenko\Controller;

use Symfony\Component\HttpFoundation\Response;
use Panchenko\Model\DoggyClass;
use Panchenko\Model\HorseClass;

class AnimalController
{
    public function getAnimalsAction()
    {
        return new Response('Return animals...');
    }

    public function getAnimalAction($animalId)
    {
        switch ($animalId){
            case 'dog':
                $animal = new DoggyClass();
                $animal->setAnimalSpecies('King bulldog');
                $animal->setAnimalEyesColor('Dark brown');
                $animal->setAnimalWool('Short');
                break;
            case 'horse':
                $animal = new HorseClass();
                $animal->setAnimalSpecies('Mustang');
                $animal->setAnimalEyesColor('Black');
                $animal->setAnimalWool('Short');
                break;
            default:
                return new Response(sprintf('<p style="color: red">Error: Method not found for animal "%s"</p>', $animalId));
        }
        return new Response(var_dump($animal));
    }
} 