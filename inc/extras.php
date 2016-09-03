<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package tms
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function tms_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$classes[] = 'header-style2 boxed';
	return $classes;
}
add_filter( 'body_class', 'tms_body_classes' );

function tms_custom_search_form( $form ) {

	$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div class="input-group">
			<input type="text" value="' . get_search_query() . '" name="s" id="s" class="form-control" placeholder="Search">
			<span class="input-group-btn">
				<button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
			</span>
    </div>
    </form>';

	return $form;
}
add_filter( 'get_search_form', 'tms_custom_search_form' );
