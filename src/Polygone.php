<?php

namespace Opmvpc\Formes;

class Polygone extends Forme {

    private array $points;


    public function __construct(array $points, string $color = "#000000"){
        parent::__construct($color);
        $this->points = $points;
    }

    public function getPoints():Point{
        return $this->points;
    }

}
