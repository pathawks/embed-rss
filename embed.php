<?php
/*
Plugin Name: Embed RSS
Plugin URI: https://github.com/pathawks/embed-rss
Description: Embed a RSS feed
Author: Pat Hawks
Author URI: http://pathawks.com
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Version: 1.02

  Copyright 2014 Pat Hawks  (email : pat@pathawks.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

wp_embed_register_handler( 'rss', '#(^http.+((\.|=)(rss|atom|xml)|\/feed\/)$)#i', 'wp_embed_handler_rss', 20 );
function wp_embed_handler_rss( $matches, $attr, $url, $rawattr ) {

	$embed = get_transient( 'dirtysuds_oembed_rss'.$matches[0] );
	if( $embed ) return apply_filters( 'embed_rss', $embed, $matches, $attr, $url, $rawattr  );

	include_once(ABSPATH . WPINC . '/feed.php');
	// Get a SimplePie feed object from the specified feed source.
	$rss = fetch_feed($matches[0]);
	if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly
	    // Figure out how many total items there are, but limit it to 4.
	    $maxitems = $rss->get_item_quantity(4);

	    // Build an array of all the items, starting with element 0 (first element).
	    $rss_items = $rss->get_items(0, $maxitems);
	else:
		return "error";
	endif;

	$embed = '<ul>';
	if ($maxitems == 0)
		$embed .= '<li>No items.</li>';
	else
	    // Loop through each feed item and display each item as a hyperlink.
	    foreach ( $rss_items as $item ) :
		    $embed .= '<li><a href="'.$item->get_permalink().'" title="Posted '.$item->get_date('j F Y | g:i a').'">';
		    $embed .= $item->get_title().'</a></li>';
		endforeach;
	$embed .= '</ul>';

	set_transient( 'dirtysuds_oembed_rss'.$matches[0], $embed, 5 * MINUTE_IN_SECONDS );

	return apply_filters( 'embed_rss', $embed, $matches, $attr, $url, $rawattr  );
}

add_filter('plugin_row_meta', 'dirtysuds_embed_rss_rate',10,2);
function dirtysuds_embed_rss_rate($links,$file) {
		if (plugin_basename(__FILE__) == $file) {
			$links[] = '<a href="http://wordpress.org/extend/plugins/dirtysuds-embed-rss/">Rate this plugin</a>';
		}
	return $links;
}
