<?php

function init() {
    global $data;
    //Init session
    $data['map'] = new Map(array ('x' => 75, 'y' => 50));
    $data['player1'] = new Player(['name'=>'Le Hero']);
    $data['player2'] = new Player(['name'=>'Le Mechant']);

    // Set Entity
    $ship1 = new Ship(array('name' => "First star", 'size' => NULL, 'SP' => 0, 'HP' => 10, 'PP' => 10, 'MP' => 15));
    $ship2 = new Ship(array('name' => "Evil star", 'size' => NULL, 'SP' => 0, 'HP' => 15, 'PP' => 10, 'MP' => 15));

    // Set Entity position;
    $data['map']->placeEntity(1, 0, 0, 0, $ship1);
    $data['map']->placeEntity(74, 49, 71, 48, $ship2);
    $data['map']->placeEntity(10, 15, 8, 13, new Asteroid());
    $data['map']->placeEntity(35, 18, 25, 8, new Asteroid());

    //Add spaceship to player 1
    $data['player1']->addUnit($ship1);

    //Add spaceship to player 2
    $data['player2']->addUnit($ship2);
}