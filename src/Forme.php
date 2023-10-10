<?php

namespace Opmvpc\Formes;

abstract class Forme {
    protected $color;
    public function __construct(string $color = "#000000")
    {
        $this->color = $color;
    }
  
    public function getCouleur():string
    { //assuming color is un string
        return $this->color;
    }

}
