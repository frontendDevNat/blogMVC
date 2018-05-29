
<form method="post">
    <div>
        <div>Author</div>
        <input type="text" name="author" value="<?=$author;?>">
    </div>
    <div>
        <div>Title</div>
        <input type="text" name="title" value="<?=$title;?>">
    </div>
    <div>
        <div>Content</div>
        <textarea  name="content" value="{$content}"><?=$content;?></textarea>
    </div>
    <button name="save">Edit</button>
    <button name="delete">Delete</button>
    <div>
        <a href="<?=$root?>articles/index">Return in main page</a>
    </div>
    <?=$msg;?>
</form>

