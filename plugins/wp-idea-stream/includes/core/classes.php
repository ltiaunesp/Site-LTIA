<?php
/**
 * WP Idea Stream Classes.
 *
 * Database dialog & Generic loop classes
 *
 * @package WP Idea Stream
 * @subpackage core/classes
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/** Rewrites ******************************************************************/

if ( ! class_exists( 'WP_Idea_Stream_Rewrites' ) ) :

/**
 * Rewrites Class.
 *
 * @package WP Idea Stream
 * @subpackage core/rewrites
 *
 * @since 2.0.0
 */
class WP_Idea_Stream_Rewrites {


	/**
	 * Constructor
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 */
	public function __construct() {
		$this->setup_globals();
		$this->hooks();
	}

	/**
	 * Start the rewrites
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @uses  wp_idea_stream() to get plugin's main instance
	 */
	public static function start() {
		$wp_idea_stream = wp_idea_stream();

		if ( empty( $wp_idea_stream->rewrites ) ) {
			$wp_idea_stream->rewrites = new self;
		}

		return $wp_idea_stream->rewrites;
	}

	/**
	 * Setup the rewrite ids and slugs
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @uses  wp_idea_stream_user_rewrite_id()
	 * @uses  wp_idea_stream_user_rates_rewrite_id()
	 * @uses  wp_idea_stream_user_comments_rewrite_id()
	 * @uses  wp_idea_stream_cpage_rewrite_id()
	 * @uses  wp_idea_stream_action_rewrite_id()
	 * @uses  wp_idea_stream_search_rewrite_id()
	 * @uses  wp_idea_stream_user_slug()
	 * @uses  wp_idea_stream_user_rates_slug()
	 * @uses  wp_idea_stream_user_comments_slug()
	 * @uses  wp_idea_stream_cpage_slug()
	 * @uses  wp_idea_stream_action_slug()
	 */
	private function setup_globals() {
		/** Rewrite ids ***************************************************************/

		$this->page_rid          = 'paged'; // WordPress built-in global var
		$this->user_rid          = wp_idea_stream_user_rewrite_id();
		$this->user_rates_rid    = wp_idea_stream_user_rates_rewrite_id();
		$this->user_comments_rid = wp_idea_stream_user_comments_rewrite_id();
		$this->cpage_rid         = wp_idea_stream_cpage_rewrite_id();
		$this->action_rid        = wp_idea_stream_action_rewrite_id();
		$this->search_rid        = wp_idea_stream_search_rewrite_id();

		/** Rewrite slugs *************************************************************/

		$this->user_slug          = wp_idea_stream_user_slug();
		$this->user_rates_slug    = wp_idea_stream_user_rates_slug();
		$this->user_comments_slug = wp_idea_stream_user_comments_slug();
		$this->cpage_slug         = wp_idea_stream_cpage_slug();
		$this->action_slug        = wp_idea_stream_action_slug();
	}

	/**
	 * Hooks to load the register methods
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @uses  add_action() to hook to WP Idea Stream actions
	 */
	private function hooks() {
		// Register rewrite tags.
		add_action( 'wp_idea_stream_add_rewrite_tags',  array( $this, 'add_rewrite_tags' )  );

		// Register the rewrite rules
		add_action( 'wp_idea_stream_add_rewrite_rules', array( $this, 'add_rewrite_rules' ) );

		// Register the permastructs
		add_action( 'wp_idea_stream_add_permastructs',  array( $this, 'add_permastructs' )  );
	}

	/**
	 * Register the rewrite tags
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @uses add_rewrite_tag()
	 */
	public function add_rewrite_tags() {
		add_rewrite_tag( '%' . $this->user_rid          . '%', '([^/]+)'   );
		add_rewrite_tag( '%' . $this->user_rates_rid    . '%', '([1]{1,})' );
		add_rewrite_tag( '%' . $this->user_comments_rid . '%', '([1]{1,})' );
		add_rewrite_tag( '%' . $this->cpage_rid         . '%', '([^/]+)'   );
		add_rewrite_tag( '%' . $this->action_rid        . '%', '([^/]+)'   );
		add_rewrite_tag( '%' . $this->search_rid        . '%', '([^/]+)'   );
	}

