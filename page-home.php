<?php
/**
 * Template Name: Home Page
 * The template for displaying the home page
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
$query_active_featured_deals = new WP_Query(['post_type' => 'deals','meta_key' => 'featured_offer', 'meta_value' => true]);

//Query our custom post types: deals
$query_active_top_deals = new WP_Query(['post_type' => 'deals',
                                        'posts_per_page' => 10,
                                        'meta_query' =>[
                                                        ['key'=> 'top_offer',
                                                        'compare' => 'LIKE',
                                                        'value' => true
                                                        ],
                                                        [   'key' =>'offer_expiration_date',
                                                            'type' => 'DATE'
                                                        ]

                                        ],
                                        'orderby' => ['offer_expiration_date'=>'ASC', 'top_offer'=> 'ASC']

                                     ]);

?>

    <div class="header-cta">

        <div class="container text-center header-content">
            <h1 class="header-cta-title">Never miss early bird discounts again</h1>
            <br>
            <h2>We help <span class="audience"></span>
                <br>like you get <strong><em>early access discount</em></strong> to
                <br>Conferences + Flights + Hotels</h2>
            <br>

            <br>
            <a class="btn-cta btn btn-lg" href="#top-early-birds">View Top Discounts</a>
        </div>

    </div>
 <!--
<div class="container">




    <div class="featured-items">
        <h1 class="text-center">featured early birds</h1>

        <div class="row">
            <?php if ($query_active_featured_deals->have_posts()):

            while($query_active_featured_deals->have_posts()) : $query_active_featured_deals->the_post(); ?>
            <div class="col-md-4">
                <div class="featured-item">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php the_field('offer_featured_photo')?>">

                        <div class="featured-content">
                            <p><?php the_title()?> - Save <strong> <?php the_field('savings_amount'); ?> </strong></p>

                                <div class="featured-bottom-card">

                                    <div class="expiration-time-wrapper">
                                        <p>expires in: </p>
                                        <div data-expiration-date="<?php $expiration_date = new DateTime( get_field('offer_expiration_date', false, false)); echo $expiration_date->format('Y/m/d') ?>" data-listing-id="<?php echo get_the_ID();?>" class="item-countdown item-countdown-deals-<?php echo get_the_ID();?>"></div>

                                    </div>

                                    <div class="item-featured-price-wrapper">
                                        <s> <?php the_field('offer_currency'); the_field('offer_regular_price');?> </s>
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
-->

<div class="subheader-cta" id="top-early-birds">
    <div class="container">
        <h1 class="text-center">top discounts</h1>
        <div class="col-md-12">

            <ul class="early-bird-items">

                <?php if ($query_active_top_deals->have_posts()):

                    while($query_active_top_deals->have_posts()) : $query_active_top_deals->the_post(); ?>
                        <li class="early-bird-item">

                            <div class="item-image col-md-2">
                                <img src="<?php echo get_field('offer_photo')? the_field('offer_photo'):get_template_directory_uri().'/assets/img/160x160.png';?>">
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
                    <?php endwhile; endif; ?>

            </ul>

            <div class="btn-wrapper-more-deals text-center">
                <a href="<?php echo site_url('deals')?>" class="button btn-primary btn-lg">View More Deals</a>
            </div>
        </div>

    </div>
</div>



<?php
//get_sidebar();
get_footer();
