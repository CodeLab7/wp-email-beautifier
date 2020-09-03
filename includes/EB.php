<?php

class EB {
	protected $loader;

	public function __construct() {
		$this->load_dependencies();
		//$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		//$this->create_master_settings();
		//$this->create_custom_post();
	}

	private function define_public_hooks() {
		$plugin_public = new EB_Public();
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	private function define_admin_hooks() {
		$plugin_admin = new EB_Admin();
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
	}

	private function create_master_settings() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/EB_Settings.php';
		$setting_page = new EB_Settings( 'developer API' );
		$this->loader->add_action( 'admin_init', $setting_page, 'init_settings' );
		$this->loader->add_action( 'admin_menu', $setting_page, 'add_setting_page' );

		/**
		 * How to use Settings Page:
		 * Use following to create option fields.
		 * Available Options are: text, textarea, password, checkbox
		 * */
		$setting_page->add_option( 'Developer Name', 'text' );
		$setting_page->add_option( 'Developer Address', 'textarea' );
		$setting_page->add_option( 'Ultimate Access', 'password' );
		$setting_page->add_option( 'Appreciate Developer', 'checkbox' );
	}

	private function create_custom_post() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/EB_CustomPost.php';
		$post = new EB_CustomPost();
		$post->set_post_type( 'post' );
		$post->create_cate( 'Hello World' ); //It will create a taxonomy for above post type
		$post->create_tag( 'Hello Master' );

		$post->create_custom_post( 'custom post' ,[]); //You can add configure into this
		$post->create_cate( 'Hello World' ); //It will create a taxonomy for above post type

		$post->create_custom_page( 'custom page' );
		$this->loader->add_action( 'init', $post, 'register' );
	}

	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/EB_Loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/EB_Abstruct.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/EB_Admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/EB_Public.php';
		$this->loader = new EB_Loader();
	}

	private function set_locale() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/EB_i18n.php';
		$plugin_i18n = new EB_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	public function run() {
		$this->loader->run();
	}

}
