<?php
namespace Core;



abstract class BaseModel
{
    protected $db;
    protected $errors;
    protected $table;
    protected $primKey;



    public function __construct()
    {
    $this->db = Db::instance();
    $this->errors = [];
    }


    public function all()
    {
        return $this->db->select("SELECT * FROM $this->table");
    }

    public function one($id)
    {

        $res = $this->db->select("SELECT * FROM $this->table WHERE $this->primKey=:id",
            ['id' => $id]);
        return $res[0] ?? false;

    }

    public function edit($id, $fields)
    {
        if (!$this->validation($fields)) {
            return false;
        } else {
            return $this->db->update($this->table, $fields, $this->primKey = $id);

        }
    }

    public function add($fields)
    {
        $this->validation($fields);

        if(!empty($this->errors)){
            return false;
        }

        return $this->db->insert($this->table, $fields);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, "$this->primKey=:id",[
            'id' => $id,
        ]);
    }
    public function errors(){
        return $this->errors;
    }

    protected function addError($text){
        $this->errors[] = $text;
    }

    protected abstract function validation($fields);
}
