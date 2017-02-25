<?php
 /**
 * File with functions that add support to  plugins.
 * 
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 * 
 * Gecka Terms Ordering.
 */
 
/**
 * Support plugin - Gecka Terms Ordering.
 *
 * @since 	1.0.0
 * @link 	https://wordpress.org/plugins/gecka-terms-ordering/
 *
 */ 
if( function_exists('remove_term_ordering_support') )
add_term_ordering_support ('gallery');
if( function_exists('remove_term_ordering_support') )
remove_term_ordering_support( 'category' );