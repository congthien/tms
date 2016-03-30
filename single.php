<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package tsm
 */

get_header(); ?>

	<div id="main-container" class="content-area">
		<main id="main" class="content" role="main">

				<div class="container">
					<!-- breadcrumn -->
					<div class="row">
						<ol class="breadcrumb">
							<li><a href="#">Home</a></li>
							<li><a href="blog-classic.html">News</a></li>
							<li class="active">2015 President's Award Presented to David I. McLean</li>
						</ol>
					</div>

					<div class="row">
								 <div class="col-md-8 content-block">
									<?php
									while ( have_posts() ) : the_post();

										get_template_part( 'template-parts/content',  'single' );

										the_post_navigation();

										// If comments are open or we have at least one comment, load up the comment template.
										if ( comments_open() || get_comments_number() ) :
											comments_template();
										endif;

									endwhile; // End of the loop.
									?>
								</div>


							<?php get_sidebar() ?>
					</div>

			</div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
