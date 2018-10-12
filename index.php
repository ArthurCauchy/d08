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

if (isset($_GET["destroy"])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

if (isset($_GET["move"])) {
    if ($data['turn']['player']->getUnits()[0]->getCurrMp() > 0) {
        $ret = $data['map']->moveEntity($data['turn']['player']->getUnits()[0], $_GET["move"]);
        $data['turn']['player']->getUnits()[0]->useMp(1);
        if ($ret instanceof Entity) {
            $ship = $data['turn']['player']->getUnits()[0];
            $data['turn']['player']->removeUnit($ship);
            $data['map']->removeEntity($ship);
            if ($data['turn']['player']->hasLost())
                header('Location: index.php?destroy=yes');
        }
    }
}

else if (isset($_GET["shoot"])) {
    $data['map']->shoot($data['turn']['player']->getUnits()[0]);
}

else if (isset($_GET["shield"])) {
	$data['turn']['player']->getUnits()[0]->setCurrSP($data['turn']['player']->getUnits()[0]->getCurrSP + 5);

}

if (isset($_GET["endTurn"])) {
    if ($data['turn']['player'] == $data['player1'])
        $data['turn'] = ['player' => $data['player2'], 'phase' => 'movement'];
    else
        $data['turn'] = ['player' => $data['player1'], 'phase' => 'movement'];
}

else if (isset($_GET["endPhase"]) && $data['turn']['phase'] === 'movement')
	$data['turn']['phase'] = 'action';

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
	<h1><?php echo $data['turn']['player']->getName(); ?></h1>
    <?php

    if ($data['turn']['phase'] === "movement")
        echo "<h2>Movement phase - <span class=\"movement\">" . $data['turn']['player']->getUnits()[0]->getCurrMP() . " MP</span></h2>\n";
    else if ($data['turn']['phase'] === "action")
        echo "<h2>Action phase</h2>\n";
    ?>
    <div style="width:100%; float:left">
        <div style="width:50%; display:inline-block;">
            <h3><?php echo $data['player1']->getName(); ?></h3>
            <h3><span class="health">Heath : <?php echo $data['player2']->getUnits()[0]->getCurrHP(); ?></span> | <span class="shield">Shield : <?php echo $data['turn']['player']->getUnits()[0]->getCurrSP(); ?></span></h3>
        </div>
        <div style="width:50%; float:right">
            <h3><?php echo $data['player2']->getName(); ?></h3>
            <h3><span class="health">Heath : <?php echo $data['player1']->getUnits()[0]->getCurrHP(); ?></span> | <span class="shield">Shield : <?php echo $data['turn']['player']->getUnits()[0]->getCurrSP(); ?></span></h3>
        </div>
    </div>
	<?php
		if ($data['turn']['phase'] === "movement") {
			echo "<a href=\"index.php?move=left\"><button>MOVE LEFT</button></a>\n";
			echo "<a href=\"index.php?move=right\"><button>MOVE RIGHT</button></a>\n";
			echo "<a href=\"index.php?move=up\"><button>MOVE UP</button></a>\n";
			echo "<a href=\"index.php?move=down\"><button>MOVE DOWN</button></a>\n";
			echo "<a href=\"index.php?endPhase=yes\"><button>END PHASE</button></a>\n";
		}
		else {
			echo "<a href=\"index.php?shield=yes\"><button>SHIELD</button></a>\n";
			echo "<a href=\"index.php?shoot=yes\"><button>SHOOT</button></a>\n";
			echo "<a href=\"index.php?endTurn=yes\"><button>END TURN</button></a>\n";
		}
	?>
	<a href="index.php?destroy=yes"><button>RESTART GAME</button></a>
</header>
<section>
    <?php $data['map']->draw(); ?>
</section>
</body>
</html>
