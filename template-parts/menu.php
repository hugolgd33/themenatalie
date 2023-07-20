<header>
    <nav class="navbar desktop">
        <div class="left"><a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/Logo.png" alt="logo"></a></div>
        <div class="right">
            <ul>
                <?php wp_nav_menu(array('container'  => 'false', 'items_wrap' => '%3$s','theme_location' => 'header',)); ?>
                <li><a onclick="Popup()">Contact</a></li>
            </ul>
        </div>
    </nav>
    <nav id="nav"class="navbar-mobile">
        <a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/Logo.png" alt="logo"></a>
        <button id="burger">
            <span class="ligne"></span>
            <span class="ligne"></span>
            <span class="ligne"></span>
        </button>
        <section id="menu-container" class="close">
            <ul id="menu">
                <?php wp_nav_menu(array('container'  => 'false', 'items_wrap' => '%3$s','theme_location' => 'header',)); ?>
                <li class="navigation"><a onclick="Popup()">Contact</a></li>
            </ul>
        </section>
    </nav>
</header>

<script>menuBg()</script>