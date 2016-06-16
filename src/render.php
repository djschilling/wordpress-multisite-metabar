<?php

require_once 'Site.php';
require_once 'SiteCategory.php';
use mm\Site as Site;
use mm\SiteCategory as SiteCategory;

function register_custom_scripts()
{
    wp_register_style('mm_css', plugins_url('css/app.css', dirname(__FILE__)));
    wp_enqueue_style('mm_css');
}

add_action('wp_enqueue_scripts', 'register_custom_scripts');

function insert_multisite_metabar()
{
    $sites_shown = get_site_option('mm_metabar');
    $sites_shown_array = explode(',', $sites_shown);

    ?>
    <div id="mm-nav">
        <ul>
            <?php
            $site1 = new Site('foo', 'fooz');
            $foo = new Site('baz', "bar");
            $siteCategory = new SiteCategory('first category', [$site1, $foo]);
            foreach ($siteCategory->getSites() as $singleSite) {
                echo $singleSite->getName();
            }
            foreach ($sites_shown_array as $site) {
                $blog_details = get_blog_details($site);
                ?>
                <li class="mm-nav-item">
<!--                    <a href="--><?php //echo $blog_details->siteurl; ?><!--">--><?php //echo $blog_details->blogname; ?><!--</a>-->
                    <?php echo $blog_details->blogname?>
                    <div class="mm-subnav-wrapper hide">
                        <ul class="mm-subnav">
                            <li class="mm-subnav-item"><a href="http://localhost/"><?php echo $foo->getName()?></a></li>
                            <li class="mm-subnav-item"><a href="http://localhost">Website bearbeiten</a></li>
                        </ul>
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
    <script type="application/javascript">
        jQuery( document ).ready(function () {
            jQuery('.mm-nav-item').click(function () {
                jQuery(this).find('.mm-subnav-wrapper').toggleClass('hide');

            });
        });
    </script>
    <?php
}

add_action('wp_footer', 'insert_multisite_metabar');


