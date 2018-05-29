<?php
namespace Models;


use Core\Db;

class Articlesold
{
    protected $db;
    protected $lastError;
    protected static $instance;

    public static function instance(){
        if(self::$instance == null){
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct()
    {
    $this->db = Db::instance();
    $this->lastError = '';
    }


    public function all()
    {
        $query = $this->db->query("SELECT * FROM articles ORDER BY author DESC");
        return $query->fetchAll();
    }

    public function one($id_art)
    {

        $query = $this->db->query("SELECT `title`, `content`, `author` FROM `articles` WHERE `id_art` = :id_art", [
            'id_art' => $id_art]);

        return $query->fetch();

    }

    public function edit($id_art, $title, $content, $author)
    {
        if (!$this->validation($title, $content, $author)) {
            return false;
        }
        else {
            $this->db->update('articles', ['title' => '' , 'content' => '', 'author'=> ''],  'id_art', [
                'id_art' => $id_art,
                'title' => $title,
                'content' => $content,
                'author' => $author
            ]);

            /*$this->db->query("UPDATE `articles` SET `title` = :title, `content` = :content, `author` = :author WHERE `id_art` = :id_art", [
                'id_art' => $id_art,
                'title' => $title,
                'content' => $content,
                'author' => $author
            ]);*/
        }

        return true;
    }

    public function add($title, $content, $author)
    {

        if (!$this->validation($title, $content, $author)) {
            return false;
        } else {
            $this->db->query("INSERT INTO articles (title, content, author) VALUES(:title, :content, :author)", [
                'title' => $title,
                'content' => $content,
                'author' => $author
            ]);
        }
        return $this->db->lastId();
    }

    public function delete($id_art)
    {
        $this->db->delete('articles', 'id_art', [
            'id_art' => $id_art
        ]);

        /*$this->db->query("DELETE FROM `articles` WHERE `id_art` = :id_art LIMIT 1", [
            'id_art' => $id_art,
        ]);*/

        return true;
    }
    public function lastError()
    {
        return $this->lastError;

    }

    protected function validation($title, $content, $author)
    {
        $error = true;

        if ($title == '' || $content == '' || $author == '') {
            $this->lastError = 'Input all fields of the article';
        } elseif (mb_strlen($title, 'UTF8') > 56) {
            $this->lastError = 'A name of the article does not have to be more 56 symbols';
        } elseif (mb_strlen($author, 'UTF8') > 32) {
            $this->lastError = ' An author\'s name does not have to be more 32 symbols';
        } elseif (mb_strlen($content, 'UTF8') < 248) {
            $this->lastError = 'A content of the article does not have to be the least 248 symbols';
        } elseif (mb_strlen($content, 'UTF8') > 5600) {
            $this->lastError = 'A content of the article does not have to be more 5600 symbols';
        } else {
            $error = false;
        }
        return !$error;
    }
}
