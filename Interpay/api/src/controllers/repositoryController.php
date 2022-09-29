<?php

namespace App;

class RepositoryController
{

    public static function searchAllDataByAuthrName($authorName)
    {
        $result = RepositoryModel::getAllDataByAuthorName($authorName);
        if (is_array($result)) {
            if (count($result) == 0) $return = Helpers::formatResponse(204, 'No content', $result);
            if (count($result) > 0) $return = Helpers::formatResponse(200, 'success', $result);
        } else $return = Helpers::formatResponse(403, 'Not Found', []);

        return $return;
    }

    public static function storeData($table, $data)
    {
        if (Helpers::validModel($table)) {

            $result = RepositoryModel::getOneByName($table, $data['name']);

            if (isset($result['id'])) {
                $author = $result['id'];
            }else{
                $author = RepositoryModel::storeData($table, $data);
            }
            if ($author) {
                $return = Helpers::formatResponse(200, 'success', $author);
            } else $return = Helpers::formatResponse(401, 'Process was not sucesfully', []);
        } else {
            $return = Helpers::formatResponse(401, 'Insert was not sucesfully', []);
        }


        return $return;
    }

}
