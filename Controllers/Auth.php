<?php
namespace Controllers;

use Core\Auth as Model;

class Auth extends Client{

    public function action_login(){
        if(count($_POST)>0){
            if(Model::login(trim($_POST['login']), trim($_POST['password']), isset($_POST['remember']))){
                header('Location:' . ROOT);
                exit();
            }
            $msg = 'Error of log in';
        }else{
            $msg = '';
        }

        $this->title = "Log in";
        $this->content = $this->template('v_login',[
            'msg' => $msg
        ]);
    }

    public function action_logout(){
        Model::logout();
        header('Location: ' . ROOT );
        exit();

    }

    public function checkAuth(){

    }
}