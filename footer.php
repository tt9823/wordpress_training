<footer>
    <div class="footer-inner">
        <div class="footer-nav-area">
            <?php wp_nav_menu(array(
                'theme_location' => 'footer-nav',
                'container' => 'nav',
                'container_class' => 'footer-nav',
                'container_id' => 'footer-nav',
                'fallback_cb' => ''
            )); ?>
            <div class="copyright">
                <p class="copyright-content">copyright ©<?php bloginfo('name'); ?> Takeshi Torizuka.</p>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
<!--システム・プラグイン用-->
</body>

</html>