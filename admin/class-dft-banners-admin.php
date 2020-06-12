<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       matheusdaros.com
 * @since      1.0.0
 *
 * @package    Dft_Banners
 * @subpackage Dft_Banners/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks.
 *
 * @package    Dft_Banners
 * @subpackage Dft_Banners/admin
 * @author     Matheus Darós <contato@matheusdaros.com>
 */
class Dft_Banners_Admin {

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
	 * The Option name of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $option_name    The current Option name of this plugin.
	 */
	private $option_name;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $option_name ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->option_name = $option_name;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		if( get_post_type() == 'banners' ) {
		
			wp_enqueue_style('material-icons', '//fonts.googleapis.com/icon?family=Material+Icons');
			wp_enqueue_style('dft-banners-admin-css', plugin_dir_url(__FILE__) . 'css/dft-banners-admin.css');
		
		}

		if( array_key_exists('page', $_GET)  && $_GET['page'] == 'options_dft_banners' ) {
		
			wp_enqueue_style('dft-banners-options-css', plugin_dir_url(__FILE__) . 'css/dft-banners-option.css');

			wp_enqueue_style( 'wp-color-picker' );

		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		if( get_post_type() == 'banners' ) {

			if ( ! did_action( 'wp_enqueue_media' ) ) {
				wp_enqueue_media();
			}

			wp_enqueue_script('dft-banners-admin', plugin_dir_url(__FILE__) . 'js/dft-banners-admin.js', array('jquery'), null, false);
	
		}

		if( array_key_exists('page', $_GET)  && $_GET['page'] == 'options_dft_banners' ) {

			if ( ! did_action( 'wp_enqueue_media' ) ) {
				wp_enqueue_media();
			}

			wp_enqueue_script('dft-banner-settings', plugin_dir_url(__FILE__) . 'js/dft-banners-options.js', array('jquery', 'wp-color-picker'), null, false);

		}

	}


	public function save_meta_fields($post_id) {

        if (array_key_exists('imagem_desktop', $_POST) ) {

            update_post_meta(
                $post_id,
                'imagem_desktop',
                $_POST['imagem_desktop']
            );

        } else {

			delete_post_meta(
				$post_id, 
				'imagem_desktop'
			);

		}

        if (array_key_exists('imagem_mobile', $_POST) ) {

            update_post_meta(
                $post_id,
                'imagem_mobile',
                $_POST['imagem_mobile']
            );

        } else {

			delete_post_meta(
				$post_id, 
				'imagem_mobile'
			);

		}

        if (array_key_exists('link_banner', $_POST) ) {

            update_post_meta(
                $post_id,
                'link_banner',
                $_POST['link_banner']
            );

		} else {

			delete_post_meta(
				$post_id, 
				'link_banner'
			);

		}
		
		if (array_key_exists('target_blank', $_POST) ) {

            update_post_meta(
                $post_id,
                'target_blank',
                'true'
            );

        } else {

			delete_post_meta(
				$post_id, 
				'target_blank'
			);

		}
        
    }

