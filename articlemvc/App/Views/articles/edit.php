<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">

    <?php require APPROOT . '/views/inc/navbar.php' ?>

    <div class="row">

        <div class="col-md-7 mx-auto">

            <div class="card">

                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <h5>Edit Article</h3>
                        <a href="<?php echo URLROOT; ?>/articles/index" class="btn btn-dark btn-sm" >
                            Return
                        </a>
                        
                    </div>
                    <hr class="mt-0">
                    <form action="<?php echo URLROOT; ?>/articles/edit/<?php echo $data['id'] ?>" method="post">

                        <div class="form-group">
                            <label for="title"> Title of Article <sup>*</sup> </label>
                            <input type="title" name="title" class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                            <span class="invalid-feedback"> <?php echo $data['title_err'] ?> </span>
                        </div>

                        <div class="form-group">
                            <label for="body"> Text of Article <sup>*</sup> </label>
                            <textarea type="body" name="body" rows="6" class="form-control <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"> <?php echo $data['body']; ?> </textarea>
                            <span class="invalid-feedback"> <?php echo $data['body_err'] ?> </span>
                        </div>

                        <div class="text-center my-4">
                            <button class="btn btn-dark" type="submit"> Edit </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>


    <?php require APPROOT . '/views/inc/footer.php'; ?>