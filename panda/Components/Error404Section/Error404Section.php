<section class="error-404-section base-section">
    <div class="container">
        <header>

            <h1 class="base-heading">
                <img class="error-404-img" src="" data-src="<?= get_template_directory_uri(); ?>/images/ico/404.svg" alt="Chyba 404">
            </h1>

            <p>
                <?php _e("Je nám líto, ale požadovaná adresa na webu neexistuje. Byla buď smazána nebo přesunuta na jinou adresu.", "ELV_DOMAIN"); ?>
            </p>

        </header>

        <p>
            <?php _e("Nenašli jste co jste hledali? Pokračujte na úvodní stránku.", "ELV_DOMAIN"); ?>
        </p>

        <a class="btn" href="<?= get_home_url(); ?>">
            <span><?php _e("Úvodní stránka", "ELV_DOMAIN"); ?></span>
        </a>

    </div>
</section>