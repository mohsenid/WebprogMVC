<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">

    <?php require APPROOT . '/views/inc/navbar.php' ?>

    <div class="row">

        <div class="col-md-7 mx-auto">

            <div class="card">

                <div class="card-body">
                    <?php flash('register_success') ?>
                    <form action="<?php echo URLROOT; ?>users/login" method="post">

                        <div class="form-group">
                            <label for="email"> Email <sup>*</sup> </label>
                            <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"> <?php echo $data['email_err'] ?> </span>
                        </div>

                        <div class="form-group">
                            <label for="password"> Password <sup>*</sup> </label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                            <span class="invalid-feedback"> <?php echo $data['password_err'] ?> </span>
                        </div>

                        <div class="text-center my-4">
                            <button class="btn btn-dark" type="submit"> Login </button>
                        </div>

                        <div class="text-center my-4">
                            <p>
                                Not a member?‌
                                <a href="<?php echo URLROOT; ?>/users/register" class="text-muted"> Become a member </a>
                            </p>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <?php require APPROOT . '/views/inc/footer.php'; ?>