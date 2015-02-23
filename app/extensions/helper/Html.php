<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\extensions\helper;

class Html extends \lithium\template\helper\Html {

	public function link($title, $url = null, array $options = array()) {
		if (isset($options['icon'])) {
			$icon = $options['icon'];
			$title = sprintf('<i class="fa fa-%s"></i> %s', $icon, $title);
			$options['escape'] = false;
			unset($options['icon']);
		}
		return parent::link($title, $url, $options);
	}
}

?>
