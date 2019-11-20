<?php

use Components\ThemeSettings\ThemeSettingsFactory;
use Utils\Svg;

$Theme = ThemeSettingsFactory::create();

?>

<?php if ($Theme->isSocials()) : ?>
    <div class="header-social">
        <ul>
            <?php if ($Theme->isSocialYouTube()) : ?>
                <li>
                    <a href="<?= $Theme->getSocialYouTube(); ?>" target="_blank">
                        <?= Svg::renderSvg("youtube"); ?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($Theme->isSocialFacebook()) : ?>
                <li>
                    <a href="<?= $Theme->getSocialFacebook(); ?>" target="_blank">
                        <?= Svg::renderSvg("facebook"); ?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($Theme->isSocialInstagram()) : ?>
                <li>
                    <a href="<?= $Theme->getSocialInstagram(); ?>" target="_blank">
                        <?= Svg::renderSvg("instagram"); ?>
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </div>
<?php endif; ?>