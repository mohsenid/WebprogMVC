<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="cover-container d-flex p-3 mx-auto flex-column">

    <?php require APPROOT . '/views/inc/navbar.php' ?>

    <div class="card my-5">

        <div class="card-body">

            <div class="d-flex justify-content-between">
                <h5>Article number <?php echo $data['article']->id ?></h3>
                    <a href="<?php echo URLROOT; ?>/articles/index" class="btn btn-dark btn-sm">
                        Return
                    </a>
            </div>

            <hr class="mt-0">

            <h5 class="card-title"><?php echo $data['article']->title ?></h5>

            <div class="bg-light mb-3 p-1">
                Writed By
                <?php echo $data['user']->name ?>
                At
                <?php echo $data['article']->created_at ?>
            </div>

            <p class="card-text">
                <?php echo $data['article']->body ?>
            </p>

            <?php if ($data['article']->user_id == $_SESSION['user_id']) : ?>
                <hr>

                <div class="d-flex justify-content-between">

                    <a href="<?php echo URLROOT; ?>/articles/edit/<?php echo $data['article']->id ?>" class="btn btn-dark">Edit</a>

                    <form action="<?php echo URLROOT; ?>/articles/delete/<?php echo $data['article']->id ?>" method="POST">
                        <button class="btn btn-light" type="submit">Delete</button>
                    </form>

                </div>
            <?php endif ?>

        </div>

    </div>