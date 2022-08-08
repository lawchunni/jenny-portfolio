<?php include __DIR__ . '/inc/header.inc.php'; ?>

<!-- Section 1: Portfolio -->
<section id="portfolio">
    <div class="wrapper">

    <h1><?=$utils->esc($title)?></h1>

    <!-- Detect IE 8 -->
    <!--[if IE 8]>
        <p>You appear to be using an ancient Internet Explorer 8 browser. Upgrade to the most recent version to stay on trend ;)</p>
    <![endif]-->

    <!-- Portfolio thumbnail -->
    <div class="content">
        <div class="box" style="background-image: url(images/portfolio-01-thumbnail.jpg)">
        <a href="#portfolio01" title="View portfolio 01"></a>
        <span class="cover"></span>
        <span class="view">View</span>
        </div>

        <div class="box" style="background-image: url(images/portfolio-02-thumbnail.jpg)">
        <a href="#portfolio02" title="View portfolio 02"></a>
        <span class="cover"></span>
        <span class="view">View</span>
        </div>

    </div>
    </div>
</section>

<!-- Modal box -->
<div class="modal" id="portfolio01">
    <a class="layer" href="#modal-close" title="close"></a>
    <div class="modal-container">
    <a class="close-btn" href="#modal-close" title="close">X</a>
    <div class="modal-content">
        <img src="images/portfolio-01.jpg" alt="portfolio 01" width="700" height="1993">
    </div>
    </div>
</div>

<div class="modal" id="portfolio02">
    <a class="layer" href="#modal-close" title="close"></a>
    <div class="modal-container">
    <a class="close-btn" href="#modal-close" title="close">X</a>
    <div class="modal-content">
        <img src="images/portfolio-02.jpg" alt="portfolio 02" width="700" height="672">
    </div>
    </div>
</div>

<?php include __DIR__ . '/inc/footer.inc.php'; ?>