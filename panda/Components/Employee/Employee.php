<?php
use Components\Employee\EmployeeFactory;

$Employee = EmployeeFactory::create();
$Employee->tryAddPersonJsonLdData(); ?>

<div class="employee col-sm-6 col-md-4 col-lg-3">
    <div class="employee-img">
        <img src="" data-src="<?= $Employee->getThumbnailSrc(); ?>" alt="<?= $Employee->getTitle(); ?>">
        <noscript>
            <img src="<?= $Employee->getThumbnailSrc(); ?>" alt="<?= $Employee->getTitle(); ?>">
        </noscript>
    </div>

    <h3 class="employee-name article-heading"><?= $Employee->getTitle(); ?></h3>

    <?php if ($Employee->isParamJob()) : ?>
        <div class="employee-title"><?= $Employee->getParamJob(); ?></div>
    <?php endif; ?>

    <div>

        <?php if ($Employee->isParamPhone()) : ?>
            <div class="employee-contact employee-tel d-none d-sm-block">
                <img src="" data-src="<?= get_template_directory_uri(); ?>/images/ico/phone-primary.svg" alt="">
                <span><?= $Employee->getParamPhoneFancy(); ?></span>
            </div>

            <a class="employee-contact employee-tel d-sm-none" href="tel:<?= $Employee->getParamPhoneClean(); ?>">
                <img src="" data-src="<?= get_template_directory_uri(); ?>/images/ico/phone-primary.svg" alt="">
                <span><?= $Employee->getParamPhoneFancy(); ?></span>
            </a>
        <?php endif; ?>

        <?php if ($Employee->isParamEmail()) : ?>
            <a class="employee-contact employee-email" href="mailto:<?= $Employee->getParamEmail(); ?>">
                <img src="" data-src="<?= get_template_directory_uri(); ?>/images/ico/mail-primary.svg" alt="">
                <span><?= $Employee->getParamEmail(); ?></span>
            </a>
        <?php endif; ?>

    </div>


    <p class="employee-text"><?= $Employee->getContentClean(); ?></p>

</div>