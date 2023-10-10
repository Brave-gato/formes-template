<?php

namespace Opmvpc\Formes;

use Opmvpc\Formes\Forme;
use Opmvpc\Formes\Ligne;
use Opmvpc\Formes\Cercle;
use Opmvpc\Formes\Polygone;
use Opmvpc\Formes\Rectangle;

class Canvas extends Forme {

  
        private float $width;
        private float $height;
        private array $formes;
    
        public function __construct(float $width, float $height, string $color = "#FFFFFF"){
            parent::__construct($color);

            $this->width = $width;
            $this->height = $height;
            $this->formes = [];
        }
    
        public function getWidth():float{
            return $this->width;
        }
        public function getHeight():float{
            return $this->height;
        }
        public function getFormes():array{
            return $this->formes;
        }  

        public function add(Ligne|Cercle|Rectangle|Polygone $forme): void{
            $this->formes[] = $forme;
        }
    
}
