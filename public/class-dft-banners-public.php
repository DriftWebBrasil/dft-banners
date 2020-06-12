<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       matheusdaros.com
 * @since      1.0.0
 *
 * @package    Dft_Banners
 * @subpackage Dft_Banners/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Dft_Banners
 * @subpackage Dft_Banners/public
 * @author     Matheus Darós <contato@matheusdaros.com>
 */
class Dft_Banners_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The Options name of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $option_name    The current Options name of this plugin.
	 */
	private $option_name;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $option_name ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->option_name = $option_name;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		global $post;

		$exclude = $this->get_plugin_option('exclude', false);
		$pages = $this->get_plugin_option("pages", array());

		if( $post->post_type == 'page'  ) {

			if( ( $exclude == 'on' && !empty($pages) && in_array($post->post_name, $pages) ) || $exclude != 'on' ) {
			
				wp_enqueue_style( $this->plugin_name . '-pub', plugin_dir_url(__FILE__) . 'css/dft-banners-pub.css');
				wp_enqueue_style('slick-css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
		
			
			}

		} 
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_variables() {

		global $post;

		$exclude = $this->get_plugin_option('exclude', false);
		$pages = $this->get_plugin_option("pages", array());
		$arrow_file_id = $this->get_plugin_option("arrow_file_id", false);

		$dots_color_normal = $this->get_plugin_option('dots_color_normal', '#4f4f4f');
		$dots_color_hover  = $this->get_plugin_option('dots_color_hover' , '#333333');
		$dots_color_ativo  = $this->get_plugin_option('dots_color_ativo' , '#2F8113');


		if( $post->post_type == 'page'  ) {

			if( ( $exclude == 'on' && !empty($pages) && in_array($post->post_name, $pages) ) || $exclude != 'on' ) {
				
				$height_desktop =  $this->get_plugin_option('desktop_size', 700);
				$arrow_url = !empty($arrow_file_id) ? wp_get_attachment_url($arrow_file_id) : DFT_BANNERS_URL . 'assets/arrow.png';

				?>
	
					<style> 
						.dft-banners, 
						.dft-banner .banner-fotos { 
							height: <?= $height_desktop ?>px !important; 
						}
						.dft-banner ul.slick-dots button {
    						background: <?= $dots_color_normal ?>;
						}
						.dft-banner ul.slick-dots button:hover {
							background: <?= $dots_color_hover ?>;
						}
						.dft-banner ul.slick-dots li.slick-active button {
							background: <?= $dots_color_ativo ?>;
						}


					</style>
					<script> var DRIF_BANNER_ARROW = "<?= $arrow_url ?>"</script>
				<?php
			}

		} 
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		
		global $post;

		$exclude = $this->get_plugin_option('exclude', false);
		$pages = $this->get_plugin_option("pages", array());

		if( $post->post_type == 'page'  ) {
			
			if( ( $exclude == 'on' && !empty($pages) && in_array($post->post_name, $pages) ) || $exclude != 'on' ) {
				wp_enqueue_script( $this->plugin_name . '-pub', plugin_dir_url(__FILE__) . 'js/dft-banners-pub.js', array('jquery'), null, false );
				wp_enqueue_script( 'slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js' );		
			}

		} 

	}


	/**
	 * 
	 * 	The shortcode callback
	 * 
	 */
	public function add_shortcodes() {

		/**
		 * Carrega o shortcode principal
		 */
		require_once plugin_dir_path(__FILE__) . 'partials/dft-banners-shortcode.php';


	}

	/**
	 * 
	 * 	The shortcode callback
	 * 
	 */
	public function add_custom_image_sizes() {

		$width_desktop = apply_filters('dft_banners_desktop_width_size', 1920);
		$height_desktop = apply_filters('dft_banners_desktop_height_size', $this->get_plugin_option('desktop_size', 700) );
		$width_mobile = apply_filters('dft_banners_mobile_width_size', 1024 );
		$height_mobile = apply_filters('dft_banners_mobile_height_size', 640 );

		add_image_size('dft-banners-desktop', $width_desktop, $height_desktop, true);
		add_image_size('dft-banners-mobile', $width_mobile, $height_mobile, true);

	}

	/**
	 * 
	 * 	Add the post type
	 * 
	 */
	public function add_post_type() {
		register_post_type( 'banners',
			array(
				'labels' => array(
					'name' => __( 'Banners' ),
					'singular_name' => __( 'Banner' ),
					'name_admin_bar'     => _x( 'Banner', 'add new on admin bar' ),
					'add_new'            => _x( 'Adicionar Banner', 'banner' ),
					'add_new_item'       => __( 'Adicionar novo Banner' ),
					'new_item'           => __( 'Novo Banner' ),
					'edit_item'          => __( 'Editar Banner' ),
					'view_item'          => __( 'Ver Banner' ),
					'all_items'          => __( 'Todos' ),
				),
				'public' => true,
				'has_archive' => false,
				'menu_position' => 2,
				'capability_type' => 'page',
				'hierachical' => true,
				'description' => 'Adicione seus banners aqui',
				'supports' => array( 'title', 'page-attributes' ), 
				'rewrite' => array('slug' => 'banner'),
			)
	  );
	}
	
	function get_plugin_option($name, $default = false) {
		$option = get_option( $this->option_name);
		return isset($option[$name]) ? $option[$name] : $default;
	}




}
