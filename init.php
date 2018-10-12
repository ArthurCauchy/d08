<?php

function init() {
    global $data;
    //Init session
    $data['map'] = new Map(array ('x' => 75, 'y' => 50));
    $data['player1'] = new Player(['name'=>'Le Hero']);
    $data['player2'] = new Player(['name'=>'Le Mechant']);

    // Load basic sprite
    $sprite_blue = new Sprite(["img/ships/blue/00.png", "img/ships/blue/10.png", "img/ships/blue/20.png", "img/ships/blue/30.png", "img/ships/blue/40.png", "img/ships/blue/50.png",
        "img/ships/blue/01.png", "img/ships/blue/11.png", "img/ships/blue/21.png", "img/ships/blue/31.png", "img/ships/blue/41.png", "img/ships/blue/51.png"]);
    $sprite_red = new Sprite(["img/ships/red/00.png", "img/ships/red/10.png", "img/ships/red/20.png", "img/ships/red/30.png", "img/ships/red/40.png", "img/ships/red/50.png",
        "img/ships/red/01.png", "img/ships/red/11.png", "img/ships/red/21.png", "img/ships/red/31.png", "img/ships/red/41.png", "img/ships/red/51.png"]);

    // Set Entity
    $ship1 = new Ship(array('dmg' => 5, 'direction' => "right", 'name' => "First star", 'size' => NULL, 'sprite' => $sprite_blue, 'SP' => 0, 'HP' => 10, 'PP' => 10, 'MP' => 15));
    $ship2 = new Ship(array('dmg' => 8, 'direction' => "left", 'name' => "Evil star", 'size' => NULL, 'sprite' => $sprite_red, 'SP' => 0, 'HP' => 15, 'PP' => 10, 'MP' => 15));

    // Set Entity position;
    $data['map']->placeEntity(5, 49, 0, 48, $ship1);
    $data['map']->placeEntity(74, 49, 69, 48, $ship2);
    $data['map']->placeEntity(10, 15, 8, 13, new Asteroid());
    $data['map']->placeEntity(35, 18, 25, 8, new Asteroid());

    //Add spaceship to player 1
    $data['player1']->addUnit($ship1);

    //Add spaceship to player 2
    $data['player2']->addUnit($ship2);
}
