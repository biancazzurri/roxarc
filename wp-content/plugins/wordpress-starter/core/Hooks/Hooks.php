<?php
namespace SiteGround_Wizard\Hooks;

/**
 * Dashboard functions and main initialization class.
 */
class Hooks {

	/**
	 * Themeisle Neve affiliate link.
	 */
	const NEVE_AFF_LINK = 'http://shrsl.com/1pmew';
	/**
	 * The constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'wpforms_upgrade_link', array( $this, 'change_wpforms_upgrade_link' ) );
		add_filter( 'neve_upgrade_link_from_child_theme_filter', array( $this, 'change_neve_affiliate_link' ) );
		add_filter( 'neve_filter_onboarding_data', array( $this, 'change_neve_affiliate_link_config' ) );
		add_filter( 'ti_about_config', array( $this, 'remove_neve_useful_plugins' ) );
	}

	/**
	 * Change WPForms upgrede link.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $url The upgrade url.
	 *
	 * @return string      Modified url.
	 */
	public function change_wpforms_upgrade_link( $url ) {
		return 'http://www.shareasale.com/r.cfm?B=837827&U=112297&M=64312&urllink=' . rawurlencode( $url );
	}


	/**
	 * Change Neve affiliate link.
	 *
	 * @since  1.0.4
	 *
	 * @return string The new upgrade link.
	 */
	public function change_neve_affiliate_link() {
		return self::NEVE_AFF_LINK;
	}

	/**
	 * Change Neve affiliate link
	 *
	 * @since  1.0.4
	 *
	 * @param array $config The theme config.
	 *
	 * @return array The config with affiliate upgrade link.
	 */
	public function change_neve_affiliate_link_config( $config ) {
		$config['pro_link'] = self::NEVE_AFF_LINK;
		return $config;
	}

	/**
	 * Remove Neve theme useful plugins tab
	 *
	 * @since  1.0.4
	 *
	 * @param  array $config The theme config.
	 *
	 * @return array         Modified config.
	 */
	public function remove_neve_useful_plugins( $config ) {
		unset( $config['useful_plugins'] );

		return $config;
	}
}
