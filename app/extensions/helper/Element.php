<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\extensions\helper;

use lithium\util\Inflector;

class Element extends \lithium\template\Helper {

	/**
	 * $this->element->elementName($data, $options);
	 */
	public function __call($method, $args) {
		$method = Inflector::underscore($method);
		$data = array_shift($args) ?: array();
		$options = array_shift($args) ?: array();
		return $this->render($method, $data, $options);
	}

	/**
 	 * $this->element->render('element_name', $data, $options);
	 */
	public function render($name, array $data = array(), array $options = array()) {
		$defaults = array(
			'type' => 'element',
			'params' => array()
		);
		$options += $defaults;

		if ($request = $this->_context->request()) {
			$options['params'] += $request->params;
			$options['params']['controller'] = Inflector::underscore($options['params']['controller']);
		}

		$type = array($options['type'] => $name);

		$view = $this->_context->view();
		return $view->render($type, $data, $options['params']);
	}
}

?>
