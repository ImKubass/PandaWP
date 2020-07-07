<?php

use Utils\Util;
use Components\SchemaGenerator\SchemaGenerator;
use Components\ContactForm\ContactFormFactory;

SchemaGenerator::addSite();

if (is_page_template("pages/page-contact.php")) {
    ContactFormFactory::create();
} ?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<?php get_template_part(COMPONENTS_PATH . "Header/HeaderHead"); ?>

<body <?php body_class(); ?>>

    <?php Util::renderAnalyticsBodyCode(); ?>

    <?php get_template_part(COMPONENTS_PATH . "Header/HeaderMain"); ?>

    <main>

        <?php get_template_part(COMPONENTS_PATH . "ProjectNotices/ProjectNotices"); ?>

        <?php get_template_part(COMPONENTS_PATH . "Breadcrumbs/Breadcrumbs"); ?>
