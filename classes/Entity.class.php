<?php

abstract class Entity {
    public static function doc() {
        return (file_get_contents('doc/Entity.doc.txt'));
    }
}
