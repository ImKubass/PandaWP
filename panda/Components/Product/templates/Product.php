<?php

use Components\Product\ProductFactory;
use Components\SchemaGenerator\SchemaGenerator;

$Product = ProductFactory::create();
$ProductModel = $Product->getModel();

SchemaGenerator::addItem([
    "@type" => "ListItem",
    "position" => $Counter,
    "url" => $Product->permaLink(),
    "name" => $Product->title(),
]);

?>


<article class="product col-sm-6 col-lg-<?= $ColSizeClass; ?>">
    <a href="<?= $Product->permaLink(); ?>">

        <div class="product-img">
            <?php if ($ProductModel->hasThumbnail()) { ?>
                <img src="" data-src="<?= $Product->getThumbnailSrc(); ?>" srcset="" data-srcset="<?= $Product->getThumbnailSrc(); ?>, <?= $Product->getThumbnailSrc2x(); ?>" alt="<?= $Product->title(); ?>">
                <noscript>
                    <img src="<?= $Product->getThumbnailSrc(); ?>" alt="<?= $Product->title(); ?>">
                </noscript>
            <?php } ?>
        </div>

        <h2 class="product-title article-heading"><?= $Product->title(); ?></h2>

        <?php if ($Product->getModel()->hasExcerpt()) { ?>
            <p><?= $Product->getModel()->getExcerpt(); ?></p>
        <?php } ?>


    </a>
</article>
