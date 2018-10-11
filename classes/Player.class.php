<?php
class Player
{
	private $_name; #name of player
	private $_units; #units available

	#Player = new Player(array('name' => NAME))
	public function __construct(array $kwargs)
	{
		$this->_name = $kwargs['name'];
		$this->_units = array();
	}
	public function add_unit(Ship $ship)
	{
		$this->_units[] = $ship;
	}
	public function remove_unit(Ship $remove)
	{
		$i = 0;
		while ($i <= count($this->_units))
		{
			if ($this->_units[$i] == $remove)
				unset($this->_units[$i]);
			$i++;
		}
	}
	public function has_lost()
	{
		if (count($this->_units))
			return FALSE;
		else
			return TRUE;
	}
	public function doc()
	{
		return (file_get_contents('doc/Player.doc.txt'));
	}
	public function getName()
	{
		return ($this->_name);
	}
	public function getUnits()
	{
		return ($this->_units);
	}
	public function __destruct()
	{
	}
}
?>
