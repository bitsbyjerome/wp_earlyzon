<?php
/**
 * Template Name: All Deals
 * The template for displaying all the active deals
 *
 * This is the template that displays all pages by default.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package EarlyZon
 */
get_header(); ?>

<?php
//Query our featured deals
$query_active_featured_deals = new WP_Query(['post_type' => 'deals', 'meta_key' => 'featured_offer', 'meta_value' => true]);
wp_reset_query();
//Query our custom post types: deals
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$query_active_deals = new WP_Query(['post_type' => 'deals',
                                    'orderby' => 'meta_value',
                                    'order'	=> 'ASC',
                                    'meta_type' => 'DATE',
                                    'meta_key' => 'offer_expiration_date',
                                    'posts_per_page' => 10,
                                    'paged' => $paged,
                                    'current' => $paged,
                                    'base' => get_pagenum_link(1) . '%_%'
                                    ]);

?>
 <?php if ($query_active_featured_deals->have_posts()):?>
    <div class="container">
        <div class="featured-items">
            <h1 class="text-center">featured early birds</h1>

            <div class="row">
                    <?php
                    while($query_active_featured_deals->have_posts()) : $query_active_featured_deals->the_post(); ?>
                        <div class="col-md-4">
                            <div class="featured-item">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php the_field('offer_featured_photo')?>">

                                    <div class="featured-content">
                                        <p><?php the_title()?> <strong><?php echo the_field('savings_amount')?'- Save '.the_field('savings_amount'):''  ?></strong>  </p>

                                        <div class="featured-bottom-card">

                                            <div class="expiration-time-wrapper">
                                                <p>expires in: </p>
                                                <div data-expiration-date="<?php $expiration_date = new DateTime( get_field('offer_expiration_date', false, false)); echo $expiration_date->format('Y/m/d') ?>" data-listing-id="<?php echo get_the_ID();?>" class="item-countdown item-countdown-deals-<?php echo get_the_ID();?>"></div>

                                            </div>

                                            <div class="item-featured-price-wrapper">
                                                <s> <?php echo get_field('offer_regular_price')? the_field('offer_currency'). the_field('offer_regular_price'):'';?> </s>
                                                <span class="item-price"> <?php the_field('offer_currency'); the_field('offer_discounted_price');?></span>
                                            </div>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endwhile; endif ?>

            </div>
        </div>
    </div>

    <div class="subheader-cta">
        <div class="container">
            <h1 class="text-center">active early birds</h1>
            <div class="col-md-12">
                <ul class="early-bird-items">

                    <?php if ($query_active_deals->have_posts()):

                        while($query_active_deals->have_posts()) : $query_active_deals->the_post(); ?>
                    <li class="early-bird-item <?php echo get_field('top_offer')?'sponsored':''; ?>">

                            <div class="item-image col-md-2">
                                <img src="<?php echo get_field('offer_photo')? the_field('offer_photo'): get_template_directory_uri().'/assets/img/160x160.png';?>">
                            </div>

                            <div class="item-content col-md-8">
                                <div class="item-title">
                                    <a href="<?php the_permalink(); ?>">
                                    <?php the_title()?> <?php echo get_field('savings_amount')?'- Save '.get_field('savings_amount'):''; ?>
                                    </a>
                                </div>

                                <?php if(get_field('offer_category') == 'conference'):?>
                                <div class="subtitle-wrapper col-md-12">
                                    <div class="item-date col-md-6"><i class="glyphicon glyphicon-calendar"></i>  <?php $date_from = new DateTime(get_field('offer_date_from', false, false)); echo $date_from->format('F d'); echo ' - '; $date_to = new DateTime(get_field('offer_to_date', false, false)); echo $date_from->format('F') == $date_to->format('F')? $date_to->format('d, Y'): $date_to->format('F d, Y'); ?></div>
                                    <div class="item-location col-md-6"><i class="glyphicon glyphicon-map-marker"></i> <?php the_field('offer_state'); echo ' - ';the_field('offer_country')?></div>
                                </div>
                                <?php endif;?>

                                <?php if(get_field('offer_category') == 'ebook'):?>
                                    <div class="subtitle-wrapper col-md-12">
                                        <div class="item-date col-md-6"><i class="glyphicon glyphicon-user"></i>  <?php the_field('offer_author_name'); ?></div>
                                    </div>
                                <?php endif;?>

                        <a href="<?php the_permalink(); ?>">
                                <div class="item-description">
                                    <?php the_field('offer_excerpt');?>
                                </div>
                                <div class="item-footer">
                                    <i class="glyphicon glyphicon-tag"></i> <?php the_field('offer_category'); ?>
                                </div>
                            </div>
                        </a>
                        <div class="item-expiration-time col-md-2">
                            <div class="expiration-time-wrapper">
                                <p>expires in: </p>
                                <div data-expiration-date="<?php $expiration_date = new DateTime( get_field('offer_expiration_date', false, false)); echo $expiration_date->format('Y/m/d') ?>" data-listing-id="<?php echo get_the_ID();?>" class="item-countdown item-countdown-deals-<?php echo get_the_ID();?>"></div>
                            </div>
                            <div class="item-price-wrapper">
                                <s><?php echo get_field('offer_regular_price')? the_field('offer_currency'). the_field('offer_regular_price'):'';?></s>
                                <span class="item-price"><?php the_field('offer_currency'); the_field('offer_discounted_price');?></span>
                            </div>
                            <a target="_blank" href="<?php the_field('offer_link')?>" class="btn btn-primary">Get This Deal</a>

                        </div>
                    </li>
                <?php endwhile;?>

                </ul>
                <div class="btn-wrapper-more-deals text-center">
                    <?php // echo get_next_posts_link( 'load more discount', $query_active_deals->max_num_pages ); // display older posts link ?>
                    <?php //echo get_previous_posts_link( 'view previous discount' ); // display newer posts link ?>
                    <a data-sumome-listbuilder-id="1441377c-0a95-44f5-ac99-51ce5144b62a" href="javascript:void(0)" class="button btn-primary btn-lg">Load more early birds</a>
                </div>
       <?php endif; ?>
        </div>

        </div>
    </div>



<?php
//get_sidebar();
get_footer();
