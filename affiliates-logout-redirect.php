<?php
/**
 * Plugin Name: Affiliates Logout Redirect
 * Plugin URI: http://www.netpad.gr
 * Description: Affiliates logout shortocode with option to redirect to the page specified
 * Version: 1.0.0
 * Author: George Tsiokos
 * Author URI: http://www.netpad.gr
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Copyright (c) 2015-2016 "gtsiokos" George Tsiokos www.netpad.gr
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
add_action( 'init', 'affiliates_logout_shortocode_init' );

function affiliates_logout_shortocode_init() {
	if( defined( 'AFFILIATES_CORE_VERSION' ) ) {
		add_shortcode( 'affiliates_logout_redirect', 'affiliates_logout_redirect' );
	}
}

function affiliates_logout_redirect( $atts, $content = null ) {
	$options = shortcode_atts(
			array(
					'redirect_to_post' => null					
			),$atts
	);
	
	$redirect_url = isset( $options['redirect_to_post'] ) ? $options['redirect_to_post'] : '';
	if ( is_user_logged_in() ) {
		return '<a href="' . esc_url( wp_logout_url( get_permalink( $redirect_url ) ) ) . '">' . __( 'Log out', 'affiliates' ) . '</a>';
	} else {
		return '';
	}
}
