<?php
defined( 'ABSPATH' ) || exit;



function alternis_register_main_options_metabox() {

	$main_options = new_cmb2_box( array(
		'id'           => 'alternis_main_options',
		'object_types' => array( 'options-page' ),
		'tab_group'    => 'alternis_options_tabs',
		'menu_title'   => esc_html__( 'Main Options', 'alternis' ),
		'title'        => esc_html__( 'Main Options', 'alternis' ),
		'tab_title'    => esc_html__( 'Main Options', 'alternis' ),
		'option_key'      => 'alternis_main_options', // The option key and admin menu page slug.
		'position'        => 2, // Menu position. Only applicable if 'parent_slug' is left empty.
	) );

	$main_options->add_field( array(
		'name' => '<h1>Global<h1>',
		'type' => 'title',
		'id'   => 'alternis_global_id'
	) );

	$main_options->add_field( array(
	'name' => "Logo Image",
	'id'   => "alternis_header_logo",
	'type' => 'file',
	) );

	$social_group_id = $main_options->add_field( array(
		'name' => 'Social Links',
		'id'          => 'alternis_social_group',
		'type'        => 'group',
		'repeatable'  => true,
		'options'     => array(
			'group_title'   => 'Link #{#}',
			'add_button'    => 'Add Another Post',
			'remove_button' => 'Remove Post',
			'closed'        => true,  // Repeater fields closed by default - neat & compact.
			'sortable'      => true,  // Allow changing the order of repeated groups.
		),
	) );

	$main_options->add_group_field( $social_group_id, array(
		'name' => 'Social Name',
		'id'   => 'alternis_social_name',
		'type' => 'text',
	) );

	$main_options->add_group_field( $social_group_id, array(
		'name' => 'Social Icon',
		'id'   => 'alternis_social_icon',
		'description' => 'To use the Font Awesome icons',
		'type' => 'text',
	) );

	$main_options->add_group_field( $social_group_id, array(
		'name' => 'Social URL',
		'id'   => 'alternis_social_link',
		'type' => 'text_url',
	) );



	// -------------
    
	$main_options->add_field( array(
		'name' => '<h1>Header<h1>',
		'type' => 'title',
		'id'   => 'alternis_header_id'
	) );


	$main_options->add_field( array(
	'name' => "Text Info",
	'id'   => "alternis_header_text",
	'type' => 'text',
	) );

	$main_options->add_field( array(
		'name' => "Brands Banner",
		'id'   => "alternis_header_banner",
		'type' => 'textarea',
	) );

	$main_options->add_field( array(
    'name' => 'Navigation Star',
    'id'   => 'alternis_header_navigation_star',
    'type' => 'checkbox',
	) );



	// ----------------------------------

	$main_options->add_field( array(
		'name' => '<h1>Footer<h1>',
		'type' => 'title',
		'id'   => 'alternis_footer'
	) );

		$main_options->add_field( array(
    'name' => 'Instagram',
    'desc' => '',
    'id'   => 'alternis_footer_inst',
    'type' => 'file_list',
    // 'preview_size' => array( 180, 180 ), // Default: array( 50, 50 )
    // 'query_args' => array( 'type' => 'image' ), // Only images attachment
    // Optional, override default text strings
    'text' => array(
        'add_upload_files_text' => 'Replacement', // default: "Add or Upload Files"
        'remove_image_text' => 'Replacement', // default: "Remove Image"
        'file_text' => 'Replacement', // default: "File:"
        'file_download_text' => 'Replacement', // default: "Download"
        'remove_text' => 'Replacement', // default: "Remove"
    ),
		) );

	$main_options->add_field( array(
		'name' => "Subscribe Form",
		'id'   => "alternis_footer_subscribe",
		'type' => 'textarea',
	) );
	
	$main_options->add_field( array(
		'name' => "Copyright",
		'id'   => "alternis_footer_copyright",
		'type' => 'textarea',
	) );

	$main_options->add_field( array(
		'name' => "Copyright Link",
		'id'   => "alternis_footer_copyright_link",
		'type' => 'text_url',
	) );

	/**
	 * Blog page
	*/

	$blog = new_cmb2_box(array(
		'id'           => 'alternis_blog',
		'title'        => esc_html__( 'Blog Page', 'alternis' ),
		'object_types' => array( 'options-page' ),
		'parent_slug'  => 'alternis_main_options',
		'option_key'   => 'alternis_blog',
		'tab_group'    => 'alternis_options_tabs',
		'tab_title'    => 'Blog Page',
	));

	$blog->add_field( array(
	'name' => "Banner Background",
	'id'   => "alternis_blog_banner",
	'type' => 'file',
	) );


}

add_action( 'cmb2_admin_init', 'alternis_register_main_options_metabox' );