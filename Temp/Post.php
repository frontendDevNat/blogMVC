<?php

    include_once('Models/Articlesold.phpphp');
include_once('Models/Template.php');

    session_start();
    $auth = checkAuth();
    if(!$auth) {
    $_SESSION['redirectUrl'] = 'Post.php';
    header('Location: Login.php');
    exit();
    }
    $id_art = trim($_GET['id_art'] ?? '');

    $article = oneArticle($id_art);
    $title = $article['title'];
    $content = $article['content'];
    $author = $article['author'];

    if($article === false){
        $content = template('v_404');
    } else{
        $content = template('v_post', [
            'author' => $author,
            'title' => $title,
            'content' => $content,
        ]);
    }

    echo template('v_main', [
        'title' => 'Read the article',
        'content' => $content
    ]);
