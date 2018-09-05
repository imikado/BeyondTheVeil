<?php

include('lib/Action.php');
include('lib/Project.php');

$oProject=new Project();

$oProject->addRoom('front', 'img/room.svg.png');
    $oProject->addRectArea(175, 20, 252, 115, new Action('link', 'room-miroir'));
    $oProject->addRectArea(160, 239, 132, 22, new Action('link', 'room-tiroir-gauche'));
    $oProject->addRectArea(313, 239, 132, 22, new Action('link', 'room-tiroir-droite'));

    $oProject->addLeftLinkTo('left');
    $oProject->addRightLinkTo('right');

$oProject->addRoom('front-miroir', 'room-miroir.svg.png');
    $oProject->addBackLinkTo('front');

$oProject->addRoom('front-tiroir-gauche', 'room-tiroir-gauche.svg.png');
    $oProject->addBackLinkTo('front');



/*
    $oProject->addItem('tiroirGauche', 'room-zoom-tiroirGauche.svg.png');
    $oProject->addItem('tiroirDroite', 'room-zoom-tiroirDroite.svg.png');
    $oProject->addItem('miroir', 'room-zoom-miroir.svg.png');


    $oProject->addLeftLinkTo('left');
    $oProject->addRightLinkTo('right');
*/

//$oProject->addRoom('right');
echo $oProject->build();
