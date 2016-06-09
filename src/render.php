<?php
function register_custom_scripts()
{
    wp_register_style('mm_css', plugins_url('css/app.css', dirname(__FILE__)));
    wp_enqueue_style('mm_css');
}

add_action('wp_enqueue_scripts', 'register_custom_scripts');

function insert_multisite_metabar()
{
    $sites_shown = get_option('sites_shown');
    $sites_shown_array = explode(',', $sites_shown);

    ?>
    <div id="ms_navbar">
        <ul>
            <?php
            foreach ($sites_shown_array as $site) {
               $blog_details = get_blog_details($site);
               echo '<li><a href="'.$blog_details->siteurl.'">'.$blog_details->blogname.'</a></li>';
            }
            ?>
        </ul>
    </div>
    <?php
}

add_action('wp_footer', 'insert_multisite_metabar');
