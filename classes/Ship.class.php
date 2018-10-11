<?php
require_once('Entity.class.php');
class Ship extends Entity
{
	private $_player; #owner of the ship

	private $_name; #ship name
	private $_size; #ship size [x, y]
	private $_sprite; #link to sprite

	private $_baseSP; #shield points
	private $_currSP;

	private $_baseHP; #health points
	private $_currHP;

	private $_basePP; #power points
	private $_currPP;

	private $_baseMP; #movement points
	private $_currMP;

	#Ship = new Ship(array('player' => PLAYER_NAME, 'name' => NAME, 'size' => array('x' => 1, 'y' => 2), 'SP' => 200, 'HP' => 200, 'PP' => 200, 'MP' => 3));
	public function __construct(array $kwargs)
	{
		$_name = $kwargs['name'];
		$_size = $kwargs['size'];
		$_baseSP = $kwargs['SP'];
		$_baseHP = $kwargs['HP'];
		$_basePP = $kwargs['PP'];
		$_baseMP = $kwargs['MP'];
	}
	public function doc()
	{
		return (file_get_contents("doc/Ship.doc.txt"));
	}
	public function __destruct()
	{
	
	}
}
?>
