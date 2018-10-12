<?php

class Sprite {
    private $_imgs;
    private $_count;

    public function __construct($imgs) {
        $this->_imgs = $imgs;
        $this->_count = 0;
    }

    public static function doc() {
        return (file_get_contents('doc/Sprite.doc.txt'));
    }

    public function getIdleSprite() {
        $ret = $this->_imgs[$this->_count];
        $this->_count++;
        if (!isset($this->_imgs[$this->_count]))
            $this->_count = 0;
        return ($ret);
    }
}