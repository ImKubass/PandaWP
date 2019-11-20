<?php

use Components\ThemeSettings\ThemeSettingsFactory;
use Utils\Svg;

$Theme = ThemeSettingsFactory::create(); ?>

<?php if ($Theme->isSocials()) : ?>
    <div class="footer-social">
        <span><?php _e("Sledujte nás", "RLG_DOMAIN"); ?></span>

        <div>

            <?php if ($Theme->isSocialFacebook()) : ?>
                <a href="<?= $Theme->getSocialFacebook(); ?>">
                    <?= Svg::renderSvg("facebook"); ?>
                </a>
            <?php endif; ?>

            <?php if ($Theme->isSocialInstagram()) : ?>
                <a href="<?= $Theme->getSocialInstagram(); ?>">
                    <?= Svg::renderSvg("instagram"); ?>
                </a>
            <?php endif; ?>

            <?php if ($Theme->isSocialYoutube()) : ?>
                <a href="<?= $Theme->getSocialYoutube(); ?>">
                    <?= Svg::renderSvg("youtube"); ?>
                </a>
            <?php endif; ?>


        </div>
    </div>
<?php endif; ?>