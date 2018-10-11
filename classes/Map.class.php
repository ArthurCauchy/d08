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
                if ($this->_grid[$i][$j] !== NULL)
                    echo "<td class=\"asteroid\"></td>\n";
                else
                    echo "<td></td>\n";
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
    }

    public function setEntityAt($x, $y, $entity) {
        $this->_grid[$y][$x] = $entity;
    }
}