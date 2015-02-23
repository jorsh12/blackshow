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

class Pagination extends \app\extensions\helper\Html {

	protected $_prefix = null;

	protected $_controller = null;

	protected $_action = null;

	protected $_strings = array(
		'navigation' => '<nav{:options}>{:pager}</nav>',
		'pager' => '<ul{:options}>{:previous}{:numbers}{:next}</ul>',
	);

	public function __construct(array $config = array()) {
		$defaults = array(
			'request' => null,
			'pager' => array(
				'class' => 'pager'
			),
			'previous' => array(
				'class' => 'previous'
			),
			'next' => array(
				'class' => 'next'
			),
		);
		parent::__construct($config + $defaults);
	}

	protected function _init() {
		parent::_init();
		if ($this->_context) {
			$this->_request = $this->_context->_config['request'];
		}
	}

	public function paginate(array $pagination, array $options = array()) {
		$defaults = array(
			'sort' => 'id',
			'order' => 'ASC',
			'page' => 0,
			'limit' => 20,
			'totalRecords' => 0,
		);
		$pagination = array_intersect_key($pagination, $defaults);
		return $this->navigation($pagination, $options);
	}

	protected function navigation(array $pagination, array $options = array()) {
		$defaults = array('pager' => array());
		list($scope, $options) = $this->_options($defaults, $options);
		$pager = $this->pager($pagination, $scope['pager']);
		return $this->_render(__METHOD__, 'navigation', compact('options', 'pager'));
	}

	protected function pager(array $pagination, array $options = array()) {
		$defaults = array(
			'previous' => array(),
			'numbers' => array(),
			'next' => array(),
		);
		list($scope, $options) = $this->_options($defaults, $options);

		$options += $this->_config['pager'];

		$previous = $this->previous($pagination, $scope['previous']);
		$numbers = $this->numbers($pagination, $scope['numbers']);
		$next = $this->next($pagination, $scope['next']);

		return $this->_render(__METHOD__, 'pager', compact('options', 'previous', 'numbers', 'next'));
	}

	protected function previous(array $pagination, array $options = array()) {
		if (($pagination['page'] - 1) < 0) {
			return '';
		}
		$defaults = array('title' => '<');
		list($scope, $options) = $this->_options($defaults, $options);
		$options += $this->_config['previous'];
		$content = $this->link($scope['title'], array(
			'?' =>  array(
				'page' => $pagination['page'] - 1
			) + $pagination
		));
		return $this->_render(__METHOD__, 'list-item', compact('content', 'options'));
	}

	protected function next(array $pagination, array $options = array()) {
		if ((($pagination['page'] + 1) * $pagination['limit']) >= $pagination['totalRecords']) {
			return '';
		}
		$defaults = array('title' => '>');
		list($scope, $options) = $this->_options($defaults, $options);
		$options += $this->_config['next'];
		$content = $this->link($scope['title'], array(
			'?' =>  array(
				'page' => $pagination['page'] + 1
			) + $pagination
		));
		return $this->_render(__METHOD__, 'list-item', compact('content', 'options'));
	}

	protected function numbers(array $pagination, array $options = array()) {
		$data = '';
		$content = $this->link("Page: {$pagination['page']}", '#');
		$data .= $this->_render(__METHOD__, 'list-item', compact('content', 'options'));
		$content = $this->link("Limit: {$pagination['limit']}", '#');
		$data .= $this->_render(__METHOD__, 'list-item', compact('content', 'options'));
		$content = $this->link("Total Records: {$pagination['totalRecords']}", '#');
		$data .= $this->_render(__METHOD__, 'list-item', compact('content', 'options'));
		return $data;
	}
}

?>
