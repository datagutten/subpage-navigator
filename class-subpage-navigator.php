<?php
/**
 * Summary (no period for file headers)
 *
 * Description. (use period)
 *
 * @link URL
 *
 * @package Subpage navigator
 *
 * @version 0.1
 */

/**
 * Plugin main class
 */
class Subpage_Navigator {
	/**
	 * DomDocument class
	 *
	 * @var DOMDocument
	 */
	public $dom;
	/**
	 * Constructor
	 * Creates DOMDocument instance
	 */
	function __construct() {
		$this->dom = new DOMDocument;
		$this->dom->formatOutput = true;
		// Initialize the plugin on WordPress initialization.
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

	}
	/**
	 * Create a <ul> list of sub pages recursing into the given depth
	 *
	 * @param string $post_id   post id.
	 * @param int    $depth recursion depth (how many levels of sub pages to display).
	 * @param array  $atts attributes.
	 * @param int    $current_depth  used while recursing to keep current depth.
	 *
	 * @return domDocument ul object
	 */
	function list_children( $post_id, $depth, $atts, $current_depth = 0 ) {
		global $post;
		/**
		* Arguments for get_pages
		*/
		$args = array(
			'sort_order' => $atts['sort_order'],
			'sort_column' => $atts['sort_by_values'],
			'parent' => $post_id,
			'post_status' => 'publish',
			'post_type' => 'page',
		);
		if ( current_user_can( 'read_private_pages' ) ) {
			$args['post_status'] = 'publish,private';
		}
		else
			$args['post_status'] = 'publish';
		$pages = get_pages( $args );
		if ( 0 === $current_depth ) {
			$current_depth = 1;
			// If a top level page has no children, show other top level pages.
			if ( '0' === $post->post_parent && empty( $pages ) ) {
				$args['parent'] = '0';
				$args['hierarchical'] = false;
				$pages = get_pages( $args );
			}
		} else {
			$current_depth++;
		}

		if ( empty( $pages ) ) {
			return false;
		}

		$ul = $this->dom->createElement( 'ul' );

		foreach ( $pages as $current_post ) {
			$li = $this->dom->createElement( 'li' );
			$ul->appendChild( $li );
			$li->setAttribute( 'class','level' . $current_depth );

			$a = $this->dom->createElement( 'a', $current_post->post_title );
			$a->setAttribute( 'href', $current_post->guid );
			$li->appendChild( $a );

			if ( 0 === $depth || $current_depth < $depth ) {
				$ul_sub = $this->list_children( $current_post->ID, $depth, $atts,$current_depth );
				if ( false !== $ul_sub ) {
					$li->appendChild( $ul_sub );
				}
			}
		}
		return $ul;
	}
	/**
	 * Initialize
	 * Register shortcode
	 */
	function init() {
		add_shortcode( 'subpages', array( $this, 'shortcode' ) );
		load_plugin_textdomain( 'subpage-navigator', false, basename( dirname( __FILE__ ) ) . '/languages' );

	}
	/**
	 * Shortcode handler
	 *
	 * @param array $atts shortcode attributes.
	 */
	function shortcode( $atts ) {
		global $post;
		$atts = shortcode_atts(array(
						'title' => false,
						'sort_order' => 'ASC',
						'sort_by_values' => 'page_title',
						'exclude_page_id' => '',
						'depth' => 1,
						'sort_order_parent' => 'ASC',
		), $atts);
		$atts['depth'] = (int) $atts['depth'];

		$ul = $this->list_children( $post->ID, $atts['depth'], $atts );
		if ( false === $ul ) {
			return;
		}

		$div = $this->dom->createElement( 'div' );
		$div->setAttribute( 'class','subpages_container' );

		if ( ! empty( $atts['title'] ) ) {
			$h3 = $this->dom->createElement( 'h3',$atts['title'] );
			$h3->setAttribute( 'class','widget_title' );
			$div->appendChild( $h3 );
		}

		$ul->setAttribute( 'class','ls_page_list' );
		$div->appendChild( $ul );

		return $this->dom->saveXML( $div );
	}

	/**
	 * Define the admin menu
	 */
	function admin_menu() {
		//echo 'admin menu check';
		//add_options_page( __( 'Subpage navigator' ), 'Subpage navigator shortcode', 'publish_posts', 'subpage-shortcode', array( $this, 'generate_shortcode' ) );
		add_options_page( __( 'Subpage navigator' ), 'Subpage navigator shortcode new', 'publish_posts', 'subpage-shortcode-new', array( $this, 'generate_shortcode_new' ) );
	}

	/**
	 * Show a form where the user can generate a short code
	 */
	function generate_shortcode() {
		wp_enqueue_script( 'shortcode-gen','/wp-content/plugins/subpage-navigator/shortcode.js' );
		require 'admin-page.php';
	}
	/**
	 * Show a form where the user can generate a short code
	 */
	function generate_shortcode_new() {
		wp_enqueue_script( 'shortcode-gen','/wp-content/plugins/subpage-navigator/shortcode.js' );
		require 'admin-menu.php';
	}
}
