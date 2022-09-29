<?php

namespace App;

class RoutesController
{
    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    */

    public static function index($xmlPath)
    {
        $return = array();
        $results = array();
        $jsondata = file_get_contents('php://input');
        $dir_files = Helpers::getDirContents($xmlPath);

        foreach ($dir_files as $key => $xmlData) {
            if (Helpers::checkXMLExtension($xmlData)) {
                $result = MainController::readXMLFile($xmlData);
                if (isset($result['status']) && $result['status'] == 200) {
                    $results[] = $result['data'];
                    $return = Helpers::formatResponse(200, 'success', $results);
                } else {
                    $return = Helpers::formatResponse(404, $result['message'], []);
                }
            }
        }


        if (isset($return['status']) && $return['status'] == 200) {
            $arrayData = $return['data'];
            $authors = array();
            for ($i = 0; $i < count($arrayData); $i++) {
                foreach ($arrayData[$i] as $book => $value) {
                    for ($e = 0; $e < count($value); $e++) {
                        if (
                            isset($authors[(string)$value[$e]->author]) &&
                            !in_array((string)$value[$e]->author, $authors[(string)$value[$e]->author], TRUE)
                        ) {
                            $authors[(string)$value[$e]->author][] =  (string)$value[$e]->name;
                        } else {
                            $authors[(string)$value[$e]->author][] =  (string)$value[$e]->name;
                        }
                    }
                }
            }
            $return = self::unifyBooksByAuthor($authors);
        } else $return = Helpers::formatResponse(404, $return['message'], []);

        foreach ($return as $author => $books) {
            $authorId = self::storeAuthor($author);
            if ($authorId) {
                for ($f = 0; $f < count($books); $f++) {
                    self::storeBook($authorId, $books[$f]);
                }
            } else {
            }
        }

        print_r($return);
    }

    public static function unifyBooksByAuthor($arrayAuthors)
    {
        $return = array();

        foreach ($arrayAuthors as $author => $val) {
            $book = array();
            for ($j = 0; $j < count($val); $j++) {
                if (in_array($val[$j], $book, TRUE)) {
                    unset($arrayAuthors[$author][$j]);
                } else {
                    $book[] =  $arrayAuthors[$author][$j];
                }
            }
        }
        $return = array_map('array_values', $arrayAuthors);
        return $return;
    }



    public static function searchByAuthorName($authorName)
    {
        $return = array();
        $results = array();
        $jsondata = file_get_contents('php://input');
        if (empty($authorName)) {
            $authorName = '';
        }
        $json_results = MainController::searchByAuthor($authorName);

        echo json_encode($json_results);
    }
    /*
    |--------------------------------------------------------------------------
    | Save/Update/Delete Process
    |-------------------------------------------------------------------------
    */

    public static function storeAuthor($author_name)
    {
        return MainController::storeIntoAuthor($author_name);
    }

    public static function storeBook($author_id, $book_name)
    {
        return MainController::storeIntoBook($author_id, $book_name);
    }
}
