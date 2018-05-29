<?php
    include_once('Models/Articlesold.phpphp');
    include_once('Models/Auth.php');
    include_once('Models/Template.php');


    session_start();

    $auth = checkAuth();
    if(!$auth) {
        $_SESSION['redirectUrl'] = 'Edit.php';
        header('Location: Login.php');
        exit();
    }
    $id_art = trim($_GET['id_art'] ?? '');
    $msg = '';

    if (count($_POST) > 0) {

        if (isset($_POST['save'])) {
            $title = strip_tags(trim($_POST['title']));
            $content = strip_tags(trim($_POST['content']));
            $author = strip_tags(trim($_POST['author']));

            if (editArticle($id_art, $title, $content, $author)){
                header('Location: index.php');
                exit();
            } else {
                $msg = messagesLastError();
            }
        } else {
            $msg = 'An article with this title has already been in our list!';
        }
    } elseif (isset($_POST['delete'])) {
        if (deleteArticle($id_art)) {
            header('Location: index.php');
            exit();
        }
        $msg = 'Something was wrong, try again';

    } elseif (count($_GET) > 0) {

        $article = oneArticle($id_art);
        $title = $article['title'];
        $content = $article['content'];
        $author = $article['author'];

    if ($article === false) {
        $msg = '404-error';
    }
}

    $content = template('v_edit', [
        'author' => $author,
        'title' => $title,
        'content' => $content,
        'msg' => $msg
    ]);

    echo template('v_main', [
        'title' => 'Edit/Delete the article',
        'content' => $content
    ]);







