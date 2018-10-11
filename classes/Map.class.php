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
                else if ($this->_grid[$i][$j] instanceof Ship) // TODO TMP
                    echo "<td class=\"team1\"></td>\n";
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

    public function placeEntity($x1, $y1, $x2, $y2, $entity) {
        for ($i = $y2; $i <= $y1; $i++) {
            for ($j = $x2; $j <= $x1; $j++) {
                $this->_grid[$i][$j] = $entity;
            }
        }
    }

    public function moveEntity($entity, $direction) {
        if ($direction === "left" || $direction === "up") {
            for ($i = 0; $i < $this->_ySize; $i++) {
                for ($j = 0; $j < $this->_xSize; $j++) {
                    if ($this->_grid[$i][$j] instanceof $entity) {
                        if ($j > 0 && $direction === "left") {
                            if ($this->_grid[$i][$j - 1] === NULL) {
                                $this->_grid[$i][$j - 1] = $entity;
                                $this->_grid[$i][$j] = NULL;
                            }
                            else
                                return ($this->_grid[$i][$j - 1]);
                        }
                        if ($i > 0 && $direction === "up") {
                            if ($this->_grid[$i - 1][$j] === NULL) {
                                $this->_grid[$i - 1][$j] = $entity;
                                $this->_grid[$i][$j] = NULL;
                            }
                            else
                                return ($this->_grid[$i - 1][$j]);
                        }
                    }
                }
            }
        }
        else if ($direction === "right" || $direction === "down") {
            for ($i = $this->_ySize; $i > 0; $i--) {
                for ($j = $this->_xSize; $j > 0; $j--) {
                    if ($this->_grid[$i][$j] instanceof $entity) {
                        if ($j < $this->_xSize && $direction === "right") {
                            if ($this->_grid[$i][$j + 1] === NULL) {
                                $this->_grid[$i][$j + 1] = $entity;
                                $this->_grid[$i][$j] = NULL;
                            }
                            else
                                return ($this->_grid[$i][$j + 1]);
                        }
                        if ($i < $this->_ySize && $direction === "down") {
                            if ($this->_grid[$i + 1][$j] === NULL) {
                                $this->_grid[$i + 1][$j] = $entity;
                                $this->_grid[$i][$j] = NULL;
                            }
                            else
                                return ($this->_grid[$i + 1][$j]);
                        }
                    }
                }
            }
        }
        return (NULL);
    }
}