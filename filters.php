<?php

function futura_audiohome_filter($content)
{
    $pod = pods('post', get_the_ID());
    if ($pod->field('audio_home')) {
        $urls = explode(',', $pod->field('audio_home'));
        $home_player_content =  do_shortcode('[reproductoraudio type="small" mp3="' . $urls[0] . '" ogg="' . $urls[1] . '"]');
        return $home_player_content . $content;
    } else {
        return $content;
    }
}


function futura_author_filter()
{
    return;
}


function wp_futura_filters_init()
{
    add_filter('the_content', 'futura_audiohome_filter');
    add_filter('the_author',  'futura_author_filter');
}
add_action('init', 'wp_futura_filters_init');
