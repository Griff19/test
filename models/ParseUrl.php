<?php

class ParseUrl
{
    public static function urlKeyValue($url)
    {

        $query = parse_url($url);
        if (array_key_exists('query', $query)) {
            $values = explode('&', $query['query']);

            $arr = [];
            foreach ($values as $value) {
                $key_value = explode('=', $value);
                $arr[$key_value[0]] = $key_value[1];
            }
            return $arr;
        }
    }

    public static function urlValues($url)
    {
        $query = parse_url($url);
        if (array_key_exists('query', $query)) {
            $values = explode('&', $query['query']);

            $arr = [];
            foreach ($values as $value) {
                $key_value = explode('=', $value);
                $arr[] = $key_value[1];
            }
            return $arr;
        }
    }
}