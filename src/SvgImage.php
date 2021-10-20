<?php

namespace LKSS;

use SVG\SVG;
use SVG\Nodes\Shapes\SVGRect;

/**
 * Description of SvgImage
 *
 * @author porfirovskiy
 */
class SvgImage {
    
    public function create(StorageTree $tree): string
    {
        if (!is_null($tree->getRoot())) {
            
            

        // image with 100x100 viewport
        $image = new SVG(1000, 1000);
        $doc = $image->getDocument();

        // blue 40x40 square at (0, 0)
        $square = new SVGRect(0, 0, 100, 50);
        $square->setStyle('stroke', '#0073e5')
        ->setStyle('fill', '#FFFFFF')
        ->setStyle('stroke-width', '2px');
        $doc->addChild($square);
        
        $svgText = new \SVG\Nodes\Texts\SVGText('fff', 10, 30);
        $svgText->setStyle('fill', '#000000');
        $doc->addChild($svgText);

        return $image;

            
            $circleRadius = 10;

            $beginSvgString = '<svg id="field" width="1500" height="1500" xmlns="http://www.w3.org/2000/svg">
                <rect width="100%" height="100%" fill="white" />';
            
            $svgString = '<g><rect x="0" y="0" rx="10" ry="10" width="100" height="50"
  style="fill:red;stroke:black;stroke-width:2;opacity:0.5" />';
            $svgString .= '<text x="0" y="50" font-size="16" text-anchor="middle" fill="black">'
                    . $tree->getRoot()->getName() .'</text></g>';
            
//            $svgString = '<g>
//    <rect x="0" y="0" width="100" height="100" fill="red"></rect>
//    <text x="0" y="50" font-family="Verdana" font-size="35" fill="blue">Hello</text>
//  </g>';

            $nodes = $tree->getAllNodesWithBranches($tree->getRoot());
            //echo '<pre>';var_dump($nodes);die();

            $svgString .= '<g><title>'. $tree->getRoot()->getData() .'</title>'
                    .'<circle id="333" cx="'. $tree->getRoot()->getX() .'" cy="'. $tree->getRoot()->getY() 
                    .'" r="'. $circleRadius .'" fill="green"/></g>';
            $svgString .= '<text x="'. $tree->getRoot()->getX() + 50 .'" y="'
                    . $tree->getRoot()->getY() + 5 .'" font-size="16" text-anchor="middle" fill="black">'
                    . $tree->getRoot()->getName() .'</text>';

            foreach ($nodes as $fullNode) {
                $currentNodes = $fullNode['nodes'];
                foreach ($currentNodes as $node) {
                    $svgString .=  '<line x1="'. $fullNode['parentCoordinates'][0] .'" x2="'. $node->getX() 
                            .'" y1="'. $fullNode['parentCoordinates'][1] + $circleRadius .'" y2="'. $node->getY() .'" stroke="orange" fill="transparent" stroke-width="1"/>';
                    $svgString .= '<g><title>'. $node->getData() .'</title>'
                            .'<circle cx="'. $node->getX() .'" cy="'. $node->getY() .'" r="'. $circleRadius .'" fill="green"/></g>';
                    $svgString .= '<text x="'. $node->getX() + 50 .'" y="'. $node->getY() + 5 .'" font-size="16" text-anchor="middle" fill="black">'
                        . $node->getName() .'</text>';
                }
            }

            $endSvgString = '</svg>';

            return  $beginSvgString . $svgString . $endSvgString;
        } else {
            return 'root is empty';
        }
    }
    
}
