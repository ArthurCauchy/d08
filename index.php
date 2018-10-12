<?php

session_start();

require_once('classes/Map.class.php');
require_once('classes/Sprite.class.php');
require_once('classes/Ship.class.php');
require_once('classes/Asteroid.class.php');
require_once('classes/Player.class.php');
require_once('init.php');

$data = array();
if (!isset($_SESSION['data']))
    init();
else
    $data = unserialize($_SESSION['data']);

if (isset($_GET["move"]))
    $data['map']->moveEntity($data['player1']->getUnits()[0],  $_GET["move"]);

if (isset($_GET["destroy"])) {
    session_destroy();
    header('Location: index.php');
    exit;
}
if (isset($_GET["shoot"])) {
    $data['map']->shoot($data['player1']->getUnits()[0]);
}

if (isset($_GET["unshoot"])) {
    $data['map']->unshoot();
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
    <a href="index.php?move=left"><button>MOVE LEFT</button></a>
    <a href="index.php?move=right"><button>MOVE RIGHT</button></a>
    <a href="index.php?move=up"><button>MOVE UP</button></a>
    <a href="index.php?move=down"><button>MOVE DOWN</button></a>
	<a href="index.php?shoot=yes"><button>SHOOT</button></a>
    <a href="index.php?destroy=yes"><button>RESTART GAME</button></a>
</header>
<section>
    <?php $data['map']->draw(); ?>
</section>
</body>
</html>
