<?php
session_start();
require_once('classes/Map.class.php');
require_once('classes/Ship.class.php');
require_once('classes/Asteroid.class.php');
require_once('init.php');

init();


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
