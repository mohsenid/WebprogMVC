 
<nav class="masthead mb-auto" >
    <div>
        <a href="<?php echo URLROOT; ?>/pages/index">
            <h4 class="masthead-brand text-center text-white" >
                <?php echo SITENAME ; ?>
            </h4>
        </a>
        <nav class="nav nav-masthead justify-content-center">
            <?php if(isLoggedIn()) : ?>
                <a class="nav-link text-white"> <?php echo $_SESSION['user_name'] ?> </a>
                <a class="nav-link" href="<?php echo URLROOT; ?>users/logout"> Logout</a>
            <?php else : ?>
                <a class="nav-link <?php echo ($_GET['url'] == 'users/login') ? 'active' : '' ?> " href="<?php echo URLROOT; ?>users/login">Login</a>
                <a class="nav-link <?php echo ($_GET['url'] == 'users/register') ? 'active' : '' ?>" href="<?php echo URLROOT; ?>users/register">Register</a>
            <?php endif ?>
        </nav>
    </div>

</nav>