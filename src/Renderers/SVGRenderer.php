<?php

namespace Opmvpc\Formes\Renderers;

use Opmvpc\Formes\Canvas;
use Opmvpc\Formes\Rectangle;
use Opmvpc\Formes\Cercle;
use Opmvpc\Formes\Forme;
use Opmvpc\Formes\Ligne;
use Opmvpc\Formes\Polygone;
use PhpParser\Builder\Class_;
use SVG\Nodes\Shapes\SVGCircle;
use SVG\Nodes\Shapes\SVGLine;
use SVG\Nodes\Shapes\SVGPolygon;
use SVG\Nodes\Shapes\SVGRect;
use SVG\SVG;

class SVGRenderer implements Renderer
{
    private Canvas $canvas;

    public function __construct(Canvas $canvas)
    {
        $this->canvas = $canvas;
    }
    public function render(): string
    {
        $image = new SVG($this->canvas->getWidth(), $this->canvas->getHeight());
        $doc = $image->getDocument();

        $square = new SVGRect(0, 0, $this->canvas->getWidth(), $this->canvas->getHeight(), $this->canvas->getCouleur());
        $doc->setStyle('fill', $this->canvas->getCouleur());
        $doc->addChild($square);


        foreach ($this->canvas->getFormes() as $forme) {
            if (get_class($forme) === Rectangle::class) {
                $rect = new SVGRect($forme->getPoint()->getX(), $forme->getPoint()->getY(), $forme->getWidth(), $forme->getHeight());
                $rect->setStyle('fill', $forme->getCouleur());
                $doc->addChild($rect);
            } elseif (get_class($forme) === Cercle::class) {
                $cercl = new SVGCircle($forme->getCentre()->getX(), $forme->getCentre()->getY(), $forme->getRayon());
                $cercl->setStyle('fill', $forme->getCouleur());
                $doc->addChild($cercl);
            } elseif (get_class($forme) === Ligne::class) {
                $lign = new SVGLine($forme->getPoint1()->getX(), $forme->getPoint1()->getY(), $forme->getPoint2()->getX(), $forme->getPoint2()->getY());
                $lign->setStyle('fill', $forme->getCouleur());
                $doc->addChild($lign);
            } elseif (get_class($forme) === Polygone::class) {

                $points = $forme->getPoints();
                $arrayPoints = [];

                foreach ($points as $point) {
                    $arrayPoints[] = [$point->getX(), $point->getY()];
                }
                $polyg = new SVGPolygon($arrayPoints);
                $polyg -> setStyle('fill', $forme->getCouleur());
                $doc->addChild($polyg);
            }
        }


        return $image->toXMLString();
    }
    public function save(string $path): void
    {
        file_put_contents($path, $this->render());
    }
}
