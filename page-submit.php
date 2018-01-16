<?php
/**
 * Template Name: Submit listing
 *
 *  This template displays single listing
 *
 * This is the template that displays all pages by default.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package EarlyZon
 */

get_header();
$options = [
    'submit_value' => 'Submit Listing',
    'fields_group' => '',
    'post_id' => 'new'
]
?>



    <div class="container">

       <div class="col-md-6 listing-section">
           <h1>Submit an early bird deal</h1>

           <?php echo do_shortcode('[contact-form-7 id="48" title="Submit Listing"]'); ?>
        <div class="standard-button-wrapper hidden">
           <?php echo do_shortcode('[wp_paypal button="buynow" return="" cancel_return="https://www.earlyzon.com/submit" name="Standard Plan" amount="300.00"]'); ?>
        </div>
        <div class="basic-button-wrapper hidden">
           <?php echo do_shortcode('[wp_paypal button="buynow" return="" cancel_return="https://www.earlyzon.com/submit" name="Basic Plan" amount="150.00"]'); ?>
        </div>
       </div>

        <div class="col-md-6 packages-description">

            <div class="packages-wrapper">
                <div class="package">
                    <div class="package-title">
                        <h4>Standard Plan ($300) </h4>
                    </div>

                    <p>This plan has the following benefits</p>
                    <ul>
                        <li>

                            <span>Your listing will appear in our Home Page Top Offers Section</span>

                        </li>
                        <li>
                            <span>Your listing will be highlithed among others</span>
                        </li>
                        <li>
                            <span>No monthly fees. Your listing will end until the early bird expiration date. </span><em> <strong>Limited time Offer</strong></em>
                        </li>

                        <!--
                        <li>

                            <span>We will tweet about your listing to our Twitter followers</span>
                        </li>
                        <li>
                            <span>Your deal will appear on our weekly newsletter</span>
                        </li>
                        -->
                    </ul>
                    <em class="limited-spot">Only <strong>1</strong> spot available</em>
                </div>

                <!--
                <h4>Basic Plan ($150)</h4>
                <p>This plan comes with the following benefits</p>
                <ul>
                    <li>
                        All deals sponsored:
                        <span>Your listing will be highlithed among others</span>
                    </li>
                    <li>
                        Sponsored tweet : Twice
                        <span>We will tweet about your listing to our Twitter followers</span>
                    </li>
                </ul>
                -->
                <div class="package">
                    <div class="package-title">
                        <h4>FREE</h4>
                    </div>
                    <p>Your listing will be reviewed then published if it meets our listing guidelines.</p>
                </div>
            </div>

        </div>


    </div>

    <div class="container">
        <div class="row">
            <div class="col-8">
                <p class="lead">Terms</p>
                <ul>
                    <li>Listing runs until early bird end date</li>
                    <li>All listing prices are in USD</li>
                    <li>We reserve the right to modify or remove any listing</li>
                    <li><strong>There are no refunds</strong> (aside from jobs we remove)</li>
                    <li>Need help or have questions? Contact us</li>
                </ul>
            </div>
        </div>

    </div>

<?php
//get_sidebar();
get_footer();

