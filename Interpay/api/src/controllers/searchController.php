<?php

namespace App;

class SearchController
{
    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    */

    public static function index($authorName)
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

}
