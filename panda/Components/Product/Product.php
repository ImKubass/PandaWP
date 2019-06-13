<?php
use Components\Product\ProductFactory;
use Components\SchemaGenerator\SchemaGenerator;
use Components\ProductsPosition\ProductsPosition;

$Product = ProductFactory::create();
$ProductModel = $Product->getModel();
$ColSizeClass = ProductsPosition::getProductColSize();

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
            <?php if ($ProductModel->hasThumbnail()) : ?>
                <img src="" data-src="<?= $Product->getThumbnailSrc(); ?>" srcset="" data-srcset="<?= $Product->getThumbnailSrc(); ?>, <?= $Product->getThumbnailSrc2x(); ?>" alt="<?= $Product->title(); ?>">
                <noscript>
                    <img src="<?= $Product->getThumbnailSrc(); ?>" alt="<?= $Product->title(); ?>">
                </noscript>
            <?php endif; ?>
        </div>

        <h2 class="product-title article-heading"><?= $Product->title(); ?></h2>

        <?php if ($Product->getModel()->hasExcerpt()) : ?>
            <p><?= $Product->getModel()->getExcerpt(); ?></p>
        <?php endif; ?>

        <?php if ($ProductModel->isParams()) : ?>
            <table class="product-specs">

                <?php if ($ProductModel->isParamsPower()) : ?>
                    <tr>
                        <td><img src="" data-src="<?= get_template_directory_uri(); ?>/images/ico/dashboard-primary.svg" alt=""> <?php _e("Regulovaný výkon:", "RLG_DOMAIN"); ?></td>
                        <td><?= $ProductModel->getParamsControlledPower(); ?></td>
                    </tr>
                <?php endif; ?>

                <?php if ($ProductModel->isParamsWoodConsumption()) : ?>
                    <tr>
                        <td><img src="" data-src="<?= get_template_directory_uri(); ?>/images/ico/flame-primary.svg" alt=""> <?php _e("Spotřeba dřeva:", "RLG_DOMAIN"); ?></td>
                        <td><?= $ProductModel->getParamsWoodConsumption(); ?></td>
                    </tr>
                <?php endif; ?>

                <?php if ($ProductModel->isParamsConsumptionEfficiency()) : ?>
                    <tr>
                        <td><img src="" data-src="<?= get_template_directory_uri(); ?>/images/ico/bar-chart-primary.svg" alt=""><?php _e("Účinnost spalování:", "RLG_DOMAIN"); ?></td>
                        <td><?= $ProductModel->getParamsConsumptionEfficiency(); ?></td>
                    </tr>
                <?php endif; ?>

            </table>
        <?php endif; ?>

        <?php if ($ProductModel->isPriceBasicPrice()) : ?>
            <div class="product-price">
                <span><?= $ProductModel->getPriceBasicPriceFancy(); ?></span>
                <small><?php _e("vč. DPH", "RLG_DOMAIN"); ?></small>
            </div>
        <?php endif; ?>

        <div class="product-button">
            <span class="btn btn-arrow">
                <span><?php _e("Prohlédnout detail", "RLG_DOMAIN"); ?></span>
            </span>
        </div>

    </a>
</article>