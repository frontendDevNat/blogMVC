<?php
namespace Controllers;


use Models\Articles as Model;

class Articles extends Client
{

    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = Model::instance();
    }

    public function action_add()
    {
        //$this->redirectIfNotAuth();
        if (count($_POST) > 0) {
            $fields = [];
            $fields['title'] = trim($_POST['title']);
            $fields['content'] = trim($_POST['content']);
            $fields['author'] = trim($_POST['author']);


            $id = $this->model->add($fields);

            if ($id === false) {
                $errors = $this->model->errors();
            } else {
                header('Location: ' . ROOT . 'articles/one/' . $id);
                exit();
            }

        } else {
            $fields = ['title' => '', 'content' => '', 'author' => ''];
            $errors = [];
            /*$arTitle = '';
            $arContent = '';
            $arAuthor = '';
            $msg = '';*/
        }

        $this->title = 'Add an article';

        $this->content = $this->template('v_add', [
            'fields' => $fields,
            'errors' => $errors
            /*'author' => $arAuthor,
            'title' => $arTitle,
            'content' => $arContent,
            'msg' => $msg*/
        ]);


    }

    public function action_index()
    {

        $articles = $this->model->all();
        $templateName = (($_GET['view'] ?? '') == 'table') ? 'v_table' : 'v_index';

        $this->title = $this->template('v_headerIndex', [
            'articles' => $articles
        ]);

        $this->content = $this->template($templateName, [
            'articles' => $articles
        ]);
        //$this->title = '';
        //$this->author = '';
        //$this->content = '';

    }

    public function action_one()
    {
        $id_art = $this->params[2] ?? '';


        $article = $this->model->one($id_art);
        $this->title = $article['title'];
        $this->content = $article['content'];
        $this->author = $article['author'];

        if ($article === false) {
            $this->page404();
           return;
        } else {
            $this->title = 'Read the article';
            $this->content = $this->template('v_post', [
                'author' => $this->author,
                'title' => $this->title,
                'content' => $this->content,
            ]);
        }
    }

    public function action_edit()
    {

        $id_art = (int)$this->params[2];
        $msg = '';

        $article = $this->model->one($id_art);
        $this->title = $article['title'];
        $this->content = $article['content'];
        $this->author = $article['author'];

        if ($article === false) {
            $this->page404();
            return;
        } else {

            if (isset($_POST['save'])) {

                $arTitle = strip_tags(trim($_POST['title']));
                $arContent = strip_tags(trim($_POST['content']));
                $arAuthor = strip_tags(trim($_POST['author']));

                $ed = $this->model->edit($id_art, $arTitle, $arContent, $arAuthor);


                if ($ed === true) {

                    header('Location: ' . ROOT . 'articles/one/' . $id_art);
                    exit();
                } else {
                    $msg = $this->model->lastError();
                }
            } elseif (isset($_POST['delete'])) {
                $del = $this->model->delete($id_art);

                if ($del === true) {
                    header('Location:' . ROOT);
                    exit();
                }
                $msg = 'Something was wrong, try again';
            }


        }
        $this->title = 'Edit the article';
        $this->content = $this->template('v_edit', [
            'author' => $this->author,
            'title' => $this->title,
            'content' => $this->content,
            'msg' => $msg
        ]);

    }

}