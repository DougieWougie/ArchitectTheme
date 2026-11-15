<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'baffled-architect'); ?></a>

    <header id="masthead" class="site-header">
        <div class="header-container">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="profile-picture-link">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/ProfilePicture.png'); ?>" alt="<?php bloginfo('name'); ?>" class="profile-picture">
            </a>

            <div class="site-branding">
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </h1>
                <?php
                $description = get_bloginfo('description', 'display');
                if ($description || is_customize_preview()) {
                    ?>
                    <p class="site-description"><?php echo $description; ?></p>
                    <?php
                }
                ?>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/dougie-richardson" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn Profile" class="social-link social-linkedin">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>
                    <a href="https://github.com/DougieWougie" target="_blank" rel="noopener noreferrer" aria-label="GitHub Profile" class="social-link social-github">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="screen-reader-text"><?php esc_html_e('Menu', 'baffled-architect'); ?></span>
                    <span class="menu-icon"></span>
                </button>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'nav-menu',
                        'fallback_cb'    => false,
                    )
                );
                ?>
            </nav>

            <?php
            /*
             * Three-state theme toggle: auto (follow the OS), light, dark.
             * All three icons and labels are printed; CSS shows the one that
             * matches <html data-theme-mode>. The button stays hidden until
             * the head script has set that attribute, so it never appears
             * as a dead control when JavaScript is unavailable.
             */
            ?>
            <button type="button" class="theme-toggle"
                data-label-auto="<?php esc_attr_e('Theme: auto, following your device. Switch theme', 'baffled-architect'); ?>"
                data-label-light="<?php esc_attr_e('Theme: light. Switch theme', 'baffled-architect'); ?>"
                data-label-dark="<?php esc_attr_e('Theme: dark. Switch theme', 'baffled-architect'); ?>"
                aria-label="<?php esc_attr_e('Switch theme', 'baffled-architect'); ?>">
                <span class="theme-toggle-state" data-mode="auto">
                    <svg class="theme-toggle-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 3a9 9 0 0 0 0 18z" fill="currentColor"/>
                    </svg>
                    <span class="theme-toggle-label"><?php esc_html_e('Auto', 'baffled-architect'); ?></span>
                </span>
                <span class="theme-toggle-state" data-mode="light">
                    <svg class="theme-toggle-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                        <circle cx="12" cy="12" r="4"/>
                        <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                    </svg>
                    <span class="theme-toggle-label"><?php esc_html_e('Light', 'baffled-architect'); ?></span>
                </span>
                <span class="theme-toggle-state" data-mode="dark">
                    <svg class="theme-toggle-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                    </svg>
                    <span class="theme-toggle-label"><?php esc_html_e('Dark', 'baffled-architect'); ?></span>
                </span>
            </button>
        </div>
    </header>

    <div id="content" class="site-content">
        <div class="content-wrapper">
