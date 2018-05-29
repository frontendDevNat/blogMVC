    <section class="main">
        <div class="container">
            <form method="post" class="add__article mb-3">
                <div class="form-group">
                    <label >Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title of the article" value="<?= $fields['title']; ?>">
                </div>
                <div class="form-group">
                    <label >Author</label>
                    <input type="text" name="author" class="form-control" placeholder="Author's name" value="<?= $fields['author']; ?>">
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control content" name="content" rows="12" placeholder="Content"><?= $fields['content']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-success" ">Submit</button>
                <? foreach($errors as $err): ?>
                    <p><?=$err?></p>
                <? endforeach; ?>

            </form>
            <div class="button">
                <a href="<?=$root?>"><input class="btn btn-info my-2 my-sm-0 mr-2" type="button" value="Return in main page"></a>

            </div>
        </div>
    </section>