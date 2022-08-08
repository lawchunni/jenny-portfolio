<!doctype html>
<html lang="en">
<head>
    <title>JENNY's Portfolio | <?=$utils->esc($title)?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- favicon -->
    <link rel="icon" href="images/favicon.png" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="196x196" href="images/favicon-196.png" />
    <link rel="apple-touch-icon" sizes="192x192" href="images/favicon-192.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon-180.png" />
    <link rel="apple-touch-icon" sizes="167x167" href="images/favicon-167.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="images/favicon-152.png" />
    <link rel="apple-touch-icon" sizes="128x128" href="images/favicon-128.png" />
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" media="all" href="styles/styles.css" />
    <link rel="stylesheet" type="text/css" media="print" href="styles/print.css" />

    <?php if($title == 'My Skills') : ?>
        <style>
            #my_skills p {
                color: #fff;
            }
        </style>
    <?php endif; ?>
</head>


<body>
    <!-- Navigation menu with logo -->
    <header>
        <div class="wrapper">
        <!-- Logo -->
        <div id="logo">
            <a href="/" title="Home">
            <img src="images/logo.svg" alt="logo" width="116" height="42">
            </a>
        </div>
        <!-- Navigation menu -->
        <nav>
            <!-- hamburger icon: mobile only -->
            <a href="#" id="hamburger" title="hamburger icon">
            <span></span>
            <span></span>
            <span></span>
            </a>

            <!-- nav menu list: desktop only -->
            <ul> 
                <li>
                    <a class="<?=($utils->escAttr($title) == 'Home' ? 'active' : '')?>" href="/" title="Home">Home</a>
                </li>
                <li>
                    <a class="<?=($utils->escAttr($title) == 'Portfolio' ? 'active' : '')?>" href="/?p=portfolio" title="Portfolio">Portfolio</a>
                </li>
                <li>
                    <a class="<?=($utils->escAttr($title) == 'All Services' ? 'active' : '')?>" href="/?p=all-services" title="All Services">All Services</a>
                </li>
                <li>
                    <a class="<?=($utils->escAttr($title) == 'Contact Me' ? 'active' : '')?>" href="/?p=contact-me" title="Contact me">Contact Me</a>
                </li>

                <?php if(isset($_SESSION['is_admin'])) : ?>
                    <li><a href="/admin" title="Dashboard">Admin</a></li>
                <?php endif; ?>
            
            </ul>
        </nav>

        <?php if(empty($_SESSION['user_id'])) : ?>
            <!-- Register Button -->
            <a class="register_btn" href="/?p=register">Register</a>
            <!-- Login Button -->
            <a class="login_btn" href="/?p=login">Login</a>
        <?php else : ?>
            <!-- Profile Button -->
            <a class="profile_btn" href="/?p=profile">Profile</a>
            <!-- Logout Button -->
            <form action="/?p=process_logout" method="post">
                <input class="logout_btn" type="submit" name="logout" value="logout" />
            </form>
        <?php endif; ?>

        <!-- Search Box -->
        <?php include __DIR__ . '/search.inc.php'; ?>

        <!-- Shopping Cart -->
        <a class="icon cart" href="/?p=cart" title="Shopping Cart">
            <?php if(isset($_SESSION['cart'])) : ?>
                <span class="quentity"><?= $utils->esc(count($_SESSION['cart'])) ?></span>
            <?php endif; ?>
            <img src="images/icon-cart.svg" alt="Shopping Cart icon" width="30" height="30">
        </a>

        </div>
    </header>

    <?php include __DIR__ . '/flash.inc.php'; ?>
