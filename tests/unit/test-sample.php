<?php
/**
 * Class SampleTest
 *
 * @package Wp_Ads
 */

/**
 * Sample test case.
 */
class SampleTest extends WP_UnitTestCase {

	public function test_ads_post_type() {
		$post_types = $GLOBALS['wp_post_types'];
		$post_types_names = array_keys($post_types);
		$this->assertContains('ads', $post_types_names, "ads doesn't contains value as WordPress Post Types") ;
	}

}
