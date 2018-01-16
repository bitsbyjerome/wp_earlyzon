<?php
/**
 * This template displays single listing
 */

get_header(); ?>



    <div class="container">

        <div class="offer-wrapper">
            <div class="offer-meta">
                <div class="col-lg-8">
                    <h1><?php the_title() ?></h1>
                    <div class="offer-subtitle">
                        <?php if(get_field('offer_category') == 'conference'):?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="offer-meta-column">
                                        <div class="offer-date"><i class="glyphicon glyphicon-calendar"></i>  <?php $date_from = new DateTime(get_field('offer_date_from', false, false)); echo $date_from->format('F d'); echo ' - '; $date_to = new DateTime(get_field('offer_to_date', false, false)); echo $date_from->format('F') == $date_to->format('F')? $date_to->format('d, Y'): $date_to->format('F d, Y'); ?></div>
                                        <div class="offer-location"><i class="glyphicon glyphicon-map-marker"></i> <?php the_field('offer_state'); echo ' - ';the_field('offer_country')?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="offer-meta-column">
                                        <?php if(get_field('savings_amount')): ?>
                                            <div class="offer-date offer-category"><i class="glyphicon glyphicon-usd"></i> <strong> Save <?php the_field('savings_amount')?> </strong></div>
                                        <?php endif; ?>
                                        <div class="offer-expiration-time-wrapper">
                                            <div class="offer-expiration-label"> <i class="glyphicon glyphicon-time"></i> expires in: </div>
                                            <div data-expiration-date="<?php $expiration_date = new DateTime( get_field('offer_expiration_date', false, false)); echo $expiration_date->format('Y/m/d') ?>" data-listing-id="<?php echo get_the_ID();?>" class="item-countdown item-countdown-deals-<?php echo get_the_ID();?>"></div>
                                            <div class="item-countdown"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(get_field('offer_category') == 'ebook'):?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="offer-meta-column">

                                    <div class="offer-author"><i class="glyphicon glyphicon-user"></i>  <?php the_field('offer_author_name'); ?></div>

                                    <div class="offer-expiration-time-wrapper">
                                        <div class="offer-expiration-label"> <i class="glyphicon glyphicon-time"></i> expires in: </div>
                                        <div data-expiration-date="<?php $expiration_date = new DateTime( get_field('offer_expiration_date', false, false)); echo $expiration_date->format('Y/m/d') ?>" data-listing-id="<?php echo get_the_ID();?>" class="item-countdown item-countdown-deals-<?php echo get_the_ID();?>"></div>
                                        <div class="item-countdown"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="offer-meta-column">

                                    <div class="offer-date offer-category"><i class="glyphicon glyphicon-usd"></i> <strong> Save <?php the_field('savings_amount')?> </strong></div>

                                </div>
                            </div>
                        </div>
                        <?php endif;?>

                    </div>
                    <?php if(get_field('offer_category') == 'conference'):?>
                    <h3>About the event</h3>
                    <?php elseif(get_field('offer_category') == 'ebook'):;?>
                    <h3>About this e-book</h3>
                    <?php endif;?>
                    <div class="offer-description">
                        <?php the_field('offer_description') ?>
                    </div>
                    <div class="btn-wrapper-more-deals text-center">
                        <a href="<?php the_field('offer_link') ?>" target="_blank" class="button btn-primary btn-lg">grab this discount</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php
//get_sidebar();
get_footer();

