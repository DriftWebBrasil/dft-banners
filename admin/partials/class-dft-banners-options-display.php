<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       matheusdaros.com
 * @since      1.0.0
 *
 * @package    Gforms_Draft_Viewer
 * @subpackage Gforms_Draft_Viewer/admin/partials
 */
?>
<div class="wrap">
    <h1>Opções - Drift Banners</h1>
    <form method="post" action="options.php" id="dft-organizador-settings" novalidate>
        <?php
            settings_fields('options_dft_banners');

            do_settings_sections('options_dft_banners');

            submit_button("Salvar alterações");    
        ?>
    </form>
</div>