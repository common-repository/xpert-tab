<?php

/**
 * Plugin Name: Xpert Tabs
 * Plugin URI: http://themexpert.com/wordpress-plugins/xpert-tabs-wp
 * Description: Supercharge your WordPress tabs plugin.
 * Version: 1.3
 * Author: ThemeXpert
 * Author URI: http://www.themexpert.com
 * License: GPLv2 or later
 * Text Domain: xt
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// This slug will be used on all ThemeXpert plugin to avoid loading duplicate item
defined( 'TX_PREFIX' ) or define( 'TX_PREFIX', 'tx' );

require_once 'shortcode/tabs.php';
require_once 'helper/html.php';

final class TX_XpertTabs
{

	/**
	 * Hook WordPress
	 */
	public function __construct()
	{
		add_action('media_buttons', array($this, 'addTabsButton'), 15);
		add_action('wp_enqueue_media', array($this, 'loadAdminScripts', 999));
		add_action('wp_enqueue_scripts', array($this, 'loadSiteScripts', 999));
	}
	/**
	 * Add Button On AddMedia area
	 *
	 * @access public
	 * @return void
	 * @since 0.1
	 */
	public function addTabsButton()
	{
		echo Htmltab::getMediaButtion();
		echo Htmltab::getModal();
	}
	/**
	 * Load Common scripts for frontend and backend
	 *
	 * @access public
	 * @return void
	 * @since 0.1
	 */
	public function loadCommonScripts()
	{
		wp_enqueue_style(
			TX_PREFIX . '-fontawesome',
			plugins_url('assets/vendor/font-awesome/css/font-awesome.min.css', __FILE__),
			array()
		);

		wp_enqueue_script(
			TX_PREFIX . '-bs-transition',
			plugins_url('assets/vendor/bootstrap/js/transition.js', __FILE__),
			array('jquery')
		);

		wp_enqueue_script(
			TX_PREFIX .'-bs-collapse',
			plugins_url('assets/vendor/bootstrap/js/collapse.js', __FILE__),
			array()
		);
	}
	/**
	 * Load Admin Scripts
	 *
	 * @access public
	 * @return void
	 * @since 0.1
	 */
	public function loadAdminScripts()
	{
		$this->loadCommonScripts();

		wp_enqueue_style(
			TX_PREFIX . '-apptabcss',
			plugins_url('assets/css/app-tab.min.css', __FILE__),
			array()
		);

		wp_enqueue_script(
			TX_PREFIX .	'-bs-modal',
			plugins_url('assets/vendor/bootstrap/js/modal.js', __FILE__),
			array()
		);

		wp_enqueue_script(
			TX_PREFIX .'-selectize',
			plugins_url('assets/vendor/selectize/js/standalone/selectize.js', __FILE__),
			array()
		);

		wp_enqueue_script(
			TX_PREFIX .'-apptab',
			plugins_url('assets/js/app-tab.min.js', __FILE__),
			array()
		);
	}
	/**
	 * Load Frontend Scripts
	 *
	 * @access public
	 * @return void
	 * @since 0.1
	 */
	public function loadSiteScripts()
	{
		$this->loadCommonScripts();

		wp_enqueue_style(
			TX_PREFIX . '-bs-tabs',
			plugins_url('assets/css/tabs.min.css', __FILE__),
			array()
		);

		wp_enqueue_script(
			TX_PREFIX . '-bs-tabsjs',
			plugins_url('assets/vendor/bootstrap/js/tab.js', __FILE__),
			array()
		);
	}
}
// Kickstart the class
new TX_XpertTabs();
