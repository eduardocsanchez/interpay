<?php

namespace App;

class RepositoryModel
{
    private static $conn;

    private static function getDBconn()
    {
        self::$conn = Connection::get();

        if (is_object(self::$conn)) return self::$conn;
        return false;
    }

    public static function getLastId($table)
    {
        self::$conn = self::getDBconn();

        if (is_object(self::$conn)) {

            $sql = 'SELECT id FROM ' . $table . ' ORDER BY id DESC LIMIT 1; ';

            $stmt = self::$conn->prepare($sql);

            if ($stmt->execute()) return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        return false;
    }

    public static function getAllDataByAuthorName($authorName)
    {
        self::$conn = self::getDBconn();

        if (is_object(self::$conn)) {

            $sql = 'SELECT a.name as authorName, b.name as bookName
            FROM tbl_author a INNER JOIN tbl_book b ON a.id = b.author_id';
            if (!empty($authorName)) {
                $sql .= ' WHERE a.name LIKE "%' . $authorName . '%"; ';
            }

            $stmt = self::$conn->prepare($sql);

            if ($stmt->execute()) return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        return false;
    }

    public static function getOneByName($table, $name)
    {
        self::$conn = self::getDBconn();

        if (is_object(self::$conn)) {

            $sql = 'SELECT * FROM ' . $table . ' WHERE name LIKE ? LIMIT 1';
            $param = array("%$name%");
            $stmt = self::$conn->prepare($sql);

            $stmt->bindParam(':name', $name);
            
            if ($stmt->execute($param)) return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        return false;
    }

    public static function getOneByColum($table, $column, $value)
    {
        self::$conn = self::getDBconn();

        if (is_object(self::$conn)) {

            $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $column . '=:value LIMIT 1';

            $stmt = self::$conn->prepare($sql);

            $stmt->bindParam(':value', $value);

            if ($stmt->execute()) return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        return false;
    }


    public static function storeData($table, $data)
    {
        self::$conn = self::getDBconn();

        if (is_object(self::$conn)) {

            $columns = '(';
            $params = '(';

            foreach ($data as $key => $value) {
                $columns .= $key . ',';
                $params .= ':' . $key . ',';
            }

            $columns = substr($columns, 0, -1);
            $params = substr($params, 0, -1);

            $columns .= ')';
            $params .= ')';


            $stmt = self::$conn->prepare('INSERT INTO ' . $table . $columns . ' VALUES ' . $params);

            foreach ($data as $key => $value) {
                $stmt->bindParam(':' . $key, $data[$key]);
            }
            if ($stmt->execute()) return self::$conn->lastInsertId();
        }

        return false;
    }

    public static function putData($table, $data, $id)
    {
        self::$conn = self::getDBconn();

        if (is_object(self::$conn)) {

            $set = '';

            foreach ($data as $key => $value) {
                $set .= $key . ' =:' . $key . ',';
            }

            $set = substr($set, 0, -1);

            $stmt = self::$conn->prepare('UPDATE ' . $table . ' SET ' . $set . ' WHERE id=:id');

            foreach ($data as $key => $value) {

                $stmt->bindParam(':' . $key, $data[$key]);
            }

            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) return true;
        }

        return false;
    }
}
