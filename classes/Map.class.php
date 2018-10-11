<?php

class Map {
    private $_xSize, $_ySize;
    private $_grid;

    public function __construct($kwargs) {
        $this->_grid = array();
        for ($i = 0; $i < $kwargs["y"]; $i++) {
            $this->_grid[$i] = array_fill(0, $kwargs["x"], NULL);
        }
        $this->_xSize = $kwargs["x"];
        $this->_ySize = $kwargs["y"];
    }

    public function draw($players) {
        echo "<table>\n";
        for ($i = 0; $i < $this->_ySize; $i++) {
            echo "<tr>\n";
            for ($j = 0; $j < $this->_xSize; $j++) {
                if ($this->_grid[$i][$j] instanceof Asteroid)
                    echo "<td class=\"asteroid\"></td>\n";
                else if ($this->_grid[$i][$j] instanceof Ship) {
                    if (in_array($this->_grid[$i][$j], $players[0]->getUnits())) // TODO foreach on player then get the color directly from the Player instance
                        echo "<td class=\"team1\"></td>\n";
                    else
                        echo "<td class=\"team2\"></td>\n";
                }
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

    private function checkEntityMove($entity, $direction) {
        if ($direction === "left" || $direction === "up") {
            for ($i = 0; $i < $this->_ySize; $i++) {
                for ($j = 0; $j < $this->_xSize; $j++) {
                    if ($this->_grid[$i][$j] === $entity) {
                        if ($direction === "left") {
                            if ($j <= 0)
                                return (FALSE);
                            if ($this->_grid[$i][$j - 1] !== NULL && $this->_grid[$i][$j - 1] !== $entity)
                                return ($this->_grid[$i][$j - 1]);
                        }
                        if ($direction === "up") {
                            if ($i <= 0)
                                return (FALSE);
                            if ($this->_grid[$i - 1][$j] !== NULL && $this->_grid[$i - 1][$j] !== $entity)
                                return ($this->_grid[$i - 1][$j]);
                        }
                    }
                }
            }
        }
        else if ($direction === "right" || $direction === "down") {
            for ($i = $this->_ySize; $i >= 0; $i--) {
                for ($j = $this->_xSize; $j >= 0; $j--) {
                    if ($this->_grid[$i][$j] === $entity) {
                        if ($direction === "right") {
                            if (!($j < $this->_xSize - 1))
                                return (FALSE);
                            if ($this->_grid[$i][$j + 1] !== NULL && $this->_grid[$i][$j + 1] !== $entity)
                                return ($this->_grid[$i][$j + 1]);
                        }
                        if ($direction === "down") {
                            if (!($i < $this->_ySize - 1))
                                return (FALSE);
                            if ($this->_grid[$i + 1][$j] !== NULL && $this->_grid[$i + 1][$j] !== $entity)
                                return ($this->_grid[$i + 1][$j]);
                        }
                    }
                }
            }
        }
        return (NULL);
    }

    public function moveEntity($entity, $direction) {
        $check = $this->checkEntityMove($entity, $direction);
        if ($check !== NULL)
            return ($check);
        if ($direction === "left" || $direction === "up") {
            for ($i = 0; $i < $this->_ySize; $i++) {
                for ($j = 0; $j < $this->_xSize; $j++) {
                    if ($this->_grid[$i][$j] === $entity) {
                        if ($direction === "left") {
                            if ($j <= 0)
                                return (FALSE);
                            if ($this->_grid[$i][$j - 1] === NULL) {
                                $this->_grid[$i][$j - 1] = $entity;
                                $this->_grid[$i][$j] = NULL;
                            }
                            else
                                return ($this->_grid[$i][$j - 1]);
                        }
                        if ($direction === "up") {
                            if ($i <= 0)
                                return (FALSE);
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
            for ($i = $this->_ySize; $i >= 0; $i--) {
                for ($j = $this->_xSize; $j >= 0; $j--) {
                    if ($this->_grid[$i][$j] === $entity) {
                        if ($direction === "right") {
                            if (!($j < $this->_xSize - 1))
                                return (FALSE);
                            if ($this->_grid[$i][$j + 1] === NULL) {
                                $this->_grid[$i][$j + 1] = $entity;
                                $this->_grid[$i][$j] = NULL;
                            }
                            else
                                return ($this->_grid[$i][$j + 1]);
                        }
                        if ($direction === "down") {
                            if (!($i < $this->_ySize - 1))
                                return (FALSE);
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