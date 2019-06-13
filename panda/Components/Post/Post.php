<?php
use Components\Post\PostFactory;

$Post = PostFactory::create(); ?>

<article class="post-item">

	<?php if ($Post->getModel()->hasThumbnail()) : ?>
	<div class="post-item-img">
		<img src="<?= $Post->getImageSrc(); ?>" alt="<?= $Post->title(); ?>">
	</div>
	<?php endif; ?>


	<header>
		<h2 class="post-item-heading"><?= $Post->title(); ?></h2>
	</header>

	<a href="<?= $Post->permaLink(); ?>" class="btn post-item-button">
		<?php _e("Více", "_DOMAIN"); ?>
	</a>

</article>