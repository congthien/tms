<?php
/**
 * Template Name: Front Page
 *
 * @package tsm
 */

get_header(); ?>

<!-- Hero Area -->
<div class="hero-area">

  <!-- Start Hero Slider -->
    <div class="flexslider heroflex hero-slider" data-autoplay="yes" data-pagination="no" data-arrows="yes" data-style="fade" data-pause="yes">
        <ul class="slides">
            <li class="parallax" style="background-image:url(<?php echo esc_url( get_theme_mod('tms_slide_image_one') ); ?>)">
              <div class="flex-caption">
                  <div class="container">
                      <div class="flex-caption-table">
                          <div class="flex-caption-cell">
                              <div class="flex-caption-text">
                                    <?php printf(  get_theme_mod( 'tms_slide_content_one' ) ); ?>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="parallax" style="background-image:url(<?php echo esc_url( get_theme_mod('tms_slide_image_second') ); ?>)">
              <div class="flex-caption">
                  <div class="container">
                      <div class="flex-caption-table">
                          <div class="flex-caption-cell">
                              <div class="flex-caption-text text-align-center">
                                    <?php printf( get_theme_mod( 'tms_slide_content_second' )); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="parallax" style="background-image:url(<?php echo esc_url( get_theme_mod('tms_slide_image_third') ); ?>)">
              <div class="flex-caption">
                  <div class="container">
                      <div class="flex-caption-table">
                          <div class="flex-caption-cell text-align-center">
                            <div class="flex-caption-cause">
                              <?php printf( get_theme_mod( 'tms_slide_content_third' )); ?>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <!-- End Hero Slider -->
</div>

