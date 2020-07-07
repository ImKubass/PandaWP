<?php

use Components\Post\PostFactory;

$Post = PostFactory::create(); ?>

<article class="col-12">


    <div>

    </div>

    <header>
        <h2><?= $Post->getTitle(); ?></h2>
    </header>

    <p><?= $Post->getExcerpt(); ?></p>

</article>
