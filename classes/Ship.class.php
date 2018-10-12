<?php
require_once('Entity.class.php');
class Ship extends Entity
{
	private $_dmg; #to set in construct
	private $_direction; #to set in construct

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

	#Ship = new Ship(array('dmg' => DMG, 'direction' => ORIENTATION, 'name' => NAME, 'size' => array('x' => 1, 'y' => 2), 'SP' => 200, 'HP' => 200, 'PP' => 200, 'MP' => 3));
	public function __construct($kwargs)
	{
		$this->_dmg = $kwargs['dmg'];
		$this->_direction = $kwargs['direction'];
		$this->_name = $kwargs['name'];
		$this->_size = $kwargs['size'];
		$this->_baseSP = $kwargs['SP'];
		$this->_currHP = $this->_baseHP = $kwargs['HP'];
		$this->_basePP = $kwargs['PP'];
		$this->_baseMP = $kwargs['MP'];
	}
	public function takeDmg($dmg)
	{
		$this->_currSP = $this->_currSP - $dmg;
		if ($this->_currSP < 0)
		{
			$this->_currHP = $this->_currHP - abs($this->_currSP);
			$this->_currSP = 0;
		}
		if ($this->_currHP < 0)
			$this->_currHP = 0;
	}
	public function isDown()
	{
		if ($this->_currHP == 0)
			return TRUE;
		else
			return FALSE;
	}
	public function doc()
	{
		return (file_get_contents("doc/Ship.doc.txt"));
	}
	public function __destruct()
	{

	}
    /**
     * @param mixed $player
     */
    public function setPlayer($player)
    {
        $this->_player = $player;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->_size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->_size = $size;
    }

    /**
     * @return mixed
     */
    public function getCurrSP()
    {
        return $this->_currSP;
    }

    /**
     * @param mixed $currSP
     */
    public function setCurrSP($currSP)
    {
        $this->_currSP = $currSP;
    }

    /**
     * @return mixed
     */
    public function getCurrHP()
    {
        return $this->_currHP;
    }

    /**
     * @param mixed $currHP
     */
    public function setCurrHP($currHP)
    {
        $this->_currHP = $currHP;
    }

    /**
     * @return mixed
     */
    public function getCurrPP()
    {
        return $this->_currPP;
    }

    /**
     * @param mixed $currPP
     */
    public function setCurrPP($currPP)
    {
        $this->_currPP = $currPP;
    }

    /**
     * @return mixed
     */
    public function getCurrMP()
    {
        return $this->_currMP;
    }

    /**
     * @param mixed $currMP
     */
    public function setCurrMP($currMP)
    {
        $this->_currMP = $currMP;
    }
	public function getDmg()
	{
		return $this->_dmg;
	}
	public function getDirection()
	{
		return $this->_direction;
	}
}
