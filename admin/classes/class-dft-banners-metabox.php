<?php

abstract class Dft_Banners_Config {


    public static function addMetaBox() {
        add_meta_box(
            'conteudo_banner',   
            'Conteúdo do Banner',     
            array('Dft_Banners_Metabox', 'htmlMetabox'),  
            'banners',
            'normal'              
        );
    }

    public static function saveMetabox($post_id) {

        if (array_key_exists('imagem_desktop', $_POST)) {

            update_post_meta(
                $post_id,
                'descricao_vaga',
                $_POST['descricao']
            );

        }

        if (array_key_exists('imagem_mobile', $_POST)) {

            update_post_meta(
                $post_id,
                'descricao_vaga',
                $_POST['descricao']
            );

        }

        if (array_key_exists('imagem_mobile', $_POST)) {

            update_post_meta(
                $post_id,
                'descricao_vaga',
                $_POST['descricao']
            );

        }
        
    }

    public static function htmlMetabox($post) {

        $descricao = get_post_meta($post->ID, 'descricao_vaga', true);

        ?>
            <div class="fields-row">
                <div class="field-group with-action">
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
                        <a class="button wp-media-upload">Adicionar imagem</a>
                        <input type="hidden" name="imagem_desktop" id="imagem_mobile">
                    </div>
                </div>
                <div class="field-group with-action">
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
                        <a class="button wp-media-upload">Adicionar imagem</a>
                        <input type="hidden" name="imagem_mobile" id="imagem_mobile">
                        <div class="actions">
                        </div>
                    </div>
                </div>
            </div>
            <div class="field-group">
                <label class="label" for="imagem_desktop">Link para o banner</label>
                <p class="descricao">Cole o link para seu banner. Ex.: https://seusite.com.br/produtos</p>
                <input class="text" type="url" name="link_banner">
            </div>
        <?php
    }

}