=== Baffled Architect ===

Contributors: Dougie Richardson
Requires at least: 5.9
Tested up to: 6.4
Requires PHP: 7.4
Version: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, technical, dark-mode, responsive, clean, minimal, one-column, two-columns, custom-colors, custom-menu, editor-style, featured-images, threaded-comments, translation-ready

A modern, clean WordPress theme for technical blogging with dark mode support, JavaScript animations, and smooth scroll features.

== Description ==

Baffled Architect is a modern WordPress theme designed specifically for technical blogs. It features a clean, minimalist design that puts your content first while providing powerful features like dark mode, smooth animations, and excellent code syntax highlighting support.

= Key Features =

* **Dark Mode Toggle** - Seamless light/dark mode switching with localStorage persistence
* **Scroll-to-Top Button** - Floating button that appears when scrolling down
* **JavaScript Animations** - Subtle scroll-triggered animations using Intersection Observer API
* **Responsive Design** - Mobile-first design that looks great on all devices
* **Code-Friendly** - Enhanced styling for code blocks and syntax highlighting
* **MathJax Compatible** - Full support for mathematical equations
* **Prism Compatible** - Enhanced support for syntax highlighted code blocks
* **Accessibility Ready** - WCAG 2.1 AA compliant with keyboard navigation support
* **Performance Optimized** - Lightweight and fast-loading
* **SEO Friendly** - Semantic HTML5 markup and proper heading structure

= Technical Specifications =

* Uses CSS Custom Properties for theming
* Vanilla JavaScript (no jQuery dependency)
* Intersection Observer API for animations
* LocalStorage for theme persistence
* Google Fonts: Poppins and Special Elite
* Modular file organization
* Translation ready

== Installation ==

1. Upload the theme files to the `/wp-content/themes/baffled-architect` directory
2. Activate the theme through the 'Appearance > Themes' menu in WordPress
3. Configure theme settings in the WordPress Customizer
4. Set up your menus under 'Appearance > Menus'
5. Add widgets to sidebar areas under 'Appearance > Widgets'

== Frequently Asked Questions ==

= How do I enable dark mode? =

Dark mode can be toggled using the moon/sun icon in the header. Your preference is automatically saved and will persist across sessions.

= Does this theme support the block editor? =

Yes, the theme is fully compatible with the WordPress block editor (Gutenberg) and includes editor styles.

= Is the theme compatible with popular plugins? =

Yes, the theme includes specific compatibility code for:
- MathJax (mathematical equations)
- Prism / Code Syntax Block (syntax highlighting)
- Contact Form 7
- WooCommerce (basic support)

= How do I customize colors? =

The theme uses CSS custom properties defined in /assets/css/theme-base.css. You can customize these through child theme overrides or the WordPress Customizer.

= Can I use this theme for non-technical blogs? =

Absolutely! While designed with technical blogging in mind, the clean, minimal design works well for any type of blog content.

== Customization ==

= Menus =

The theme supports two menu locations:
1. Primary Menu (header navigation)
2. Footer Menu (footer links)

Configure these under Appearance > Menus.

= Widget Areas =

The theme includes four widget areas:
1. Sidebar (appears on posts and pages)
2. Footer Widget Area 1
3. Footer Widget Area 2
4. Footer Widget Area 3

= Custom Logo =

Upload your custom logo under Appearance > Customize > Site Identity.

== Browser Support ==

The theme is tested and works on:
- Chrome (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest 2 versions)
- Mobile browsers (iOS Safari, Chrome Mobile)

== Performance ==

The theme is optimized for performance:
- Minimal JavaScript (< 100KB total)
- Efficient CSS (< 50KB total)
- Hardware-accelerated animations
- Lazy-loaded images (WordPress native)
- Intersection Observer for scroll animations
- No jQuery dependency

== Accessibility ==

The theme follows WCAG 2.1 Level AA guidelines:
- Semantic HTML5 structure
- ARIA labels and landmarks
- Keyboard navigation support
- Skip-to-content link
- Focus indicators
- Color contrast ratios: 4.5:1 minimum
- Respects prefers-reduced-motion setting

== Credits ==

* Google Fonts: Poppins and Special Elite
* Animation techniques inspired by modern web design best practices
* Dark mode implementation following current web standards

== Changelog ==

= 1.0.0 =
* Initial release
* Dark mode toggle with localStorage persistence
* Scroll-to-top button
* JavaScript scroll animations
* Responsive design (mobile, tablet, desktop)
* MathJax and Prism compatibility
* Accessibility features (WCAG 2.1 AA)
* SEO optimization
* Performance optimization

== Upgrade Notice ==

= 1.0.1 =
Initial release of Baffled Architect theme
= 1.0.2 =
Fixed floating action button bug


== Copyright ==

Baffled Architect WordPress Theme, Copyright 2026 Dougie Richardson
Baffled Architect is distributed under the terms of the GNU GPL v2 or later.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

== Resources ==

* normalize.css - https://necolas.github.io/normalize.css/ | MIT License
* Google Fonts - https://fonts.google.com/ | SIL Open Font License
