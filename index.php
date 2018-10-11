<?php

require_once('classes/Map.class.php');

$map = new Map(["x"=>150, "y"=>100]);

$map->setEntityAt(10, 15, 1);

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
</header>
<section>
    <?php $map->draw(); ?>
</section>
</body>
</html>