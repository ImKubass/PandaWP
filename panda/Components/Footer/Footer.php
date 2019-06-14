<?php use Components\SchemaGenerator\SchemaGenerator; ?>

</main>

<footer class="footer-main">

    <?php get_template_part(COMPONENTS_PATH . "Footer/FooterBottom"); ?>

</footer>

<?php
wp_footer();
SchemaGenerator::render(); ?>

</body>

</html>