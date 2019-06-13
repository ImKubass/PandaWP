<?php
use Components\FooterHeaderSettings\FooterHeaderSettingsFactory;
use Components\PageTheme\PageThemeFactory;

$FooterHeader = FooterHeaderSettingsFactory::create();
$Theme = PageThemeFactory::create(); ?>

<div class="footer-top">
	<div class="container">
		<div class="row">
			<div class="footer-block col-sm-6 col-md-4">

				<?php if ($FooterHeader->isFooterFirstColTitle()) : ?>
				<h2 class="article-heading"><?= $FooterHeader->getFooterFirstColTitle(); ?></h2>
				<?php endif; ?>

				<?php if ($Theme->isContactPhone()) : ?>
				<span class="footer-contact footer-contact-phone d-none d-sm-flex">
					<img src="" data-src="<?= get_template_directory_uri(); ?>/images/ico/phone-primary.svg" alt="">
					<span><?= $Theme->getContactPhoneFancy(); ?></span>
				</span>

				<a class="footer-contact footer-contact-phone d-sm-none" href="tel:<?= $Theme->getContactPhoneClean(); ?>">
					<img src="" data-src="<?= get_template_directory_uri(); ?>/images/ico/phone-primary.svg" alt="">
					<span><?= $Theme->getContactPhoneFancy(); ?></span>
				</a>
				<?php endif; ?>


				<?php if ($Theme->isContactEmail()) : ?>
				<a class="footer-contact footer-contact-mail" href="mailto:<?= $Theme->getContactEmail(); ?>">
					<img src="" data-src="<?= get_template_directory_uri(); ?>/images/ico/mail-primary.svg" alt="">
					<span><?= $Theme->getContactEmail(); ?></span>
				</a>
				<?php endif; ?>

				<?php if ($Theme->isImportantPagesContactId()) : ?>
				<span class="footer-contacts-link">
					<a href="<?= $Theme->getImportantPagesContactLink(); ?>">

						<span><?php _e("Všechny kontakty", "RLG_DOMAIN"); ?></span>

						<img src="" data-src="<?= get_template_directory_uri(); ?>/images/ico/arrow-right-primary.svg" alt="">

					</a>
				</span>
				<?php endif; ?>

				<?php get_template_part(COMPONENTS_PATH . "Footer/FooterSocial"); ?>

			</div>

			<div class="footer-block col-sm-6 col-md-4">

				<?php if ($FooterHeader->isFooterSecondColTitle()) : ?>
				<h2 class="article-heading"><?= $FooterHeader->getFooterSecondColTitle(); ?></h2>
				<?php endif; ?>

				<div class="entry-content">
					<p>
						<strong><?= $Theme->getContactCompanyName(); ?></strong> <br>
						<?= $Theme->getContactAdressFull(); ?><br>
					</p>

					<p>

						<?php if ($Theme->isContactIco()) : ?>
						<strong>IČO:</strong> <?= $Theme->getContactIco(); ?> <br>
						<?php endif; ?>

						<?php if ($Theme->isContactDic()) : ?>
						<strong>DIČ:</strong> <?= $Theme->getContactDic(); ?> <br>
						<?php endif; ?>

					</p>

					<p><?php _e("Jsme splátci DPH.", "RLG_DOMAIN"); ?></p>

				</div>
			</div>

			<?php if (has_nav_menu(NAVIGATION_FOOTER_MENU)) : ?>
			<div class="footer-block col-sm-6 col-md-4">

				<h2 class="article-heading"><?= $FooterHeader->getFooterThirdColTitle(); ?></h2>

				<nav class="footer-top-nav">
					<ul>
						<?php KT::theWpNavMenu(NAVIGATION_FOOTER_MENU); ?>
					</ul>
				</nav>

			</div>
			<?php endif; ?>

		</div>

		<div class="footer-brand">
			<a class="footer-brand-img-wrap" href="<?= home_url(); ?>">
				<img src="" data-src="<?= get_template_directory_uri(); ?>/images/ico/rolig-logo.svg" alt="rolig logo">
			</a>

			<span><?php _e("Neprodáváme kamna. Měníme zimu v teplo domova.", "RLG_DOMAIN"); ?></span>
		</div>

	</div>
</div>