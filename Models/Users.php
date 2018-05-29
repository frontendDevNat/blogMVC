<?php

namespace Models;

use Core\Auth;
use Core\BaseModel;

class Users extends BaseModel
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
        $this->table = 'users';
        $this->primKey = 'id_user';
    }

    public function getByLogin($login)
    {
        $res = $this->db->select("SELECT * FROM $this->table WHERE login=:login",
            ['login' => $login]);
        return $res[0] ?? false;
    }

    public function getByAuth()
    {
        $token = Auth::getToken();
        $mSession = new Sessions();

        if (!$token) {
            return false;
        }

        $session = $mSession->getByToken($token);

        if (!$session) {
            Auth::removeToken();
            return false;
        }

        return $this->one($session['id_user']);
    }

    protected function validation($fields)
    {

    }
}