<?php

session_start();

require_once('classes/Map.class.php');
require_once('classes/Ship.class.php');
require_once('classes/Asteroid.class.php');
require_once('classes/Player.class.php');
//require_once('init.php');

function init() {
    global $data;
    //Init session
    $data['map'] = new Map(array ('x' => 75, 'y' => 50));
    $data['player1'] = new Player(['name'=>'Le Hero']);
    $data['player2'] = new Player(['name'=>'Le Mechant']);

    // Set Entity
    $asteroid = new Asteroid();
    $ship1 = new Ship(array('name' => "First star", 'size' => NULL, 'SP' => 0, 'HP' => 10, 'PP' => 10, 'MP' => 15));
    $ship2 = new Ship(array('name' => "Evil star", 'size' => NULL, 'SP' => 0, 'HP' => 15, 'PP' => 10, 'MP' => 15));

    // Set Entity position;
    $data['map']->placeEntity(1, 0, 0, 0, $ship1);
    $data['map']->placeEntity(74, 49, 72, 48, $ship2);
    $data['map']->placeEntity(10, 15, 8, 13, $asteroid);

    //Add spaceship to player 1
    $data['player1']->addUnit($ship1);

    //Add spaceship to player 2
    $data['player2']->addUnit($ship2);
}

$data = array();
if (!isset($_SESSION['data']))
    init();
else
    $data = unserialize($_SESSION['data']);

if (isset($_GET["move"]))
    $data['map']->moveEntity($data['player2']->getUnits()[0],  $_GET["move"]);

if (isset($_GET["destroy"])) {
    session_destroy();
    header('Location: index.php');
}

$_SESSION['data'] = serialize($data);

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
    <a href="index.php?move=left"><button>MOVE LEFT</button></a>
    <a href="index.php?move=right"><button>MOVE RIGHT</button></a>
    <a href="index.php?move=up"><button>MOVE UP</button></a>
    <a href="index.php?move=down"><button>MOVE DOWN</button></a>
    <a href="index.php?destroy=yes"><button>SESSION DESTROY</button></a>
</header>
<section>
    <?php $data['map']->draw(); ?>
</section>
</body>
</html>
