<?php
include_once('Models/Auth.php');
include_once('Models/Template.php');

session_start();
$msg = '';
$exit = $_GET['exit'] ?? '0';


if(count($_POST)>0){
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $remember = $_POST['remember'] ?? 'off';


    if($login == 'admin' && $password == 'qwerty'){
        $_SESSION['auth'] = true;

        if($remember == 'on'){
            setcookie('login', myHash($login), time()+3600*24*7);
            setcookie('password', myHash($password), time()+3600*24*7);
        }

        $url = $_SESSION['redirectUrl'] = 'index.php';
        unset($_SESSION['redirectUrl']);
        header("Location: $url");
        exit();
    }else{
        $msg = 'It is incorrect values';
    }
}
$content = template('v_login', [
    'msg' => $msg
]);

echo template('v_main', [
    'title' => 'authorization',
    'content' => $content
]);
