<?php

namespace App\Helpers;

class ClassHelper
{

    /**
     * @param $object
     * @return string
     */
    public static function getBaseFromObject($object): string {
        $class = explode( "\\", get_class($object));
        return end($class);
    }
}
