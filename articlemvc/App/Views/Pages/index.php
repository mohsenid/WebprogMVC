<?php require APPROOT . '/Views/inc/header.php' ?>
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <?php require APPROOT . '/Views/inc/navbar.php' ?>
    <main role="main" class="text-center text-white" >
        <h2 class="mb-4" >Lorem ipsum dolor sit.</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum, deserunt nam ratione earum ad, obcaecati laborum nobis placeat totam nisi aliquam suscipit delectus magnam aspernatur impedit ut voluptatem molestiae pariatur!</p>
        <a href="<?php echo URLROOT; ?>articles/index" class="btn btn-secondary" >login</a>

    </main>
<!-- <h1> <?php echo $data['title'] ?> </h1> -->
<!-- /* Just for testing * -->
<!-- <ul>
    <?php foreach($data['articles'] as $article): ?>
        <li> <?php echo $article->title ?></li>
    <?php endforeach ?>
</ul>
<?php echo APPROOT ?> -->
<?php require APPROOT . '/Views/inc/footer.php' ?>