<div id="main-container" class="content-area">
  <div class="content">

    <!-- start 1st row focus groups -->
            <div class="container">
              <div class="row">
                  <div class="spacer-50"></div>
                  <div class="col-md-3 col-sm-12">
                    <h3 class="home-widget-title"><?php printf( esc_html( get_theme_mod( 'tms_involved_title', esc_html__('Get Involved', 'tms') ) ) ); ?></h3>
                    <p><?php printf( esc_html( get_theme_mod( 'tms_involved_description' ) ) ); ?></p>
                  </div>

                  <?php
                  $page_ids = explode( ',', trim( get_theme_mod( 'tms_page_ids' ) ) );

                  $i = 0;
                  $in_pages = new WP_Query( array( 'post_type' => 'page', 'post__in' =>  $page_ids, 'order' => 'asc', 'posts_per_page' => 6 ) );

                  if ( $in_pages ) {

                    while( $in_pages->have_posts() ) : $in_pages->the_post();
                    $page_button_text = get_post_meta( get_the_ID(), 'button_text', true );

                    $push_col = ( $i > 2 ) ? 'col-lg-push-3' : '';

                    ?>
                      <div class="col-md-3 col-sm-6 <?php echo $push_col; ?>">
                        <div class="featured-block">
                              <figure>
                                <a href="<?php the_permalink(); ?>">
                                      <?php
                                        if ( has_post_thumbnail() ) {
                                          the_post_thumbnail( 'tsm_blog_medium', array( 'class' => 'hidden-xs hidden-sm' ) );
                                        } else {
                                          echo '<img src="'. get_template_directory_uri() .'/assets/images/default-thumbnail.png" alt="" class="hidden-xs hidden-sm" />';
                                        }
                                      ?>

                                      <span class="caption"><?php the_title() ?></span><h4 class="visible-xs visible-sm"><?php the_title() ?></h4>
                                  </a>
                              </figure>
                              <p><?php the_excerpt(); ?></p>
                              <?php if ( '' != $page_button_text ) { ?>
                                <a href="<?php the_permalink(); ?>" class="basic-link"><?php echo esc_attr( $page_button_text ) ?></a><span class="visible-xs visible-sm"><hr/></span>
                              <?php } ?>

                          </div>
                      </div>

                    <?php
                    if ( $i == 2 ) {
                      echo '<div class="spacer-50 hidden-xs hidden-sm"></div>';
                    }

                    $i++;
                    endwhile;
                  }
                  wp_reset_query();
                  ?>


                </div>
        </div>
        <!-- end 2nd row focus groups -->
        <div class="spacer-50 hidden-xs hidden-sm"></div>

        <div class="lgray-bg padding-tb20">
                <div class="container">
                    <div class="row">
                        <a href="#" class="col-md-4 col-sm-4"></a>
                        <a href="#" class="col-md-4 col-sm-4"></a>
                        <a href="#" class="col-md-4 col-sm-4"></a>
                    </div>
                </div>
        </div>

        <!-- Upcomming event section -->
        <div class="padding-tb50 position-relative">
          <div class="half-bg-right lgray-bg"></div>
          <div class="container">
              <div class="row">
                    <div class="col-md-6 padding-tb20">
                      <h2 class="block-title padding-tb20"><?php printf( esc_html( get_theme_mod( 'tms_event_title', esc_html__( 'Upcoming events', 'tms' ) ) ) ); ?></h2>
                        <div class="spacer-20"></div>
                        <?php
                        global $post;
                        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                        if ( is_plugin_active( 'the-events-calendar/the-events-calendar.php' ) ) {
                            $events = tribe_get_events( array(
                                'posts_per_page' => 4,
                                'start_date' => current_time( 'Y-m-d' ),
                            ) );
                            if ( $events ) {
                                echo "<ul class='events-compact-list'>";
                                foreach ( $events as $post ) {
                                    setup_postdata( $post );
                                    ?>

                                    <li class="event-list-item">
                                      <span class="event-date">
                                            <span class="date"><?php echo tribe_get_start_date($post, false, 'd'); ?></span>
                                            <span class="month"><?php echo tribe_get_start_date($post, false, 'M'); ?></span>
                                            <span class="year"><?php echo tribe_get_start_date($post, false, 'Y'); ?></span>
                                        </span>
                                        <div class="event-list-cont">
                                            <span class="meta-data"><?php echo tribe_get_start_date( null, false, 'l, h:i A'); ?></span>
                                            <h4 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                                            <?php the_excerpt(); ?>
                                        </div>
                                    </li>

                                    <?php
                                }
                                echo "</ul>";
                            }
                        }
                        ?>
                            <div class="spacer-40"></div>
                    </div>

                    <!-- Featured products -->
                    <div class="col-md-6">
                            <div class="container-fluid">
                                <div class="row-fluid">
                                    <div class="col-lg-12">
                                        <h2 class="page-header text-center"><?php printf( esc_html( get_theme_mod( 'tms_featured_title', esc_html__( 'Featured Publications', 'tms' ) ) ) ); ?></h2>
                                    </div>

                                    <?php
                                    $arr = array( 'post_type' => 'product', 'posts_per_page' => 4 );
                                    $w_id = get_theme_mod( 'tms_woo_category' );
                                    if ( '' != $w_id ) {
                                      $arr['tax_query'] = array(
                                            array(
                                              'taxonomy' => 'product_cat',
                                              'field'    => 'term_id',
                                              'terms'    => $w_id,
                                            ),
                                      );
                                    }

                                    $tms_products = new WP_Query( $arr );

                                    if ( $tms_products ) {
                                      while ( $tms_products -> have_posts() ) {
                                        $tms_products -> the_post();

                                        ?>
                                        <div class="col-md-6 col-sm-6 col-xs-6 thumb">
                                            <div class="thumbnail" href="#">
                                              <a href="<?php the_permalink() ; ?>" class="img-thumbnail">
                                                <?php the_post_thumbnail( 'tms_product_thumb' ); ?>
                                              </a>
                                            </div>
                                        </div>

                                        <?php
                                      }
                                    }
                                    wp_reset_query();
                                    ?>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $quote_meg = get_theme_mod( 'tms_message_box' );
        if ( ! empty( $quote_meg ) ) {
        ?>
        <div class="container">
              <div class="text-align-center partner-carousel"><div class="spacer-20"></div>
                    <h2 class="block-title block-title-center">"<?php printf( esc_html( $quote_meg ) ); ?>"</h2>
                </div>
        </div>
        <?php } ?>

        <!-- Latest News -->
        <?php
        $n_title = get_theme_mod( 'tms_news_title', esc_html__( 'Latest News Settings', 'tms' ) );
        $n_description = get_theme_mod( 'tms_news_description' );
        ?>
        <div class="padding-tb75 lgray-bg">
          <div class="container">
              <div class="row">
                  <div class="col-md-4 col-sm-4">
                      <h2 class="block-title"> <?php printf( esc_html( $n_title ) ); ?> </h2>
                        <p><?php printf( esc_html( $n_description ) ); ?></p>
                    </div>

                    <?php
                      $cat_id = get_theme_mod( 'tms_news_category' );
                      $args = array('posts_per_page' => 2 );
                      if ( '' != $cat_id ) {
                        $args['cat'] = $cat_id;
                      }

                      $posts = new WP_Query( $args );
                      if ( $posts->have_posts() ) :
                    ?>
                        <div class="col-md-8 col-sm-8">
                            <div class="carousel-wrapper">
                                <div class="row">
                                    <ul class="owl-carousel carousel-fw" id="news-slider" data-columns="2" data-autoplay="" data-pagination="yes" data-arrows="no" data-single-item="no" data-items-desktop="2" data-items-desktop-small="1" data-items-tablet="1" data-items-mobile="1">

                                      <?php while ( $posts->have_posts() ) : $posts->the_post() ; ?>

                                        <li class="item">
                                            <div class="grid-item blog-grid-item format-standard">
                                                <div class="grid-item-inner">

                                                    <a href="<?php the_permalink(); ?>" class="media-box">
                                                      <?php if ( has_post_thumbnail() ) {
                                                        the_post_thumbnail( 'tsm_blog_medium' );
                                                      } ?>
                                                    </a>
                                                    <div class="grid-item-content">
                                                        <h3 class="post-title">
                                                          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        </h3>
                                                        <span class="meta-data">
                                                          <?php printf( __( 'Posted on %s', 'tsm' ), get_the_date( 'dS M, Y' ) ); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                      <?php endwhile; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                  <?php endif; ?>
                  <?php wp_reset_query(); ?>
                </div>
            </div>
        </div>


        <!-- Partner Carousel -->
        <div class="partner-carousel">
          <div class="container">
              <div class="row">
                  <div class="col-md-3 col-sm-3">
                      <h4 class="push-top"> <?php printf( esc_html( get_theme_mod( 'tms_partners_title', esc_html__( 'Our Supporting partnersy', 'tms' ) ) ) ); ?> </h4>
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <div class="carousel-wrapper">
                            <div class="row">
                                <ul class="owl-carousel carousel-fw" id="partners-slider" data-columns="5" data-autoplay="5000" data-pagination="no" data-arrows="no" data-single-item="no" data-items-desktop="4" data-items-desktop-small="3" data-items-tablet="3" data-items-mobile="2">
                                    <li class="item"><img src="http://placehold.it/250x110&amp;text=IMAGE+PLACEHOLDER" alt=""></li>
                                    <li class="item"><img src="http://placehold.it/250x110&amp;text=IMAGE+PLACEHOLDER" alt=""></li>
                                    <li class="item"><img src="http://placehold.it/250x110&amp;text=IMAGE+PLACEHOLDER" alt=""></li>
                                    <li class="item"><img src="http://placehold.it/250x110&amp;text=IMAGE+PLACEHOLDER" alt=""></li>
                                    <li class="item"><img src="http://placehold.it/250x110&amp;text=IMAGE+PLACEHOLDER" alt=""></li>
                                    <li class="item"><img src="http://placehold.it/250x110&amp;text=IMAGE+PLACEHOLDER" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $button_link = get_theme_mod( 'tms_button_link' );
        $button_text = get_theme_mod( 'tms_button_text' );
        $accent_title = get_theme_mod( 'tms_accent_title' );
        if ( ! empty( $accent_title ) ) {
        ?>
        <div class="accent-bg padding-tb20 cta-fw">
            <div class="container">
                <?php printf( __( '<a href="%1$s" class="btn btn-default btn-ghost btn-light btn-rounded pull-right">%2$s</a>', 'tms' ), $button_link, $button_text ); ?>
                <h4>"<?php printf( esc_html__( $accent_title ) ); ?>"</h4>
            </div>
        </div>
        <?php  } ?>

  </div><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
