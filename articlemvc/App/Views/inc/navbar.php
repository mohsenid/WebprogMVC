<nav class="masthead mb-auto" >
    <div>
        <a href="<?php echo URLROOT; ?>/pages/index">
            <h4 class="masthead-brand text-center text-white" >
                <?php echo SITENAME ; ?>
            </h4>
        </a>
        <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link <?php echo ($_GET['url'] == 'users/login') ? 'active' : '' ?> " href="<?php echo URLROOT; ?>users/login">Login</a>
            <a class="nav-link <?php echo ($_GET['url'] == 'users/register') ? 'active' : '' ?>" href="<?php echo URLROOT; ?>users/register">Register</a>
        </nav>
    </div>

</nav>