<?php

namespace Core;


 class Auth
 {
     public static function isAuth(){
         $auth = $_SESSION['auth'] ?? false;

         if(!$auth){

             if(isset($_COOKIE['login']) && isset($_COOKIE['password'])
                 && $_COOKIE['login'] == self::myHash('admin') &&
                 $_COOKIE['password'] == self::myHash('qwerty')){
                 $_SESSION['auth'] = true;
                 $auth = true;
             }

         } return $auth;
     }

     public static function login($login, $password, $remember)
     {
         if ($login == 'admin' && $password == 'qwerty') {
             $_SESSION['auth'] = true;

             if ($remember == 'on') {
                 setcookie('login', self::myHash($login), time() + 3600 * 24 * 7, '/');
                 setcookie('password', self::myHash($password), time() + 3600 * 24 * 7, '/');
             }

             return true;
         }
         return false;
     }

     public static function getUser()
     {
         return self::isAuth() ?
             [
                 'id_user' => '1',
                 'login' => 'admin',
                 'pass' => 'hash'
             ] :
             null;
     }

     public static function myHash($str)
     {
         $salt = 'dlask56';
         return hash('sha256', $str . $salt);
     }

     public static function logout(){
         $_SESSION['auth'] = false;
         setcookie('login', '', time() + 1, '/');
         setcookie('password', '', time() + 1, '/');
     }
 }


