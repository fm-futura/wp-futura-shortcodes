<?php

function futura_get_audiohome_urls($post_id = NULL)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $pod = pods('post', $post_id);
    return  $pod->field('audio_home');
}

function futura_get_audiohome_player($post_id = NULL)
{
    $urls = futura_get_audiohome_urls($post_id);
    if ($urls) {
        $urls = explode(',', $urls);

        $mp3 = $urls[0];
        $ogg = '';

        if (count($urls) > 1) {
            $ogg = $urls[1];
        }

        $home_player_content =  do_shortcode('[reproductoraudio type="small" mp3="' . $mp3 . '" ogg="' . $ogg . '"]');
        return $home_player_content;

    } else {
        return '';
    }
}

function futura_audiohome_filter($content)
{
    $home_player_content = futura_get_audiohome_player();
    return $home_player_content . $content;
}


function futura_author_filter()
{
    return;
}


function futura_get_the_date_filter($the_date, $d = NULL, $post = NULL)
{
    if (is_single()) {
        return $the_date;
    } else {
        return false;
    }
}


function futura_post_thumbnail_html_filter($html, $post_id = NULL, $post_thumbnail_id = NULL, $size = NULL, $attr = NULL)
{
    if (is_single()) {
        return false;
    } else {
        return $html;
    }
}


function wp_futura_filters_init()
{
    // This clashes with the new theme and results in a duplicated player.
    add_filter('the_content',           'futura_audiohome_filter');
    add_filter('the_author',            'futura_author_filter');
    add_filter('get_the_date',          'futura_get_the_date_filter');

    add_filter('run_wptexturize',       '__return_false');
}
add_action('init', 'wp_futura_filters_init');
