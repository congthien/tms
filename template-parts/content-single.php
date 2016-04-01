<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package tms
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		  <?php
			if ( is_single() ) {
				the_title( '<h3 class="entry-title">', '</h3>' );
			} else {
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			}
      ?>
	</header><!-- .entry-header -->

	<div class="entry-content post-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tms' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
    <div class="tag-cloud">
      <?php tms_entry_footer(); ?>
    </div>

    <!-- About Author -->
    <section class="about-author">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 96, '', 'avatar' , array( 'class' => 'img-thumbnail') ); ?>

        <div class="post-author-content">
            <h3><?php the_author(); ?> <span class="label label-primary"><?php echo __('Author', 'tms'); ?></span></h3>
            <p><?php the_author_meta('description'); ?></p>
        </div>
    </section>
    <!-- Pagination -->

    <!-- Previous/next post navigation. -->
    <ul class="pager">
        <li class="pull-left"><?php previous_post_link( '%link', '&larr; Prev Post', TRUE ); ?></li>
        <li class="pull-right"><?php next_post_link( '%link', 'Next Post &rarr;', TRUE ); ?></li>
    </ul>


	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
