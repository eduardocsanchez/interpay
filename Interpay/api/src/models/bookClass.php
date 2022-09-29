<?php

namespace App;

class bookClass
{
    private static $table_name = 'tbl_book';
    private static $id;
    private static $author_id;
    private static $name;
    private static $created_date;

    public static function get($key)
    {
        return self::${$key};
    }
}
