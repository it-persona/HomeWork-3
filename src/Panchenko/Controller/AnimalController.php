<?php

namespace Panchenko\Controller;

use Symfony\Component\HttpFoundation\Response;
use Panchenko\Model\DoggyClass;
use Panchenko\Model\HorseClass;

class AnimalController
{
    private $sey;
    protected $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getAnimalsAction()
    {
        return new Response($this->twig->render('animals.html.twig'));
    }

    public function getAnimalAction($animalId)
    {
        switch ($animalId){
            case 'dog':
                $animal = new DoggyClass();
                $animal->setAnimalSpecies('King bulldog');
                $animal->setAnimalEyesColor('Dark brown');
                $animal->setAnimalWool('Short');
                $tail = $animal->setAnimalTail(70);
                $weight = $animal->setAnimalWeight(60);
                $check = $animal->checkAnimal($tail, $weight);
                $this->sey = $animal->animalSay('Woof-Woof!');
                break;
            case 'horse':
                $animal = new HorseClass();
                $animal->setAnimalSpecies('Mustang');
                $animal->setAnimalEyesColor('Black');
                $animal->setAnimalWool('Short');
                $tail = $animal->setAnimalTail('test');
                $weight = $animal->setAnimalWeight(160);
                $check = $animal->checkAnimal($tail, $weight);
                $this->sey = $animal->animalSay('Igo-Go!');
                break;
            default:
                return new Response(sprintf('<h1 style="color: red">Error:</h1><p style="color: red">Method not found for animal <b>"%s"</b></p>', $animalId));
        }
        return new Response('<h1>' . $animal->getAnimal() . ' object info:</h1><hr>' . $animal . '<br>' . $check .'<hr>');
    }
}
