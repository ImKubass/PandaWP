<?php

use Layouts\Page\PageFactory;

$Page = PageFactory::create();
get_template_part(COMPONENTS_PATH . "Header/Header"); ?>



<section>

    <div class="container">

        <div class="entry-content">
            <header class="mb-3">
                <h1><?= $Page->getTitle(); ?></h1>
            </header>


            <?= $Page->getContent(); ?>
        </div>
    </div>

</section>

<?php get_template_part(COMPONENTS_PATH . "Footer/Footer"); ?>