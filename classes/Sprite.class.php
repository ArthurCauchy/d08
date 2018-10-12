<?php
class Sprite {
    private $_imgs;
    private $_xSize;
    private $_ySize;

    public function __construct($xSize, $ySize, $imgs) {
        $this->_xSize = $xSize;
        $this->_ySize = $ySize;
        $this->_imgs = $imgs;
    }

    public function getIdleSprite($x, $y) {
        for ($i = 0; $i < $y; $i++) {
            for ($j = 0; $j < $x; $j++) {
                return ($this->_imgs[$x + $y * $this->_ySize]);
            }
        }
    }
}