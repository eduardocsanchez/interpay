<?php

namespace App;

use Exception;

class Helpers
{
    public static $models = ['tbl_author', 'tbl_book'];

    public static function validModel($model)
    {
        return in_array(strtolower($model), self::$models);
    }

    public static function xml2array($xmlObject, $out = array())
    {
        foreach ((array) $xmlObject as $index => $node)
            $out[$index] = (is_object($node)) ? self::xml2array($node) : $node;

        return $out;
    }

    public static function getDirContents($dir, &$results = array())
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                if (self::checkXMLExtension($path)) {
                    $results[] = $path;
                }
            } else if ($value != "." && $value != "..") {
                self::getDirContents($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }

    public static function checkXMLExtension($path = '')
    {
        $return = false;
        $file_parts = pathinfo($path);
        if (isset($file_parts['extension']) && strtolower($file_parts['extension']) == 'xml') {
            $return = true;
        }
        return $return;
    }

    public static function dye($value)
    {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
        exit(1);
    }

    public static function formatResponse($status, $message, $data = [])
    {
        return [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
    }
}
