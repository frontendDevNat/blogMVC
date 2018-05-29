<?php
session_start();
include_once 'autoload.php';
include_once 'config.php';

$paramsTmp = explode('/', $_GET['queryurl'] ?? '');
$params = [];

foreach ($paramsTmp as $par){
    if($par !== ''){
        $params[] = $par;
    }
}
$controller = ucfirst($params[0] ?? 'articles');
$action = 'action_' . ($params[1] ?? 'index');

$cname = "Controllers\\$controller";

if(!class_exists($cname)){
    $cname = "Controllers\\Pages";
    $action = 'action_404';
}

$c = new $cname();
$c->load($params);
$c->$action();
$html = $c->render();
echo $html;


/*$articles = articlesAll();

$content = template('v_index', [
    'articles' => $articles
]);
$title = template('v_headerIndex', [
    'articles' => $articles
]);*/





