<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=$root?>Assets/Css/style.css">
    <title><?=$title?></title>
    </head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="<?=$root?>Assets/Images/logo.png" alt="">
                </a>
            <form class="form-inline">
                <? if($user === null): ?>
                <a href="<?=$root?>auth/login">
                <input class="btn btn-warning my-2 my-sm-0 mr-3" type="button" name="login" data-toggle="modal" data-target="#Log In" value="Log In" >
            </a>
                <? else: ?>
                <a href="<?=$root?>auth/logout">
                    <input class="btn btn-warning my-2 my-sm-0 mr-3" type="button" value="Log out" >
                </a>
                <? endif;?>
                <a href="<?=$root?>articles/add"><input class="btn btn-warning my-2 my-sm-0" type="button" value="Add article"></a>
            </form>
            </div>
        </nav>
    <h1><?=$title?></h1>
</header>
<main>
    <?=$content?>
</main>
<footer class="main__footer">

    &copy; <?=date('Y')?>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>