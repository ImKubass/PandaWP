<?php

use Layouts\PostArchive\PostArchiveFactory;

$PostArchiveModel = PostArchiveFactory::create(); ?>

<section class="container">

    <header class="mb-2">
        <h1><?= $PostArchiveModel->getTitle(); ?></h1>

        <?php if ($PostArchiveModel->isContent()) { ?>
            <div>
                <?= $PostArchiveModel->getContent(); ?>
            </div>
        <?php } ?>
    </header>

</section>