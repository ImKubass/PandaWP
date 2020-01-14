<?php

use Components\Employee\EmployeeFactory;

$Employee = EmployeeFactory::create();
$Employee->tryAddPersonJsonLdData(); ?>

<div class="employee col-sm-6 col-md-4 col-lg-3">
    <div class="employee-img">
        <?php $Employee->renderThumbnail(); ?>
    </div>

    <h3 class="employee-name article-heading"><?= $Employee->getTitle(); ?></h3>

    <?php if ($Employee->isParamJob()) { ?>
        <div class="employee-title"><?= $Employee->getParamJob(); ?></div>
    <?php } ?>

    <p class="employee-text"><?= $Employee->getContentClean(); ?></p>

</div>