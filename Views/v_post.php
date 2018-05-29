<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BlogMVC</title>

</head>
<body>
<article>
    <h3>Title: <?=$title;?></h3>
    <h4>Author: <?=$author?></h4>
    <p><?=$content?></p>
</article>
<hr>
<div>
    <a href="<?=$root?>">Return in main page</a>
</div>


</body>
</html>