    public function print_fields($post) {

		if( $post->post_type != 'banners') return;
		
        $imagem_desktop = get_post_meta($post->ID, 'imagem_desktop', true);
        $imagem_mobile  = get_post_meta($post->ID, 'imagem_mobile', true);
        $link_banner 	= get_post_meta($post->ID, 'link_banner', true);
		$target_blank 	= get_post_meta($post->ID, 'target_blank', true);
		
		?>
			<div id="conteudo_banner">
				<div class="fields-row">
					<div class="field-group image-group <?= !empty($imagem_desktop) ? 'uploaded' : '' ?>">
						<div class="fields-content">
							<label class="label" for="imagem_desktop">Imagem para Computador</label>
							<p class="descricao">Escola uma imagem de até 1mb (jpg,jpeg,png)</p>
						</div>
						<div class="fields-actions">
							<a class="edit-upload">
								<i class="material-icons">edit</i>
							</a>   
							<a class="delete-upload">
								<i class="material-icons">delete</i>
							</a>
						</div>
						<div class="files-upload">
							<?php if( !empty($imagem_desktop) ) : 

									$url = wp_get_attachment_url($imagem_desktop);

									if( $url !== false ) : 
								  
								?>
									<a class="image wp-media-upload">
										<img class="true_pre_image" src="<?= $url ?>" style="max-width:100%; display:block;" />
									</a>
									<input type="hidden" name="imagem_desktop" id="imagem_desktop" value="<?= $imagem_desktop ?>">
								
							<?php
									endif; 
								else : ?>

									<a class="button wp-media-upload">Adicionar imagem</a>
									<input type="hidden" name="imagem_desktop" id="imagem_desktop">

							<?php endif; ?>
						</div>
					</div>
					<div  class="field-group image-group <?= !empty($imagem_mobile) ? 'uploaded' : '' ?>">
						<div class="fields-content">
							<label class="label" for="imagem_mobile">Imagem para Celular</label>
							<p class="descricao">Escola uma imagem de até 1mb (jpg,jpeg,png)</p>
						</div>
						<div class="fields-actions">
							<a class="edit-upload">
								<i class="material-icons">edit</i>
							</a>   
							<a class="delete-upload">
								<i class="material-icons">delete</i>
							</a>
						</div>
						<div class="fields-upload">
							<?php if( !empty($imagem_mobile) ) : 

								$url = wp_get_attachment_url($imagem_mobile);

								if( $url !== false ) : 

								?>

									<a href="<?= $url ?>" class="image wp-media-upload">
										<img class="true_pre_image" src="<?= $url ?>" style="max-width:100%; display:block;" />
									</a>
									<input type="hidden" name="imagem_mobile" id="imagem_mobile" value="<?= $imagem_mobile ?>">

								<?php
									endif; 
								else : ?>

									<a class="button wp-media-upload">Adicionar imagem</a>
									<input type="hidden" name="imagem_mobile" id="imagem_mobile">

							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="field-group field-group-url">
					<label class="label" for="imagem_desktop">Link para o banner (opcional)</label>
					<p class="descricao">Cole o link para seu banner.</p>
					<input class="text" placeholder="Ex: https://seusite.com.br/produtos" type="url" name="link_banner" id="link_banner" value="<?= $link_banner ?>">
				</div>
				<div class="field-group field-group-target">
					<label class='switch btn-posts_toggle <?= empty($link_banner) ? 'disabled' : '' ?>'>
                        <input name='target_blank' id='target_blank' type='checkbox' <?= checked( $target_blank, 'true' ) ?>  >
                        <span class='slider round'></span>
					</label>
					<span class="toggle-label">Abrir link em uma nova guia</span>
				</div>

			</div>
        <?php
	}
	
	public function add_plugin_option_page() {
		add_options_page(
			__('Drift Banners', 'dft-banners'), 
			__('Drift Banners', 'dft-banners'),
			'manage_options', 
			'options_dft_banners', 
			[$this, 'localize_settings_page']
		);
	}

	public function localize_settings_page() {
		
		include_once plugin_dir_path(__FILE__) . 'partials/class-dft-banners-options-display.php';

	}

	function create_plugin_settings() {

		register_setting('options_dft_banners', $this->option_name, 'dft_orgc_options_validate');
		add_settings_section('main_section', "Configurações Principais", null, 'options_dft_banners');
		add_settings_field('dft_orgc_settings_pages', 'Carregamento de scripts e estilos', [$this, 'checkbox_pages_callback'], 'options_dft_banners', 'main_section');
		add_settings_field('dft_orgc_settings_sizes', 'Tamanho do banner em computador', [$this, 'input_sizes_callback'], 'options_dft_banners', 'main_section');
		add_settings_field('dft_orgc_settings_arrow', 'Icone para seta', [$this, 'input_arrow_callback'], 'options_dft_banners', 'main_section');
		add_settings_field('dft_orgc_settings_color', 'Cor dos pontos', [$this, 'input_color_callback'], 'options_dft_banners', 'main_section');

	}

