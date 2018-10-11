<?php

class Map {
    private $_xSize, $_ySize;
    //private $_entites;
    private $_grid;

    public function __construct($kwargs) {
        $this->_grid = array();
        for ($i = 0; $i < $kwargs["y"]; $i++) {
            $this->_grid[$i] = array_fill(0, $kwargs["x"], NULL);
        }
        $this->_xSize = $kwargs["x"];
        $this->_ySize = $kwargs["y"];
    }

    public function draw() {
        echo "<table>\n";
        for ($i = 0; $i < $this->_ySize; $i++) {
            echo "<tr>\n";
            for ($j = 0; $j < $this->_xSize; $j++) {
                if ($this->_grid[$i][$j] instanceof Asteroid)
                    echo "<td class=\"asteroid\"></td>\n";
                else if ($this->_grid[$i][$j] instanceof Ship && $this->_grid[$i][$j]->getPlayer() === 1)
                    echo "<td class=\"team1\"></td>\n";
                else if ($this->_grid[$i][$j] instanceof Ship && $this->_grid[$i][$j]->getPlayer() === 2)
                    echo "<td class=\"team2\"></td>\n";
                else
                    echo "<td></td>\n";
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
    }

    public function getEntityAt($x, $y) {
        return ($this->_grid[$y][$x]);
    }

    public function setEntityAt($x, $y, $entity) {
        $this->_grid[$y][$x] = $entity;
    }

    public function moveEntity($entity, $direction) {
        for ($i = 0; $i < $this->_ySize; $i++) {
            for ($j = 0; $j < $this->_xSize; $j++) {
                if ($this->_grid[$i][$j] instanceof $entity) {
                    if ($j > 1 && $direction === "left") {
                        if ($this->_grid[$i][$j - 1] === NULL) {
                            $this->_grid[$i][$j - 1] = $entity;
                            $this->_grid[$i][$j] = NULL;
                        }
                    }
                }
            }
        }
    }
}