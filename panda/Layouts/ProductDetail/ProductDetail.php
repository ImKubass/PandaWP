<?php

use Components\Product\ProductFactory;


$Product = ProductFactory::create();


get_template_part(COMPONENTS_PATH . "Header/Header"); ?>

<div class="container">

    <div class="entry-content">
        <?= $Product->getContent(); ?>
    </div>

</div>


<?php get_template_part(COMPONENTS_PATH . "Footer/Footer");
