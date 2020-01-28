<?php

use Components\Post\Post;
use Components\PostQuery\PostQueryFactory;

$Posts = PostQueryFactory::create();
$Posts->setTemplate(Post::TEMPLATE_GRID);
?>

<?php if ($Posts->hasPosts()) { ?>
    <div class="container">
        <div class="row">
            <?php $Posts->thePosts(); ?>
        </div>
    </div>
<?php } ?>