	/**
	 * Register the rewrite rules
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @uses add_rewrite_rule()
	 */
	public function add_rewrite_rules() {
		$priority  = 'top';
		$root_rule = '/([^/]+)/?$';

		$page_slug = wp_idea_stream_paged_slug();
		$paged_rule   = '/([^/]+)/' . $page_slug . '/?([0-9]{1,})/?$';

		// User Rates
		$user_rates_rule       = '/([^/]+)/' . $this->user_rates_slug . '/?$';
		$user_rates_paged_rule = '/([^/]+)/' . $this->user_rates_slug . '/' . $page_slug . '/?([0-9]{1,})/?$';

		// User Comments
		$user_comments_rule        = '/([^/]+)/' . $this->user_comments_slug . '/?$';
		$user_comments_paged_rule  = '/([^/]+)/' . $this->user_comments_slug . '/' . $this->cpage_slug . '/?([0-9]{1,})/?$';

		// User rules
		add_rewrite_rule( $this->user_slug . $user_comments_paged_rule, 'index.php?' . $this->user_rid . '=$matches[1]&' . $this->user_comments_rid . '=1&' . $this->cpage_rid . '=$matches[2]', $priority );
		add_rewrite_rule( $this->user_slug . $user_comments_rule,       'index.php?' . $this->user_rid . '=$matches[1]&' . $this->user_comments_rid . '=1',                                                $priority );
		add_rewrite_rule( $this->user_slug . $user_rates_paged_rule,    'index.php?' . $this->user_rid . '=$matches[1]&' . $this->user_rates_rid .    '=1&' . $this->page_rid . '=$matches[2]',                  $priority );
		add_rewrite_rule( $this->user_slug . $user_rates_rule,          'index.php?' . $this->user_rid . '=$matches[1]&' . $this->user_rates_rid .    '=1',                                                $priority );
		add_rewrite_rule( $this->user_slug . $root_rule,                'index.php?' . $this->user_rid . '=$matches[1]',                                                                            $priority );

		// Action rules (only add a new idea right now)
		add_rewrite_rule( $this->action_slug . $root_rule, 'index.php?' . $this->action_rid . '=$matches[1]', $priority );
	}

	/**
	 * Register the permastructs
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @uses add_permastruct()
	 */
	public function add_permastructs() {
		// User Permastruct
		add_permastruct( $this->user_rid, $this->user_slug . '/%' . $this->user_rid . '%', array(
			'with_front'  => false,
			'ep_mask'     => EP_NONE,
			'paged'       => true,
			'feed'        => false,
			'forcomments' => false,
			'walk_dirs'   => true,
			'endpoints'   => false,
		) );

		// Action Permastruct
		add_permastruct( $this->action_rid, $this->action_slug . '/%' . $this->action_rid . '%', array(
			'with_front'  => false,
			'ep_mask'     => EP_NONE,
			'paged'       => true,
			'feed'        => false,
			'forcomments' => false,
			'walk_dirs'   => true,
			'endpoints'   => false,
		) );
	}
}

endif;

/** Template Loader class *****************************************************/

if ( ! class_exists( 'WP_Idea_Stream_Template_Loader' ) ) :
/**
 * Main Template loader class.
 *
 * Originally based on http://github.com/GaryJones/Gamajo-Template-Loader.
 *
 * @package WP Idea Stream
 * @subpackage core/classes
 *
 * @since 2.0.0
 */
class WP_Idea_Stream_Template_Loader {
	/**
	 * Prefix for filter names.
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @var string
	 */
	protected $filter_prefix = 'wp_idea_stream';

	/**
	 * Directory name where custom templates for this plugin should be found in the theme.
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @var string
	 */
	protected $theme_template_directory = 'wp-idea-stream';

