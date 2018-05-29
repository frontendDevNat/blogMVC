<?php
namespace Models;


use Core\Db;
use Core\BaseModel;

class Articles extends BaseModel
{
    protected static $instance;

    public static function instance(){
        if(self::$instance == null){
            self::$instance = new self();
        }

        return self::$instance;
    }
    protected function __construct()
    {
        parent::__construct();
        $this->table = 'articles';
        $this->primKey = 'id_art';
    }

    protected function validation($fields)
    {
        $error = true;

        if ($fields['title'] == '' || $fields['content'] == '' || $fields['author'] == '') {
            $this->addError('Input all fields of the article');
        } elseif (mb_strlen($fields['title'], 'UTF8') > 56) {
            $this->addError('A name of the article does not have to be more 56 symbols');
        } elseif (mb_strlen($fields['author'], 'UTF8') > 32) {
            $this->addError('An author\'s name does not have to be more 32 symbols');
        } elseif (mb_strlen($fields['content'], 'UTF8') < 248) {
            $this->addError('A content of the article does not have to be the least 248 symbols');
        } elseif (mb_strlen($fields['content'], 'UTF8') > 5600) {
            $this->addError('A content of the article does not have to be more 5600 symbols');
        } else {
            $error = false;
        }
        return !$error;
    }
}



