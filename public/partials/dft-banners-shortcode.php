<?php

function dft_banner_shortcode() {

    $args = array( 
        'post_type' => 'banners',
        'orderby' => 'menu_order',
        'order'   => 'ASC',
        'meta_query'   => array(
            array(

            )
        )
    );
    
    

    $loop = new WP_Query( $args );



    if( $loop->have_posts() ) : 

        echo '<div class="dft-banner">';

        while( $loop->have_posts() ) : $loop->the_post();

            $id = get_the_ID();
            $imagem_desktop = get_post_meta( $id, 'imagem_desktop', true);
            $imagem_mobile = get_post_meta( $id, 'imagem_mobile', true);
            $link_banner = get_post_meta( $id, 'link_banner', true);
            $target_blank = get_post_meta( $id, 'target_blank', true);

            $imagem_desktop_url = wp_get_attachment_image_url($imagem_desktop, 'dft-banners-desktop');
            $imagem_mobile_url = wp_get_attachment_image_url($imagem_mobile, 'dft-banners-mobile');

            if( !empty($imagem_desktop_url) && !empty($imagem_mobile_url) ) :
        ?>

            <div class="banner-fotos">
                <?php if( !empty($link_banner) ) echo '<a href="' . $link_banner . '" ' . ( $target_blank == 'true' ? 'target="_blank"' : '' ) . '>'; ?>
                    <?php if( !wp_is_mobile() ) : ?>
                        <img src="<?= $imagem_desktop_url ?>" alt="<?= get_the_title() ?>">
                    <?php else : ?>
                        <img src="<?= $imagem_mobile_url ?>" alt="<?= get_the_title() ?>">
                    <?php endif; ?>
                <?php if( !empty($link_banner) ) echo '</a>'; ?>
            </div>

        <?php
            endif;
        endwhile;

        echo '</div>';
        wp_reset_postdata();
    endif;

}

add_shortcode('dft-banner', 'dft_banner_shortcode');