	/**
	 * Retrieve a template part.
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @param string  $slug
	 * @param string  $name Optional. Default null.
	 * @param bool    $load Optional. Default true.
	 *
	 * @return string
	 */
	public function get_template_part( $slug, $name = null, $load = true, $require_once = true ) {
		// Execute code for this part
		do_action( 'get_template_part_' . $slug, $slug, $name );

		// Get files names of templates, for given slug and name.
		$templates = $this->get_template_file_names( $slug, $name );

		// Return the part that is found
		return $this->locate_template( $templates, $load, $require_once );
	}

	/**
	 * Given a slug and optional name, create the file names of templates.
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @param string  $slug
	 * @param string  $name
	 * @uses  apply_filters() call $this->filter_prefix . '_get_template_part' to override/extend
	 * @return array
	 */
	protected function get_template_file_names( $slug, $name, $ext = 'php' ) {
		$templates = array();
		if ( isset( $name ) ) {
			$templates[] = $slug . '-' . $name . '.' . $ext;
		}
		$templates[] = $slug . '.' . $ext;

		/**
		 * Allow template choices to be filtered.
		 */
		return apply_filters( $this->filter_prefix . '_get_template_part', $templates, $slug, $name );
	}

	/**
	 * Retrieve the name of the highest priority template file that exists.
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @param string|array $template_names Template file(s) to search for, in order.
	 * @param bool         $load           If true the template file will be loaded if it is found.
	 * @param bool         $require_once   Whether to require_once or require. Default true.
	 *   Has no effect if $load is false.
	 * @uses   load_template()
	 * @return string The template filename if one is located.
	 */
	public function locate_template( $template_names, $load = false, $require_once = true ) {
		// No file found yet
		$located = false;

		// Remove empty entries
		$template_names = array_filter( (array) $template_names );
		$template_paths = $this->get_template_paths();

		// Try to find a template file
		foreach ( $template_names as $template_name ) {
			// Trim off any slashes from the template name
			$template_name = ltrim( $template_name, '/' );

			// Try locating this template file by looping through the template paths
			foreach ( $template_paths as $template_path ) {
				if ( file_exists( $template_path . $template_name ) ) {
					$located = $template_path . $template_name;
					break 2;
				}
			}
		}

		if ( $load && $located ) {
			load_template( $located, $require_once );
		}

		return $located;
	}

	/**
	 * Return a list of paths to check for template locations.
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @uses  trailingslashit()
	 * @uses  get_template_directory() to look into parent theme
	 * @uses  get_stylesheet_directory() to look into current theme
	 * @uses  apply_filters() call $this->filter_prefix . '_template_paths' to override/extend
	 * @return mixed|void
	 */
	protected function get_template_paths() {
		$theme_directory = trailingslashit( $this->theme_template_directory );

		$file_paths = array(
			10  => trailingslashit( get_template_directory() ) . $theme_directory,
			100 => $this->get_templates_dir(),
		);

		// Only add this conditionally, so non-child themes don't redundantly check active theme twice.
		if ( is_child_theme() ) {
			$file_paths[1] = trailingslashit( get_stylesheet_directory() ) . $theme_directory;
		}

		/**
		 * Allow ordered list of template paths to be amended.
		 */
		$file_paths = apply_filters( $this->filter_prefix . '_template_paths', $file_paths );

		// sort the file paths based on priority
		ksort( $file_paths, SORT_NUMERIC );

		return array_map( 'trailingslashit', $file_paths );
	}

	/**
	 * Return the path to the templates directory in this plugin.
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @uses   wp_idea_stream_get_templates_dir()
	 * @uses   untrailingslashit()
	 * @return string
	 */
	protected function get_templates_dir() {
		return untrailingslashit( wp_idea_stream_get_templates_dir() );
	}

