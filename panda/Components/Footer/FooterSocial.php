<?php
use Components\PageTheme\PageThemeFactory;
use Utils\Util;

$Theme = PageThemeFactory::create(); ?>

<?php if ($Theme->isSocials()) : ?>
<div class="footer-social">
	<span><?php _e("Sledujte nás", "RLG_DOMAIN"); ?></span>

	<div>

		<?php if ($Theme->isSocialFacebook()) : ?>
		<a href="<?= $Theme->getSocialFacebook(); ?>">
			<?= Util::renderSvg("facebook"); ?>
		</a>
		<?php endif; ?>

		<?php if ($Theme->isSocialInstagram()) : ?>
		<a href="<?= $Theme->getSocialInstagram(); ?>">
			<?= Util::renderSvg("instagram"); ?>
		</a>
		<?php endif; ?>

		<?php if ($Theme->isSocialYoutube()) : ?>
		<a href="<?= $Theme->getSocialYoutube(); ?>">
			<?= Util::renderSvg("youtube"); ?>
		</a>
		<?php endif; ?>


	</div>
</div>
<?php endif; ?>