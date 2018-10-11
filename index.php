<?php

require_once('classes/Map.class.php');
require_once('classes/Ship.class.php');
require_once('classes/Asteroid.class.php');

$map = new Map(["x"=>75, "y"=>50]);

$asteroid = new Asteroid();

$ship = new Ship(array('player' => 1, 'name' => "First star", 'size' => NULL, 'SP' => 0, 'HP' => 10, 'PP' => 10, 'MP' => 15));
$ship2 = new Ship(array('player' => 2, 'name' => "Evil star", 'size' => NULL, 'SP' => 0, 'HP' => 15, 'PP' => 10, 'MP' => 15));

$map->setEntityAt(10, 15, $asteroid);
$map->setEntityAt(0, 0, $ship);
$map->setEntityAt(1, 0, $ship);

$map->setEntityAt(74, 49, $ship2);
$map->setEntityAt(73, 49, $ship2);
$map->setEntityAt(72, 49, $ship2);
$map->setEntityAt(74, 48, $ship2);
$map->setEntityAt(73, 48, $ship2);
$map->setEntityAt(72, 48, $ship2);

if (isset($_GET["move"]))
    $map->moveEntity($ship2,  "left");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Awesome Battleships Battles</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<header>
    <audio controls loop>
        <source src="music/through_space.ogg" type="audio/ogg">
    </audio>
    <a href="index.php?move=1"><button>MOVE LEFT</button></a>
</header>
<section>
    <?php $map->draw(); ?>
</section>
</body>
</html>