	/**
	 * Return the url to the plugin's stylesheet.
	 *
	 * That's my little "extend" of the Original GamaJo Class
	 * The goal is to also benefit of the template location feature
	 * for the css file. This way, a theme can override the plugin's
	 * stylesheet from the wp-idea-stream theme's folder as soon as
	 * the custom css file is named style.css
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @uses   wp_idea_stream_get_plugin_dir() to get plugin's dir
	 * @uses   content_url() to get WP Content url
	 * @uses   wp_idea_stream_get_plugin_url() to get plugin's url
	 * @return string
	 */
	public function get_stylesheet() {
		$styles = $this->get_template_file_names( 'style', null, 'css' );

		$located = $this->locate_template( $styles );

		// Microsoft is annoying...
		$slashed_located     = str_replace( '\\', '/', $located );
		$slashed_content_dir = str_replace( '\\', '/', WP_CONTENT_DIR );
		$slashed_plugin_dir  = str_replace( '\\', '/', wp_idea_stream_get_plugin_dir() );

		// Should allways be the case for regular configs
		if ( false !== strpos( $slashed_located, $slashed_content_dir ) ) {
			$located = str_replace( $slashed_content_dir, content_url(), $slashed_located );

		// If not, WP Idea Stream might be symlinked, so let's try this
		} else {
			$located = str_replace( $slashed_plugin_dir, wp_idea_stream_get_plugin_url(), $slashed_located );
		}

		return $located;
	}
}

endif;

/** Loop **********************************************************************/

if ( ! class_exists( 'WP_Idea_Stream_Loop' ) ) :
/**
 * A loop class to extend for any object.
 *
 * As we use custom loops for ideas and comments,
 * it's a bit annoying to copy paste all loop code
 * for each object.
 *
 * @see  WP_Idea_Stream_Loop_Ideas for an example of use.
 *
 * @package WP Idea Stream
 * @subpackage core/classes
 *
 * @since 2.0.0
 */
class WP_Idea_Stream_Loop {

	/**
	 * Array of vars to customize loop vars
	 *
	 * @access  public
	 * @var     array
	 */
	public $loop_vars;

	/**
	 * A flag for whether the loop is currently being iterated.
	 *
	 * @access public
	 * @var bool
	 */
	public $in_the_loop;

	/**
	 * The page number being requested.
	 *
	 * @access public
	 * @var int
	 */
	public $page;

	/**
	 * The number of items to display per page of results.
	 *
	 * @access public
	 * @var int
	 */
	public $per_page;

	/**
	 * An HTML string containing pagination links.
	 *
	 * @access public
	 * @var string
	 */
	public $pag_links;

	/**
	 * the plugin prefix eg: wp_idea_stream.
	 *
	 * @access public
	 * @var string
	 */
	public $plugin_prefix;

	/**
	 * the item name to loop through eg: ideas
	 *
	 * @access public
	 * @var string
	 */
	public $item_name;

