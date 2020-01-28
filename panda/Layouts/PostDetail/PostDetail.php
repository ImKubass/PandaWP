<?php

use Components\Post\PostFactory;
use Components\SchemaGenerator\SchemaGenerator;

$Post = PostFactory::create();
SchemaGenerator::addModel($Post);


get_template_part(COMPONENTS_PATH . "Header/Header"); ?>

<div class="container">
    <div class="entry-content">
        <header class="mb-1">
            <h1><?= $Post->getTitle(); ?></h1>
        </header>

        <?= $Post->getContent(); ?>
    </div>
</div>

<?php get_template_part(COMPONENTS_PATH . "Footer/Footer");