	/**
	 * Get the PHP file with HTML content to menu page.
	 *
	 * @since    1.0.0
	 */
	function checkbox_pages_callback() {

		$query = new WP_Query(array(
			'post_type'		=> 'page',
			'post_status'	=> 'publish',
			'posts_per_page'=> -1,
			'orderby'		=> 'date',
			'order'			=> 'DESC'
		));

		$available_pages = $query->posts;
		$selected_pages = $this->get_plugin_option('pages', array());
		$use_exclude = $this->get_plugin_option('exclude', false);

		?>
			<p>
				<input id="option-exclude" type='checkbox' name='<?= $this->option_name ?>[exclude]' <?php checked( $use_exclude ,  'on' ); ?> >
				<label for="option-exclude" >Ativar o controle para carregamente de arquivos estáticos do plugin (Melhor performance)</label>
				<p class="description">Com essa opção ativada, selecione as páginas que vão ser carregados os estilos e scripts.</p>
			</p>
		<?php
		echo '<ul id="page-checkbox-group" style="padding-left: 16px;">';
		foreach ($available_pages as $page) {
			?>
					<li>
						<input class="checkbox" id="page-<?= $page->post_name ?>" type='checkbox' name='<?= $this->option_name ?>[pages][]' <?php checked( in_array($page->post_name, $selected_pages) ,  1 ); ?> value='<?= $page->post_name ?>' <?php disabled( $use_exclude, false ) ?> >
						<label for="page-<?= $page->post_name ?>" ><?= $page->post_title ?></label>
					</li>

			<?php
		}
		echo '</ul>';



	}

	function input_sizes_callback() {

		$desktop_options = array( 700, 530, 430 );
		$selected_size = $this->get_plugin_option('desktop_size', 700);

		?>
			<p>Caso o tamanho for trocado, o ideal é atualizar o tamanho das imagens já salvadas. Para isso, use o plugin <a href="https://br.wordpress.org/plugins/regenerate-thumbnails/" target="_blank">'Regenerate Thumbails'</a></p>
			<ul>
				<?php foreach($desktop_options as $size) : ?>
					<li>
						<input type="radio" name="<?= $this->option_name ?>[desktop_size]" id="size-<?= $size ?>" value="<?= $size ?>" <?= checked($size, $selected_size) ?>>
						<label for="size-<?= $size ?>">1920 x <?= $size ?></label>
					</li>
				<?php endforeach; ?>
			</ul>

		<?php

	}

	function input_arrow_callback() {

		$arrow_file_id = $this->get_plugin_option('arrow_file_id', false);

		?>
			<p style="margin-bottom: 16px;">Insira abaixo a seta <strong>direita</strong></p>
			<?php if( isset($arrow_file_id) )  : ?>
				<a class="image wp-media-upload">
					<div class="icon-wrapper">
						<img class="true_pre_image" src="<?= wp_get_attachment_url($arrow_file_id) ?>" />
					</div>
				</a>
			<?php else : ?>
				<a class="button wp-media-upload">Adicionar ícone</a>
			<?php endif; ?>
			<input type="hidden" name="<?= $this->option_name ?>[arrow_file_id]"  value="<?= $arrow_file_id ?>">

		<?php

	}

	function input_color_callback() {

		$dots_color_normal = $this->get_plugin_option('dots_color_normal', '#4f4f4f');
		$dots_color_hover  = $this->get_plugin_option('dots_color_hover' , '#333333');
		$dots_color_ativo  = $this->get_plugin_option('dots_color_ativo' , '#2F8113');

		?>
			<p style="margin-bottom: 16px;">Insira as cores para os diferentes estados do slide. Primeiro para o estado normal, o segundo para quando passa o mouse e terceiro para quando o slide está ativo</p>
			<p>
				<input id="dots-color-normal" name="<?= $this->option_name ?>[dots_color_normal]" class="dots-color" type="text" value="<?= $dots_color_normal ?>" data-default-color="#4f4f4f" />
				<label for="dots-color-normal">Normal</label>
			</p>
			<p>
				<input id="dots-color-hover" name="<?= $this->option_name ?>[dots_color_hover]" class="dots-color" type="text" value="<?= $dots_color_hover ?>" data-default-color="#333" />
				<label for="dots-color-hover">Hover</label>
			</p>
			<p>
				<input id="dots-color-ativo" name="<?= $this->option_name ?>[dots_color_ativo]" class="dots-color" type="text" value="<?= $dots_color_ativo ?>" data-default-color="#2F8113" />
				<label for="dots-color-ativo">Ativo</label>
			</p>
		<?php
	}


	function dft_orgc_options_validate($input) {
		
		return $input;
	}

	function get_plugin_option($name, $default = false) {
		$option = get_option( $this->option_name);
		return isset($option[$name]) ? $option[$name] : $default;
	}

}