	/**
	 * Start method to build the loop
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @param  array $params must be an associative array where :
	 *         'plugin_prefix'    is the plugin prefix (only _ no - )
	 *         'item_name'        is the name of the idea (only _ no - )
	 *         'item_name_plural' is the plural for the item eg: ideas (only _ no - )
	 *         'items'            is an array of objects to loop through
	 *         'total_item_count' is max total item count
	 *         'page'             is the current page
	 *         'per_page'         is the items to show on a page.
	 * @param  array $paginate_args custom arguments to pass to paginate_links()
	 * @uses   wp_parse_args()
	 * @uses   paginate_links()
	 */
	public function start( $params = array(), $paginate_args = array() ) {
		// Make sure we have item name and item name plural
		$this->loop_vars = array(
			'item_name'        => 'item',
			'item_name_plural' => 'items',
		);

		$custom_vars = array_intersect_key( (array) $params, $this->loop_vars );

		if ( ! empty( $custom_vars ) && 2 == count( $custom_vars ) ) {
			$this->loop_vars = $custom_vars;
		}

		$this->loop_vars = array_merge( $this->loop_vars, array(
			'total_item_count' => 'total_' . $this->loop_vars['item_name'] . '_count',
			'item_count'       => $this->loop_vars['item_name'] .'_count',
			'current_item'     => 'current_' . $this->loop_vars['item_name'],
		) );

		$this->{$this->loop_vars['current_item']} = -1;

		// Parsing other params
		if ( ! empty( $params ) ) {
			foreach ( (array) $params as $key => $value ) {
				// This will be set in $this->{$this->loop_vars['item_name_plural']}
				if ( 'items' == $key ) {
					continue;
				}

				$this->{$key} = $value;
			}
		} else {
			return false;
		}

		// Setup the Items to loop through
		$this->{$this->loop_vars['item_name_plural']} = $params['items'];
		$this->{$this->loop_vars['total_item_count']} = $params['total_item_count'];

		if ( empty( $this->{$this->loop_vars['item_name_plural']} ) ) {
			$this->{$this->loop_vars['item_count']}       = 0;
			$this->{$this->loop_vars['total_item_count']} = 0;
		} else {
			$this->{$this->loop_vars['item_count']} = count( $this->{$this->loop_vars['item_name_plural']} );
		}

		if ( (int) $this->{$this->loop_vars['total_item_count']} && ! empty( $this->per_page ) ) {
			$default_paginate_args = array(
				'total'     => ceil( (int) $this->{$this->loop_vars['total_item_count']} / (int) $this->per_page ),
				'current'   => (int) $this->page,
			);

			$custom_paginate_args = wp_parse_args( $paginate_args, array(
				'base'      => '',
				'format'    => '',
				'prev_text' => _x( '&larr;', 'pagination previous text', 'wp-idea-stream' ),
				'next_text' => _x( '&rarr;', 'pagination next text',     'wp-idea-stream' ),
				'mid_size'  => 1,
			) );

			$this->pag_links = paginate_links( array_merge( $default_paginate_args, $custom_paginate_args ) );

			// Remove first page from pagination
			$this->pag_links = str_replace( '?paged=1', '', $this->pag_links );
			$this->pag_links = str_replace( '&#038;paged=1', '', $this->pag_links );
		}
	}

	/**
	 * Whether there are Items available in the loop.
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @return bool True if there are items in the loop, otherwise false.
	 */
	public function has_items() {
		if ( $this->{$this->loop_vars['item_count']} ) {
			return true;
		}

		return false;
	}

	/**
	 * Set up the next item and iterate index.
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @return object The next item to iterate over.
	 */
	public function next_item() {

		$this->{$this->loop_vars['current_item']}++;

		$this->{$this->loop_vars['item_name']} = $this->{$this->loop_vars['item_name_plural']}[ $this->{$this->loop_vars['current_item']} ];

		return $this->{$this->loop_vars['item_name']};
	}

	/**
	 * Rewind the items and reset items index.
	 *
	 * @package WP Idea Stream
	 * @subpackage classes
	 *
	 * @since 2.0.0
	 */
	public function rewind_items() {

		$this->{$this->loop_vars['current_item']} = -1;

		if ( $this->{$this->loop_vars['item_count']} > 0 ) {
			$this->{$this->loop_vars['item_name']} = $this->{$this->loop_vars['item_name_plural']}[0];
		}
	}

	/**
	 * Whether there are items left in the loop to iterate over.
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 *
	 * @return bool True if there are more items to show,
	 *         otherwise false.
	 */
	public function items() {

		if ( $this->{$this->loop_vars['current_item']} + 1 < $this->{$this->loop_vars['item_count']} ) {
			return true;

		} elseif ( $this->{$this->loop_vars['current_item']} + 1 == $this->{$this->loop_vars['item_count']} ) {
			do_action( "{$this->plugin_prefix}_{$this->item_name}_loop_end" );

			$this->rewind_items();
		}

		$this->in_the_loop = false;
		return false;
	}

	/**
	 * Set up the current item inside the loop.
	 *
	 * @package WP Idea Stream
	 * @subpackage core/classes
	 *
	 * @since 2.0.0
	 */
	public function the_item() {
		$this->in_the_loop  = true;
		$this->{$this->loop_vars['item_name']} = $this->next_item();

		// loop has just started
		if ( 0 === $this->{$this->loop_vars['current_item']} ) {
			do_action( "{$this->plugin_prefix}_{$this->item_name}_start" );
		}
	}
}

endif;
