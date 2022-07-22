<?php
	/**
	 *  Created by PhpStorm.
	 *  User: yys
	 *  Date: 7/21/2022
	 *  Time: 11:48 AM
	 */

	if (site_url () == "http://demo.lwyy.com") {
		define ("VERSION", time ());
	} else {
		define ("VERSION", wp_get_theme () -> get ('Version'));
	}

	function launcher_setup_theme ()
	{
		load_theme_textdomain ('launcher');
		add_theme_support ('post-thumbnails');
		add_theme_support ('title-tag');
	}

	add_action ('after_setup_theme', 'launcher_setup_theme');

	function launcher_assets ()
	{
//        echo basename (get_page_template ());
//        die();
        if (is_page ()){
            $launcher_template_name = basename (get_page_template ());
            if ($launcher_template_name == "launcher.php"){
				wp_enqueue_style ("animate", get_theme_file_uri ("/assets/css/animate.css"));
				wp_enqueue_style ("icomoon", get_theme_file_uri ("/assets/css/icomoon.css"));
				wp_enqueue_style ("bootstrap", get_theme_file_uri ("/assets/css/bootstrap.css"));
				wp_enqueue_style ("style", get_theme_file_uri ("/assets/css/style.css"));
				wp_enqueue_style ("launcher", get_stylesheet_uri (), null, '0.1');

				wp_enqueue_script ("jquery.easing", get_theme_file_uri ("assets/js/jquery.easing.1.3.js"), array ('jquery'), null, true);
				wp_enqueue_script ("bootstrap", get_theme_file_uri ("assets/js/bootstrap.min.js"), array ('jquery'), null, true);
				wp_enqueue_script ("jquery.waypoints", get_theme_file_uri ("assets/js/jquery.waypoints.min.js"), array ('jquery'), null, true);
				wp_enqueue_script ("simplyCountdown", get_theme_file_uri ("assets/js/simplyCountdown.js"), array ('jquery'), null, true);
				wp_enqueue_script ("main", get_theme_file_uri ("assets/js/main.js"), array ('jquery'), null, true);

				$launcher_year  = get_post_meta (get_the_ID (), "year", true);
				$launcher_month = get_post_meta (get_the_ID (), "month", true);
				$launcher_day   = get_post_meta (get_the_ID (), "day", true);

				wp_localize_script ("main", "datedata", array (
					"year"  => $launcher_year,
					"month" => $launcher_month,
					"day"   => $launcher_day
				));
			}else{
				wp_enqueue_style ("bootstrap", get_theme_file_uri ("/assets/css/bootstrap.css"));
				wp_enqueue_style ("launcher", get_stylesheet_uri (), null, '0.1');
			}
		}

	}

	add_action ('wp_enqueue_scripts', 'launcher_assets');

	function launcher_sidebars ()
	{
		register_sidebar (
			array (
				'name'          => __ ("Footer Left", "launcher"),
				'id'            => 'launcher_footer_left',
				'description'   => __ ('Footer Left', 'launcher'),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		register_sidebar (
			array (
				'name'          => __ ("Footer Right", "launcher"),
				'id'            => 'launcher_footer_right',
				'description'   => __ ('Footer Right', 'launcher'),
				'before_widget' => '<section id="%1$s" class="text-right widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);
	}

	add_action ("widgets_init", "launcher_sidebars");

	function launcher_styles ()
	{
		if (is_page ()) {
			$thumbnail_url = get_the_post_thumbnail_url (null, "large");
			?>
            <style>
                .home-side {
                    background-image: url(<?php echo $thumbnail_url; ?>);
                }
            </style>
			<?php
		}
	}

	add_action ("wp_head", 'launcher_styles');