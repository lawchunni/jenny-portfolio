<!doctype html>
<html lang="en">
<head>
    <title>Admin Jenny | <?=$utils->esc($title)?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- favicon -->
    <link rel="icon" href="../images/favicon.png" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="196x196" href="../images/favicon-196.png" />
    <link rel="apple-touch-icon" sizes="192x192" href="../images/favicon-192.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="../images/favicon-180.png" />
    <link rel="apple-touch-icon" sizes="167x167" href="../images/favicon-167.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="../images/favicon-152.png" />
    <link rel="apple-touch-icon" sizes="128x128" href="../images/favicon-128.png" />
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" media="all" href="../styles/styles.css" />
    <link rel="stylesheet" type="text/css" media="print" href="../styles/print.css" />

</head>

<body id="admin">
    <!-- Navigation menu with logo -->
    <header>
        <div class="wrapper">

            <!-- Logo -->
            <div id="logo">
                <a href="/admin" title="Dashboard">
                <img src="../images/logo-admin.svg" alt="logo admin" width="116" height="42" />
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
                        <a class="<?=($utils->escAttr($title) == 'Dashboard' ? 'active' : '')?>" href="/admin" title="Dashboard">Dashboard</a>
                    </li>

                    <li>
                        <a class="<?=($utils->escAttr($title) == 'Categories' ? 'active' : '')?>" href="/admin?p=categories" title="Categories">Categories</a>
                    </li>

                    <li>
                        <a class="<?=($utils->escAttr($title) == 'Products' ? 'active' : '')?>" href="/admin?p=products" title="Products">Products</a>
                    </li>

                    <li>
                        <a class="<?=($utils->escAttr($title) == 'Orders' ? 'active' : '')?>" href="/admin?p=orders" title="Orders">Orders</a>
                    </li>

                    <li>
                        <a class="<?=($utils->escAttr($title) == 'Users' ? 'active' : '')?>" href="/admin?p=users" title="Users">Users</a>
                    </li>

                    <li>
                        <a class="<?=($utils->escAttr($title) == 'Logs' ? 'active' : '')?>" href="/admin?p=logs" title="Logs">Logs</a>
                    </li>
                </ul>
            </nav>

            <div class="static_site">
                <a href="/">Customer Site</a>
            </div>

            <!-- Logout button -->
            <form action="/?p=process_logout" method="post">
                <input class="logout_btn" type="submit" name="logout" value="logout" />
            </form>
            
        </div>
    </header>
   
    <?php include __DIR__ . '/../../inc/flash.inc.php'; ?>
