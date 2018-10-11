<?php
session_start();

function init(){

	if (isset ($_SESSION['on']))
		return;

	//Init session
	$_SESSION['on'] = "the war has begun";
	$_SESSION['map'] = new Map(array ('x' => 75, 'y' => 75));
	$_SESSION['player1'] = new Player('Le Hero');
	$_SESSION['player2'] = new Player('Le Mechant');

	// Set Entity
	$asteroid = new Asteroid();
	$ship1 = new Ship(array('name' => "First star", 'size' => NULL, 'SP' => 0, 'HP' => 10, 'PP' => 10, 'MP' => 15));
	$ship2 = new Ship(array('name' => "Evil star", 'size' => NULL, 'SP' => 0, 'HP' => 15, 'PP' => 10, 'MP' => 15));

	// Set Entity position;
	$_SESSION['map']->placeEntityAt(1, 0, 0, 0, $ship1);
	$_SESSION['map']->placeEntityAt(74, 49, 72, 48, $ship2);
	$_SESSION['map']->placeEntityAt(10, 15, 8, 13, $asteroid);

	//Add spaceship to player 1
	$_SESSION['player1']->addUnit($ship1);

	//Add spaceship to player 2
	$_SESSION['player2']->addUnit($ship2);

}

?>
