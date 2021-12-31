<?php


namespace App\Helpers;


class ArrayHelper
{
    public static function ObjectToArray($obj)
    {
        if (is_object($obj)) {
            $obj = (array)$obj;
        }

        if (is_array($obj)) {
            $new = array();
            foreach ($obj as $key => $val) {
                $new[$key] = self::ObjectToArray($val);
            }
        } else {
            $new = $obj;
        }

        return $new;
    }

    public static function ArrayToObject($arr)
    {
        if (is_array($arr)) {
            $new = [];
            foreach ($arr as $key => $val) {
                $new[$key] = self::ArrayToObject($val);
            }
            $new = (object)$new;
        } else {
            $new = $arr;
        }

        return $new;
    }


    public static function Combinations($options)
    {
        $combinations = [[]];

        for ($count = 0; $count < count($options); $count++) {
            $tmp = [];
            foreach ($combinations as $v1) {
                foreach ($options[$count] as $v2) {
                    $tmp[] = array_merge($v1, [$v2]);
                }
            }
            $combinations = $tmp;
        }

        return $combinations;
    }
}
