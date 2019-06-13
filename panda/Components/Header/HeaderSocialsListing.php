<?php 
use Utils\Util;
use Components\PageTheme\PageThemeFactory;

$Theme = PageThemeFactory::create();

?>

<?php if ($Theme->isSocials()) : ?>
<div class="header-social">
    <ul>
        <?php if ($Theme->isSocialYouTube()) : ?>
        <li>
            <a href="<?= $Theme->getSocialYouTube(); ?>" target="_blank">
                <?= Util::renderSvg("youtube"); ?>
            </a>
        </li>
        <?php endif; ?>

        <?php if ($Theme->isSocialFacebook()) : ?>
        <li>
            <a href="<?= $Theme->getSocialFacebook(); ?>" target="_blank">
                <?= Util::renderSvg("facebook"); ?>
            </a>
        </li>
        <?php endif; ?>

        <?php if ($Theme->isSocialInstagram()) : ?>
        <li>
            <a href="<?= $Theme->getSocialInstagram(); ?>" target="_blank">
                <?= Util::renderSvg("instagram"); ?>
            </a>
        </li>
        <?php endif; ?>

    </ul>
</div>
<?php endif; ?> 