

    <!--<a href="login.php">Log in</a>
    <a href="add.php">Write</a>-->
    <section class="main">
        <div class="container">
            <div class="row">

                <hr>
                <? foreach ($articles as $article): ?>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-8 border-dark mb-3">
                        <div class="card">
                            <img class="card-img-top mw-50" src="Assets/Images/photo-1.jpg" alt="Card image cap">
                            <div class="card-header h3"><?=$article['title']?></div>
                            <div class="card-body text-dark">
                                <h4 class="card-title"><?=$article['author']?></h4>
                                <p class="card-text"><?=$article['content']?></p>
                                <a href ="<?=$root?>articles/one/<?=$article['id_art']?>"> <button type='button' class='btn btn-outline-success'>Read</button></a>
                                <a href ="<?=$root?>articles/edit/<?=$article['id_art']?>"><button type='button' class='btn btn-outline-success'>Edit</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3"></div>
                <? endforeach; ?>

            </div>
        </div>

        <div>
            <a href="<?=$root?>articles/?view=table">В виде таблицы</a>
        </div>

    </section>


