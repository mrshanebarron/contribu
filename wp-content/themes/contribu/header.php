<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header" x-data="{ scrolled: false, open: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 40)" :class="{ 'scrolled': scrolled }">
    <nav class="nav-inner">
        <a href="<?php echo home_url(); ?>" class="nav-logo">
            <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 28C16 28 4 20 4 12C4 8 7 5 10.5 5C13 5 15 6.5 16 8.5C17 6.5 19 5 21.5 5C25 5 28 8 28 12C28 20 16 28 16 28Z" fill="#8fae8b" opacity="0.2"/>
                <path d="M16 26C16 26 5 19 5 12C5 8.5 7.5 6 10.5 6C12.8 6 14.8 7.3 16 9.3C17.2 7.3 19.2 6 21.5 6C24.5 6 27 8.5 27 12C27 19 16 26 16 26Z" stroke="#8fae8b" stroke-width="1.5" fill="none"/>
                <path d="M12 14L15 17L20 12" stroke="#8fae8b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Contribu
        </a>

        <ul class="nav-links" :class="{ 'open': open }">
            <li><a href="<?php echo home_url(); ?>" class="<?php echo is_front_page() ? 'active' : ''; ?>">Home</a></li>
            <li><a href="<?php echo home_url('/how-it-works'); ?>" class="<?php echo is_page('how-it-works') ? 'active' : ''; ?>">How It Works</a></li>
            <li><a href="<?php echo home_url('/create-registry'); ?>" class="<?php echo is_page('create-registry') ? 'active' : ''; ?>">Create Registry</a></li>
            <li><a href="<?php echo home_url('/sample-registry'); ?>" class="<?php echo is_page('sample-registry') ? 'active' : ''; ?>">Sample Registry</a></li>
            <li><a href="<?php echo home_url('/contact'); ?>" class="<?php echo is_page('contact') ? 'active' : ''; ?>">Contact</a></li>
            <li><a href="<?php echo home_url('/create-registry'); ?>" class="nav-cta">Get Started</a></li>
        </ul>

        <button class="nav-toggle" @click="open = !open" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </nav>
</header>
