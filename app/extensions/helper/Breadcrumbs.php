<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\extensions\helper;

use lithium\util\Set;
use lithium\util\Inflector;

class Breadcrumbs extends \app\extensions\helper\Html {

	protected $_strings = array(
		'list' => '<ol{:options}>{:content}</ol>',
	);

	protected $elements = array();

	public function __construct(array $config = array()) {
		$defaults = array(
			'list' => array(
				'class' => 'breadcrumb'
			),
		);
		parent::__construct($config + $defaults);
	}

	public function add($title, $url, array $options = array()) {
		$this->elements[] = compact('title', 'url', 'options');
	}

	public function create(array $options = array()) {
		$content = array();
		$content[] = $this->home();
		foreach ($this->elements as $element) {
			$content[] = $this->element($element['title'], $element['url'], $element['options']);
		}
		$content = join("\n", $content);
		$options += $this->_config['list'];
		$result = $this->_render(__METHOD__, 'list', compact('content', 'options'));
		$this->elements = array();
		return $result;
	}

	protected function home() {
		return $this->element('', '/', array(
			'link' => array(
				'icon' => 'home'
			)
		));
	}

	protected function element($title, $url, array $options = array()) {
		$defaults = array(
			'link' => array(
			)
		);
		list($scope, $options) = $this->_options($defaults, $options);
		$content = $this->link($title, $url, $scope['link']);
		return $this->_render(__METHOD__, 'list-item', compact('content', 'options'));
	}

}

?>
