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

	private $_baseMP; #movement points
    private $_currMP;

	public function __construct($kwargs)
	{
		$this->_dmg = $kwargs['dmg'];
		$this->_direction = $kwargs['direction'];
		$this->_name = $kwargs['name'];
        $this->_sprite = $kwargs['sprite'];
		$this->_baseSP = $kwargs['SP'];
		$this->_currHP = $this->_baseHP = $kwargs['HP'];
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
    public function getSprite()
    {
        return $this->_sprite;
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
