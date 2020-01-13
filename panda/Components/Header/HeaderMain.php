<?php

use Components\ThemeSettings\ThemeSettingsFactory;
use Utils\Svg;

$Theme = ThemeSettingsFactory::create(); ?>

<header class="header-main">

    <?php if ($Theme->isContactPhone() || $Theme->isContactEmail()) : ?>
        <div class="container header-top-bar">

            <span><?php _e("Potřebujete poradit?", "RLG_DOMAIN"); ?></span>

            <?php if ($Theme->isContactPhone()) : ?>
                <span class="header-contact header-contact-phone">
                    <img src="" data-src="<?= get_template_directory_uri(); ?>/images/ico/phone-primary.svg" alt="phone icon">
                    <span><?= $Theme->getContactPhoneFancy(); ?></span>
                </span>
            <?php endif; ?>

            <?php if ($Theme->isContactEmail()) : ?>
                <a class="header-contact header-contact-mail" href="mailto:<?= $Theme->getContactEmail(); ?>">
                    <img src="" data-src="<?= get_template_directory_uri(); ?>/images/ico/mail-primary.svg" alt="mail icon">
                    <span><?= $Theme->getContactEmailFancy(); ?></span>
                </a>
            <?php endif; ?>

        </div>
    <?php endif; ?>

    <div class="container">


        <nav class="nav-main">
            <ul>
                <li class="nav-home">
                    <a href="<?= home_url(); ?>">
                        <?= Svg::renderSvg("home"); ?>
                        <span><?php _e("Úvod", "RLG_DOMAIN"); ?></span>
                    </a>
                </li>

                <?php KT::theWpNavMenu(NAVIGATION_MAIN_MENU, 3); ?>
            </ul>
        </nav>

        <?php get_template_part(COMPONENTS_PATH . "Header/HeaderSearchForm"); ?>

        <div class="header-nav-button">
            menu
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="header-mask"></div>
</header>