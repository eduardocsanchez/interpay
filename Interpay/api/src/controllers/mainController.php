<?php

namespace App;

class MainController
{
    private $xmlPath;
    private $xmlArray;

    public function __construct($xmlArray, $xmlPath)
    {
        $this->xmlArray = $xmlArray;
        $this->xmlPath = $xmlPath;
    }

    public function get($key)
    {
        return $this->$key;
    }

    public function set($key, $value)
    {
        $this->{$key} = $value;
    }

    /*
    |--------------------------------------------------------------------------
    | APP - Registering/To Read Functions
    |--------------------------------------------------------------------------
    */
    public static function readXMLFile($propertiesDefinition = '')
    {

        if (!empty($propertiesDefinition) && strtolower(pathinfo($propertiesDefinition, PATHINFO_EXTENSION)) == 'xml') {
            $feed = file_get_contents($propertiesDefinition);
            $items = simplexml_load_string($feed);
            $return = Helpers::xml2array($items);
            if (count($return) > 0) {
                $return = Helpers::formatResponse(200, 'success', $return);
            } else $return = Helpers::formatResponse(404, 'Not Found', []);
        } else $return = Helpers::formatResponse(404, 'File Not Found', []);

        return $return;
    }

    public static function storeIntoAuthor($author_name)
    {
        $data = array();
        $return = array();

        if (isset($author_name) && !empty($author_name)) {
            $data['name'] = $author_name;
            $return = RepositoryController::storeData(authorClass::get('table_name'), $data);
            if (isset($return['status']) && $return['status'] == 200) {
                $return = $return['data'];
            } else $return = Helpers::formatResponse(401, 'Not found Author ID', []);
        }

        return $return;
    }

    public static function storeIntoBook($author_id, $book_name)
    {
        $data = array();
        $return = array();

        if (isset($author_id) && !empty($author_id) && isset($book_name) && !empty($book_name)) {

            $data['author_id'] = $author_id;
            $data['name'] = $book_name;
            $return = RepositoryController::storeData(bookClass::get('table_name'), $data);
            if (isset($return['status']) && $return['status'] == 200) {
                $return = $return['data'];
            } else $return = Helpers::formatResponse(401, 'Not found Data', []);
        }

        return $return;
    }

    public static function searchByAuthor($authorName)
    {
        $results = RepositoryController::searchAllDataByAuthrName($authorName);
        return $results;
    } 
}
