<?php

class Asteroid extends Entity {
    public static function doc() {
        return (file_get_contents('doc/Asteroid.doc.txt'));
    }
}
