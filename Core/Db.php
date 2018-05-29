<?php

namespace Core;

use \PDO as PDO;

class Db
{
    protected static $instance;
    protected  $db;

    public static function instance(){
        if(self::$instance == null){
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct()
    {

        $this->db = new PDO('mysql:host=localhost;dbname=blog', 'root', '', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        $this->db->exec('SET NAMES UTF8');
    }

    public function query($sql, $params = [])
    {
        $query = $this->db->prepare($sql);
        $query->execute($params);
        $this->checkError($query);
        return $query;
    }

    public function lastId(){
        return $this->db->lastInsertId();
    }
    public function select($sql, $params = []){
        return $this->query($sql, $params)->fetchAll();
    }

    public function insert($table, $data){
        $keys = [];
        $masks = [];

        foreach($data as $key => $value){
            $keys[] = $key;
            $masks[] = ":$key";
        }

        $keyStr = implode(', ', $keys);
        $valuesStr = implode(', ', $masks);

        $sql = "INSERT INTO $table ($keyStr) VALUES ($valuesStr)";

        $this->query($sql, $data);

        return $this->db->lastInsertId();
    }

    public function delete($table, $where, $whereParams = [], $limit = 1)
    {
        $masks = ":$where";

        $sql = "DELETE FROM $table WHERE $where = $masks LIMIT $limit";
        //echo $sql;
        $this->query($sql, $whereParams);
        return true;

    }
    public function update($table, $data, $where, $whereParams = []){
        $keys = [];
        $masks = [];

        foreach($data as $key => $value){
            $keys[] = $key;
            $masks[] = ":$key";
        }
        $whereMasks = ":$where";
        $pairs = [];

        foreach($data as $key => $value){
            $pairs[] = "$key = :$key";
        }

        $pairsStr = implode(', ', $pairs);

        $sql = "UPDATE $table SET $pairsStr WHERE $where = $whereMasks";

        $params = array_merge($data, $whereParams);

        $query = $this->query($sql, $params);
        return $query->rowCount();
    }


    protected function checkError($query)
    {
        $info = $query->errorInfo();
        if ($info[0] != PDO::ERR_NONE) {
            exit($info[2]);
        }
    }
}


