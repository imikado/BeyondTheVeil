<?php

include('lib/Action.php');
include('lib/Project.php');

$oProject=new Project();

$oProject->addRoom('front', 'img/room.svg.png');
    $oProject->addRectArea(175, 20, 252, 115, new Action('loadRoom', 'front-miroir'));
    $oProject->addRectArea(160, 239, 132, 22, new Action('loadRoom', 'front-tiroir-gauche'));
    $oProject->addRectArea(313, 239, 132, 22, new Action('loadRoom', 'front-tiroir-droite'));

    $oProject->addLeftLinkTo('left');
    $oProject->addRightLinkTo('right');

        $oProject->addRoom('front-miroir', 'img/room-zoom-miroir.svg.png');
            $oProject->addBackLinkTo('front');

        $oProject->addRoom('front-tiroir-gauche', 'img/room-zoom-tiroirGauche.svg.png');
            $oProject->addBackLinkTo('front');

                $oProject->addRoom('front-tiroir-droite', 'img/room-zoom-tiroirDroite.svg.png');
                    $oProject->addBackLinkTo('front');


$oProject->addRoom('left', 'img/room-left.svg.png');
    $oProject->addLeftLinkTo('back');
    $oProject->addRightLinkTo('front');


$oProject->addRoom('back', 'img/room-back.svg.png');
    $oProject->addLeftLinkTo('right');
    $oProject->addRightLinkTo('left');

$oProject->addRoom('right', 'img/room-right.svg.png');
            $oProject->addLeftLinkTo('front');
            $oProject->addRightLinkTo('back');


/*
    $oProject->addItem('tiroirGauche', 'room-zoom-tiroirGauche.svg.png');
    $oProject->addItem('tiroirDroite', 'room-zoom-tiroirDroite.svg.png');
    $oProject->addItem('miroir', 'room-zoom-miroir.svg.png');


    $oProject->addLeftLinkTo('left');
    $oProject->addRightLinkTo('right');
*/

//$oProject->addRoom('right');
echo $oProject->build();
