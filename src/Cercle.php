<?php

namespace Opmvpc\Formes;

class Cercle extends Forme {

    private float $rayon;
    private Point $centre;


    public function __construct(Point $centre, float $rayon, string $color = "#000000"){
        parent::__construct($color);
        $this->rayon = $rayon;
        $this->centre = $centre;
    }

    public function getRayon():float{
        return $this->rayon;
    }
    public function getCentre():Point{
        return $this->centre;
    } 


}


