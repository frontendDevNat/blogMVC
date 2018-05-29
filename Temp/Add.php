<?php

namespace Controllers;

use Models\Articlesold;
use Models\Template;

class Add{

}

session_start();
$auth = checkAuth();

if(!$auth) {
    $_SESSION['redirectUrl'] = 'Add.php';
    header('Location: Login.php');
    exit();
}
if (count($_POST) > 0) {

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $author = trim($_POST['author']);
        if(addArticle($title, $content, $author)){
            header('Location: index.php');
            exit();
        }else{
            $msg = messagesLastError();
        }

}else{
    $title = '';
    $content = '';
    $author = '';
    $msg = '';
}
$content = template('v_add', [
    'author' => $author,
    'title' => $title,
    'content' => $content,
    'msg' => $msg
]);

echo template('v_main', [
    'title' => 'Add an article',
    'content' => $content
]);

