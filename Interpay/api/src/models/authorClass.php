<?php

namespace App;

class authorClass
{
    private static $table_name = 'tbl_author';
    private static $id;
    private static $name;
    private static $created_date;

    public static function get($key)
    {
        return self::${$key};
    }
}
