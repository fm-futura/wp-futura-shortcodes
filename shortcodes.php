<?php

function futura_shortcode_reproductoraudio($atts)
{
    $a = shortcode_atts(array(
        'mp3' => '',
        'ogg' => '',
        'type' => 'small',
        'color' => 'violet'
    ), $atts);
    if($a['mp3']!=''){
        include('widgets/audioPlayer/audioPlayer.php');
        return ob_get_clean();
    }
}


function wp_futura_shortcodes_init()
{
    wp_enqueue_style('futura_reproductoraudio_materialicons',   plugins_url('libs/materialicons/MaterialDesignIcons.css', __FILE__));
    wp_enqueue_script('futura_reproductoraudio_audioPlayer',    plugins_url('widgets/audioPlayer/audioPlayer.js',  __FILE__), array('jquery'));
    wp_enqueue_style('futura_reproductoraudio_audioPlayer',     plugins_url('widgets/audioPlayer/audioPlayer.css', __FILE__), array('futura_reproductoraudio_materialicons'));

    add_shortcode( 'reproductoraudio', 'futura_shortcode_reproductoraudio' );
}
add_action('init', 'wp_futura_shortcodes_init');
