<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="cover-container d-flex p-3 mx-auto flex-column">

    <?php require APPROOT . '/views/inc/navbar.php' ?>

    <?php echo flash('article_message') ?>
    <div class="row text-white my-4">
        <div class="col-md-6">
            <h4>Articles</h2>
        </div>
        <div class="col-md-6 text-left">
            <a href="<?php echo URLROOT; ?>/articles/add" class="btn btn-light">
                Add Article
            </a>
        </div>
    </div>

    <?php foreach ($data['articles'] as $article) : ?>
        <div class="card mb-2">

            <div class="card-body">

                <h5 class="card-title"><?php echo $article->title ?></h5>

                <div class="bg-light mb-3 p-1">
                   Writed By
                    <?php echo $article->name ?>
                    At Date
                    <?php echo $article->articleCreated ?>
                </div>

                <p class="card-text">
                    <?php echo $article->body ?>
                </p>

                <a href="<?php echo URLROOT; ?>/articles/show/<?php echo $article->articleId ?>" class="btn btn-dark btn-block">Show</a>

            </div>

        </div>
    <?php endforeach ?>