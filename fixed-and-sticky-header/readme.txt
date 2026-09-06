=== Fixed And Sticky Header ===
Contributors: arjunthakur
Tags: sticky header, fixed header, sticky menu, fixed menu, sticky navigation
Requires at least: 4.1
Tested up to: 7.1
Requires PHP: 5.6
Stable tag: 1.5.3
Version: 1.5.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Make your WordPress website header fixed or sticky while scrolling. Choose your header, scroll position, colors, height, and spacing.

== Description ==

Keep your website header visible while visitors scroll.

Fixed And Sticky Header lets you make your existing WordPress website header fixed and sticky without replacing your theme's header.

Choose the header you want to make sticky, set when it should become fixed while scrolling, and adjust its appearance to match your website.

The plugin is simple to configure and works with your existing WordPress theme.

== Key Features ==

* Fixed and sticky header - Keep your header visible as visitors scroll.
* Choose your header - Select the header element you want to make fixed or sticky.
* Scroll control - Choose how far visitors scroll before the header becomes fixed.
* Background and text colors - Set the colors of your sticky header.
* Header height and spacing - Adjust the height and padding around your header.

== Installation ==

1. Install and activate the Fixed And Sticky Header plugin.
2. Go to Settings -> Fixed And Sticky Header.
3. Enter the CSS selector for the header you want to make fixed or sticky.
4. Set the scroll distance and customize the header appearance.
5. Click Save Changes.
6. Visit your website and scroll to check the sticky header.

== Finding Your Header ==

The plugin needs to know which part of your website should become fixed.

Your theme may use a selector such as:

* `.site-header`
* `#masthead`
* `.main-header`

If you are unsure which selector to use, inspect your website's header using your browser's developer tools and identify the main header container.

Tip: Select the main header or header container rather than only the logo, menu, or an individual element inside the header.

The exact selector depends on your WordPress theme.

== Frequently Asked Questions ==

= How do I make my header sticky? =

Go to Settings -> Fixed And Sticky Header, enter your header's CSS selector, choose the scroll position, and save your settings.

= Why isn't my header becoming sticky? =

First, check that the header selector is correct. Make sure you have selected the main header or header container rather than an individual element such as the logo or menu.

If the changes are not immediately visible, clear your site's cache and browser cache.

= Why did my logo or menu position change? =

The plugin applies the fixed/sticky behavior to the header element you select. If the selected element is too broad or is not the correct header container, it can affect the layout of elements inside it.

Try selecting the main header container used by your theme.

= Can I change the sticky header's background and text colors? =

Yes. You can change the background color and text color from the plugin settings.

= Can I change the header height and spacing? =

Yes. The plugin provides settings for header height and padding.

= Can I use the plugin with my existing theme? =

Yes. The plugin works with your existing theme's header. You select the header element you want the plugin to make fixed or sticky.

= Can I choose when the header becomes fixed? =

Yes. You can set the scroll distance at which the header becomes fixed.

= Does the plugin replace my website header? =

No. The plugin applies fixed/sticky behavior to the existing header element selected in the settings.

= Will my settings be preserved when I update the plugin? =

Yes. Version 1.5.2 preserves your existing plugin settings when upgrading from an earlier version.

= Does the plugin work on mobile devices? =

The plugin applies the fixed/sticky behavior according to your settings. The current version does not provide a separate option to disable the sticky header on mobile devices.

== Upgrade Notice ==

= 1.5.3 =
This update improves settings handling, compatibility, and code security. It also removes the use of an externally hosted script and updates the plugin's compatibility information.

== Changelog ==

= 1.5.3 =
* Refreshed the plugin icon and banner for improved visibility and presentation.
* Minor design and documentation improvements.

= 1.5.2 =
* Improved settings input validation and nonce handling.
* Corrected the plugin text domain and translated output handling.
* Removed the externally hosted jQuery script and use WordPress's bundled jQuery instead.
* Fixed non-prefixed global function and variable names.
* Updated the minimum supported WordPress version to 4.1 to match the WordPress APIs used by the plugin.
* Limited plugin directory tags to five relevant search terms.

= 1.5.1 =
* Security and compatibility patch.
* Sanitized and validated plugin settings before saving.
* Escaped settings output and safely encoded JavaScript configuration.
* Preserved existing settings during deactivation, reactivation, and upgrades.
* Prevented activation from overwriting existing plugin configuration.
* Removed an unintended forced text alignment that could move header logos.
* Added validation for CSS selectors, CSS values, and colors.
* Replaced the JavaScript-based admin redirect with a WordPress-safe redirect.
* Updated WordPress and PHP compatibility metadata.

= 1.5 =
* Previous release.
