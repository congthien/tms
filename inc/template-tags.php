<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package tsm
 */

if ( ! function_exists( 'tsm_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function tsm_posted_on() {
	//$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	$time_string = '';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date('dS M, Y') )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'tsm' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'tsm' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on meta-data grid-item-meta"><i class="fa fa-calendar"></i>' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'tsm_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function tsm_entry_footer() {
	// Hide category and tag text for pages.
	if ('post' === get_post_type()) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html__('', 'tms'));
			if ($tags_list) {
					printf('<span class="tags-links">' . esc_html__('Tags &nbsp; %1$s', 'tms') . '</span>', $tags_list); // WPCS: XSS OK.
			}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'tsm' ), esc_html__( '1 Comment', 'tsm' ), esc_html__( '% Comments', 'tsm' ) );
		echo '</span>';
	}

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function tsm_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'tsm_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'tsm_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so tsm_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so tsm_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in tsm_categorized_blog.
 */
function tsm_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'tsm_categories' );
}
add_action( 'edit_category', 'tsm_category_transient_flusher' );
add_action( 'save_post',     'tsm_category_transient_flusher' );


function tms_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        // Display trackbacks differently than normal comments.
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php _e( 'Pingback:', 'tms' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'tms' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
        // Proceed with normal comments.
        global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment clearfix">

            <?php echo get_avatar( $comment, 60 ); ?>

            <div class="comment-wrapper">

                <header class="comment-meta comment-author vcard">
                    <?php
                        printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
                            get_comment_author_link(),
                            // If current post author is also comment author, make it known visually.
                            ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'tms' ) . '</span>' : ''
                        );
                        printf( '<a class="comment-time" href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            /* translators: 1: date, 2: time */
                            sprintf( __( '%1$s', 'tms' ), get_comment_date() )
                        );
                        comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'tms' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
                        edit_comment_link( __( 'Edit', 'tms' ), '<span class="edit-link">', '</span>' );
                    ?>
                </header><!-- .comment-meta -->

                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'tms' ); ?></p>
                <?php endif; ?>

                <div class="comment-content entry-content">
                    <?php comment_text(); ?>
                    <?php  ?>
                </div><!-- .comment-content -->

            </div><!--/comment-wrapper-->

        </article><!-- #comment-## -->
    <?php
        break;
    endswitch; // end comment_type check
}


function tsm_add_cart_to_wp_menu ( $items, $args ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if( 'top' === $args -> theme_location && is_plugin_active( 'woocommerce/woocommerce.php' )  ) {
		$items .= '<li class="facebook"><a href="'.WC()->cart->get_cart_url().'" title="'.__( 'View your shopping cart', 'tms' ).'"><i class="fa fa-shopping-cart"></i></a></li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items','tsm_add_cart_to_wp_menu',10,2);


function tsm_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'tsm_excerpt_more' );

function tsm_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'tsm_custom_excerpt_length', 999 );
