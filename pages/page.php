<?php 
use Utils\Util;
use Components\Page\PageFactory;

$Page = PageFactory::create();

Util::getHeader();
?>

<div class="container container-narrow">
    <section class="entry-content">
        <h1><?= $Page->getTitle(); ?></h1>

        <?= $Page->getContent(); ?>

    </section>
</div>

<?php Util::getFooter(); ?> 