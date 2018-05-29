<?php

namespace Controllers;

use Core\Auth;

class Client extends Base{

    protected $title;
    protected $author;
    protected $content;
    protected $user;


    public function __construct(){
        parent::__construct();

        $this->title = '';
        $this->author = '';
        $this->content = '';
        $this->user = Auth::getUser();
        $this->templateBuilder->addGlobal('root', ROOT);
}

    public function render(){
        return $this->template('v_main', [
            'title' => $this->title,
            'author'=> $this->author,
            'content' => $this->content,
            'user' => $this->user
        ]);
    }
    public function page404()
    {
        $this->title = 'Страница не найдена';
        $this->content = $this->template('v_404');
    }
}