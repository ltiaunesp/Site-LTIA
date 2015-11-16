<?php
/*
Plugin Name: Post Meta Searcher
Plugin URI: http://www.plugify.com.au/plugin/post-meta-searcher
Description: When activated, forces any WordPress Search Query to query against post meta data as part of the search criteria.
Author: Luke Rollans
Version: 1.2
Author URI: http://www.lukerollans.me
*/

// Ensure WordPress has been bootstrapped
if( !defined( 'ABSPATH' ) )
	exit;
	
function modify_wp_search_where( $where ) {
	
	if( is_search() ) {
		
		global $wpdb, $wp;
		
		$where = preg_replace(
			"/($wpdb->posts.post_title (LIKE '%{$wp->query_vars['s']}%'))/i",
			"$0 OR ( $wpdb->postmeta.meta_value LIKE '%{$wp->query_vars['s']}%' )",
			$where
			);
		
		add_filter( 'posts_join_request', 'modify_wp_search_join' );
		add_filter( 'posts_distinct_request', 'modify_wp_search_distinct' );
	}
	
	return $where;
	
}
add_action( 'posts_where_request', 'modify_wp_search_where' );

function modify_wp_search_join( $join ) {

	global $wpdb;
	
	return $join .= " LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) ";
	
}

function modify_wp_search_distinct( $distinct ) {

	return 'DISTINCT';
	
}

?>