<?php
/**
 * tms Theme Customizer.
 *
 * @package tms
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tms_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// remove default sections
	$wp_customize->remove_control( 'display_header_text' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'colors' );

	$categories  =  get_categories();
	$option_cats = array();
	foreach( $categories as $c ){
		$option_cats[ $c->term_id ] = $c->name;
	}

	$woos = get_terms( 'product_cat' );
	$woo_cats = array();
	foreach( $woos as $c ){
		$woo_cats[ $c->term_id ] = $c->name;
	}

		/*------------------------------------------------------------------------*/
		/*  Site Identity
		/*------------------------------------------------------------------------*/

		$wp_customize->add_setting( 'tms_site_image_logo',
			array(
				'sanitize_callback' => 'tms_sanitize_file_url',
				'default'           => ''
			)
		);
		$wp_customize->add_control( new WP_Customize_Image_Control(
						$wp_customize,
						'tms_site_image_logo',
						array(
							'label' 		=> esc_html__('Site Logo', 'tms'),
							'section' 		=> 'title_tagline',
							'description'   => esc_html__('Your site image logo', 'tms'),
						)
			)
		);

		$wp_customize->add_setting( 'tms_footer_copy_right',
			array(
				'sanitize_callback' => 'tms_sanitize_text',
				'default'           => ''
			)
		);



		/*------------------------------------------------------------------------*/
		/*  Section: Hero
		/*------------------------------------------------------------------------*/

		$wp_customize->add_panel( 'tms_hero_panel' ,
				array(
					'priority'        => 130,
					'title'           => esc_html__( 'Section: Hero', 'tms' ),
					'description'     => '',
					'active_callback' => 'tms_showon_frontpage'
				)
			);

			// Hero settings
			$wp_customize->add_section( 'tms_hero_first' ,
				array(
					'priority'    => 130,
					'title'       => esc_html__( 'Hero 1', 'tms' ),
					'description' => '',
					'panel'       => 'tms_hero_panel',
				)
			);
				//slide image 1
				$wp_customize->add_setting( 'tms_slide_image_one',
					array(
						'sanitize_callback' => 'tms_sanitize_file_url',
						'default'           => '',
					)
				);
				$wp_customize->add_control( new WP_Customize_Image_Control(
								$wp_customize,
								'tms_slide_image_one',
								array(
									'label' 		=> esc_html__('Slide Image', 'tms'),
									'section' 		=> 'tms_hero_first',
								)
					)
				);
				$wp_customize->add_setting( 'tms_slide_content_one',
					array(
						'sanitize_callback' => 'tms_sanitize_text',
						'default'           => '',
					)
				);
				$wp_customize->add_control( 'tms_slide_content_one',
					array(
						'label' 		=> esc_html__('Content Slide:', 'tms'),
						'type' => 'textarea',
						'section' 		=> 'tms_hero_first',
						'description'   => ''
					)
				);

				$wp_customize->add_section( 'tms_hero_second' ,
					array(
						'priority'    => 130,
						'title'       => esc_html__( 'Hero 2', 'tms' ),
						'description' => '',
						'panel'       => 'tms_hero_panel',
					)
				);
				//slide image 2
				$wp_customize->add_setting( 'tms_slide_image_second',
					array(
						'sanitize_callback' => 'tms_sanitize_file_url',
						'default'           => '',
					)
				);
				$wp_customize->add_control( new WP_Customize_Image_Control(
								$wp_customize,
								'tms_slide_image_second',
								array(
									'label' 		=> esc_html__('Slide Image', 'tms'),
									'section' 		=> 'tms_hero_second',
								)
					)
				);
				$wp_customize->add_setting( 'tms_slide_content_second',
					array(
						'sanitize_callback' => 'tms_sanitize_text',
						'default'           => '',
					)
				);
				$wp_customize->add_control( 'tms_slide_content_second',
					array(
						'label' 		=> esc_html__('Content Slide:', 'tms'),
						'type' => 'textarea',
						'section' 		=> 'tms_hero_second',
						'description'   => ''
					)
				);

				//slide image 3
				$wp_customize->add_section( 'tms_hero_third' ,
					array(
						'priority'    => 130,
						'title'       => esc_html__( 'Hero 3', 'tms' ),
						'description' => '',
						'panel'       => 'tms_hero_panel',
					)
				);
				$wp_customize->add_setting( 'tms_slide_image_third',
					array(
						'sanitize_callback' => 'tms_sanitize_file_url',
						'default'           => '',
					)
				);
				$wp_customize->add_control( new WP_Customize_Image_Control(
								$wp_customize,
								'tms_slide_image_third',
								array(
									'label' 		=> esc_html__('Slide Image', 'tms'),
									'section' 		=> 'tms_hero_third',
								)
					)
				);
				$wp_customize->add_setting( 'tms_slide_content_third',
					array(
						'sanitize_callback' => 'tms_sanitize_text',
						'default'           => '',
					)
				);
				$wp_customize->add_control( 'tms_slide_content_third',
					array(
						'label' 		=> esc_html__('Content Slide:', 'tms'),
						'type' => 'textarea',
						'section' 		=> 'tms_hero_third',
						'description'   => ''
					)
				);

				// INVOLVED section


					// Involved settings
					$wp_customize->add_section( 'tms_involved_settings' ,
						array(
							'priority'    => 131,
							'title'       => esc_html__( 'Involved Settings', 'tms' ),
							'description' => '',
						)
					);

					// Involved Title
					$wp_customize->add_setting( 'tms_involved_title',
						array(
							'sanitize_callback' => 'tms_sanitize_text',
							'default'           => esc_html__('Get Involved', 'tms'),
						)
					);
					$wp_customize->add_control( 'tms_involved_title',
						array(
							'label' 		=> esc_html__('Title:', 'tms'),
							'section' 		=> 'tms_involved_settings',
							'description'   => 'The Involved Title.'
						)
					);

					// Involved Description
					$wp_customize->add_setting( 'tms_involved_description',
						array(
							'sanitize_callback' => 'tms_sanitize_text',
							'default'           => esc_html__('Get Involved', 'tms'),
						)
					);
					$wp_customize->add_control( 'tms_involved_description',
						array(
							'label' 		=> esc_html__('Title:', 'tms'),
							'type'			=> 'textarea',
							'section' 		=> 'tms_involved_settings',
							'description'   => 'The Involved Description.'
						)
					);

					// Page  ids

					$wp_customize->add_setting( 'tms_page_ids',
						array(
							'sanitize_callback' => 'tms_sanitize_text',
							'transport' => 'refresh', // refresh or postMessage
						)
					);

					$wp_customize->add_control( 'tms_page_ids',
						array(
							'label' 		=> esc_html__('Page ids:', 'tms'),
							'type'			=> 'text',
							'section' 		=> 'tms_involved_settings',
							'description'   => 'Enter your page ids. separated by commas. Maximum should be 6.'
						)
					);



						// Upcoming Events
						$wp_customize->add_section( 'tms_upcoming_event' ,
							array(
								'priority'    => 132,
								'title'       => esc_html__( 'Upcoming Events', 'tms' ),
								'description' => '',
							)
						);

						$wp_customize->add_setting( 'tms_event_title',
							array(
								'sanitize_callback' => 'tms_sanitize_text',
								'default'		=> esc_html__( 'Upcoming events', 'tms' ),
							)
						);

						$wp_customize->add_control( 'tms_event_title',
							array(
								'label' 		=> esc_html__('Section title:', 'tms'),
								'type'			=> 'text',
								'section' 		=> 'tms_upcoming_event',
							)
						);

						// Featured Publications
						$wp_customize->add_section( 'tms_featured_publications' ,
							array(
								'priority'    => 133,
								'title'       => esc_html__( 'Featured Publications', 'tms' ),
								'description' => '',
							)
						);

						$wp_customize->add_setting( 'tms_featured_title',
							array(
								'sanitize_callback' => 'tms_sanitize_text',
								'default'		=> esc_html__( 'Featured Publications', 'tms' ),
							)
						);

						$wp_customize->add_control( 'tms_featured_title',
							array(
								'label' 		=> esc_html__('Section title:', 'tms'),
								'type'			=> 'text',
								'section' 		=> 'tms_featured_publications',
							)
						);

						$wp_customize->add_setting( 'tms_woo_category',
							array(
								'default'           => '0',
							)
						);
						$wp_customize->add_control( 'tms_woo_category',
							array(
								'label' 		=> esc_html__('WooCommerce Category:', 'tms'),
								'type'			=> 'select',
								'section' 	=> 'tms_featured_publications',
								'choices'   => $woo_cats
							)
						);


							// Quote Message
							$wp_customize->add_section( 'tms_quote_message' ,
								array(
									'priority'    => 134,
									'title'       => esc_html__( 'Quote Message', 'tms' ),
									'description' => '',
									//'panel'       => 'tms_quote_message_box',
								)
							);

							$wp_customize->add_setting( 'tms_message_box',
								array(
									'sanitize_callback' => 'tms_sanitize_text',
									'default'		=> esc_html__( 'Put a quote here if you want to or I can remove this', 'tms' ),
								)
							);

							$wp_customize->add_control( 'tms_message_box',
								array(
									'label' 		=> esc_html__('Message:', 'tms'),
									'type'			=> 'textarea',
									'section' 		=> 'tms_quote_message',
								)
							);

							// Latest news section
								$wp_customize->add_section( 'tms_latest_news' ,
									array(
										'priority'    => 135,
										'title'       => esc_html__( 'Latest News Settings', 'tms' ),
										'description' => '',

									)
								);

								//  Title
								$wp_customize->add_setting( 'tms_news_title',
									array(
										'sanitize_callback' => 'tms_sanitize_text',
										'default'           => esc_html__('Latest news', 'tms'),
									)
								);
								$wp_customize->add_control( 'tms_news_title',
									array(
										'label' 		=> esc_html__('Title:', 'tms'),
										'section' 		=> 'tms_latest_news',
										//'description'   => 'The Title.'
									)
								);

								//  Description
								$wp_customize->add_setting( 'tms_news_description',
									array(
										'sanitize_callback' => 'tms_sanitize_text',
										'default'           => esc_html__('', 'tms'),
									)
								);
								$wp_customize->add_control( 'tms_news_description',
									array(
										'label' 		=> esc_html__('Description:', 'tms'),
										'type'			=> 'textarea',
										'section' 		=> 'tms_latest_news',
										//'description'   => 'The Description.'
									)
								);

								$wp_customize->add_setting( 'tms_news_category',
									array(
										'default'           => '1',
									)
								);
								$wp_customize->add_control( 'tms_news_category',
									array(
										'label' 		=> esc_html__('Post Category:', 'tms'),
										'type'			=> 'select',
										'section' 	=> 'tms_latest_news',
										'choices'   => $option_cats
									)
								);


						// Accent section
							$wp_customize->add_section( 'tms_accent_section' ,
								array(
									'priority'    => 137,
									'title'       => esc_html__( 'Call To Action', 'tms' ),
									'description' => '',

								)
							);

									//  Title
									$wp_customize->add_setting( 'tms_accent_title',
										array(
											'sanitize_callback' => 'tms_sanitize_text',
											'default'           => esc_html__('To advance the knowledge of masonry', 'tms'),
										)
									);
									$wp_customize->add_control( 'tms_accent_title',
										array(
											'label' 		=> esc_html__('Title:', 'tms'),
											'section' 		=> 'tms_accent_section',
										)
									);

									//  Button text
									$wp_customize->add_setting( 'tms_button_text',
										array(
											'sanitize_callback' => 'tms_sanitize_text',
											'default'           => esc_html__('Join The Masonry Society', 'tms'),
										)
									);
									$wp_customize->add_control( 'tms_button_text',
										array(
											'label' 		=> esc_html__('Button Text:', 'tms'),
											'section' 		=> 'tms_accent_section',
										)
									);
									// button link
									$wp_customize->add_setting( 'tms_button_link',
										array(
											'sanitize_callback' => 'tms_sanitize_text',
											'default'           => esc_html__('#', 'tms'),
										)
									);
									$wp_customize->add_control( 'tms_button_link',
										array(
											'label' 		=> esc_html__('Button Link:', 'tms'),
											'section' 		=> 'tms_accent_section',
										)
									);

					// Partners
						$wp_customize->add_section( 'tms_partners_section' ,
							array(
								'priority'    => 136,
								'title'       => esc_html__( 'Partners', 'tms' ),
								'description' => '',

							)
						);

								//  Title
								$wp_customize->add_setting( 'tms_partners_title',
									array(
										'sanitize_callback' => 'tms_sanitize_text',
										'default'           => esc_html__('Our Supporting partners', 'tms'),
									)
								);
								$wp_customize->add_control( 'tms_partners_title',
									array(
										'label' 		=> esc_html__('Title:', 'tms'),
										'section' 		=> 'tms_partners_section',
									)
								);

					  // Footer Copyright
						$wp_customize->add_section( 'tms_footer_section' ,
							array(
								'priority'    => 138,
								'title'       => esc_html__( 'Footer', 'tms' ),
								'description' => '',

							)
						);
						$wp_customize->add_setting( 'tms_footer_copy_right',
							array(
								'sanitize_callback' => 'tms_sanitize_text',
								'default'           => esc_html__('&copy; 2016 The Masonry Society. All Rights Reserved. <br>Robinson Web Development', 'tms'),
							)
						);
						$wp_customize->add_control( 'tms_footer_copy_right', array(
						  'label' => __( 'Footer Copyright' ),
						  'type' => 'textarea',
						  'section' => 'tms_footer_section',
						) );

}
add_action( 'customize_register', 'tms_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function tms_customize_preview_js() {
	wp_enqueue_script( 'tms_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'tms_customize_preview_js' );


/*------------------------------------------------------------------------*/
/*  Tms Sanitize Functions.
/*------------------------------------------------------------------------*/

function tms_sanitize_file_url( $file_url ) {
	$output = '';
	$filetype = wp_check_filetype( $file_url );
	if ( $filetype["ext"] ) {
		$output = esc_url( $file_url );
	}
	return $output;
}

function tms_sanitize_text( $string ) {
	return wp_kses_post( balanceTags( $string ) );
}

function tms_showon_frontpage() {
	return is_page_template( 'template-frontpage.php' );
}
