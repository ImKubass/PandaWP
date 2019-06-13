<?php use Utils\Util; ?>
<div class="header-search">
	<form id="searchform" class="header-search-inner" role="search" method="get" action="<?= home_url("/"); ?>">

		<input id="s" name="s" class="header-search-input" type="text" placeholder="<?php _e("Hledat na...", "RLG_DOMAIN"); ?>">

		<button class="header-search-submit btn" type="submit">
			<span><?php _e("Vyhledat", "RLG_DOMAIN"); ?></span>
		</button>

	</form>
	<div class="header-search-button">
		<?php Util::renderSvg("search"); ?>
	</div>
</div>