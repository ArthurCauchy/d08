<?php

require_once('Entity.class.php');

class Ship extends Entity
{
	private $_dmg; #to set in construct
	private $_direction; #to set in construct

	private $_name; #ship name
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
		$this->_currSP = $this->_baseSP = $kwargs['SP'];
		$this->_currHP = $this->_baseHP = $kwargs['HP'];
        $this->_currMP = $this->_baseMP = $kwargs['MP'];
	}

	public static function doc() {
		return (file_get_contents("doc/Ship.doc.txt"));
	}

    public function getName() {
        return $this->_name;
    }

    public function getSprite() {
        return $this->_sprite;
    }

    public function getCurrSP() {
        return $this->_currSP;
    }

    public function getCurrHP() {
        return $this->_currHP;
    }

    public function getDmg() {
        return $this->_dmg;
    }

    public function getDirection() {
        return $this->_direction;
    }

    public function isDown() {
        if ($this->_currHP == 0)
            return TRUE;
        else
            return FALSE;
    }

    public function addSP($value) {
        $this->_currSP += $value;
    }

    public function takeDmg($dmg) {
        $this->_currSP = $this->_currSP - $dmg;
        if ($this->_currSP < 0)
        {
            $this->_currHP = $this->_currHP - abs($this->_currSP);
            $this->_currSP = 0;
        }
        if ($this->_currHP < 0)
            $this->_currHP = 0;
    }

    public function useMp($amount) {
        $this->_currMP -= $amount;
    }

    public function getCurrMP() {
        return $this->_currMP;
    }

    public function resetMP() {
        $this->_currMP = $this->_baseMP;
    }
}
