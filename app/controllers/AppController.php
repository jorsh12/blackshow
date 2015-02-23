<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\controllers;

use Exception;
use lithium\analysis\Logger;
use lithium\security\Auth;
use li3_access\security\Access;
use li3_flash_message\extensions\storage\FlashMessage;
use app\models\Users;

class AppController extends \lithium\action\Controller {

	protected $_render = array(
		'negotiate' => true
	);

	protected $pagination = array(
		'page' => 0,
		'limit' => 20,
		'sort' => null,
		'order' => null,
	);

	protected function _init() {
		parent::_init();
		//$this->_setupPagination();		
		$this->_authorize();
	}

	protected function _setupPagination() {
		if (empty($this->request->query)) {
			return;
		}

		$data = $this->request->query + $this->pagination;

		if (
			$data['page'] > 0
		) {
			$this->pagination['page'] = (int) $data['page'];
		}

		if (
			$data['limit'] > 0 && $data['limit'] <= 500
		) {
			$this->pagination['limit'] = (int) $data['limit'];
		}

		if (
			!empty($data['sort'])
		) {
			$this->pagination['sort'] = $data['sort'];
		}

		if (
			!empty($data['order']) &&
			in_array($data['order'], array(
				'ASC',
				'asc',
				'DESC',
				'desc',
			))
		) {
			$this->pagination['order'] = $data['order'];
		}

	}

	protected function flash($message, $key = 'default') {
		FlashMessage::write($message, $key);
	}

	protected function log($priority, $message) {
		Logger::write($priority, $message);
	}

	protected $accessRules = array();

	public function _authorize() {
		
		$defaults = array(
			'rules' => array(
			),
			'allowAny' => false,
			'title' => 'Error de acceso.',
			'message' => 'Acceso no autorizado.',
			'type' => 'danger',
			'redirect' => array(
				'Accounts::login',
				// '?' => array(
				// 	'redirect' => $this->request->url
				// )
			),
		);
		$options = array();
		if (!empty($this->accessRules[$this->request->action])) {
			$actionOptions = $this->accessRules[$this->request->action];
			if (isset($actionOptions['rules'])) {
				$options = $actionOptions;
			} else {
				$options['rules'] = $actionOptions;
			}
		}
		$options += $defaults;
		//dump($this->accessRules, $this->request->action, $options);
		$user = Users::current();

		// if ($user && !empty($options['rules'])) {
		// 	$options['rules'][] = array(
		// 		'rule' => 'UserMustChangePassword',
		// 		'message' => 'Es necesario que cambie su password.',
		// 		'type' => 'warning',
		// 		'redirect' => array(
		// 			'Accounts::change_password',
		// 			'library' => null,
		// 		)
		// 	);
		// }

		// if ($user) {
		// 	$this->log('debug', sprintf(
		// 		"%s | %s | %s::%s | %s",
		// 		$this->request->env('REMOTE_ADDR'),
		// 		$user->getEmail(),
		// 		$this->request->controller,
		// 		$this->request->action,
		// 		$this->request->url
		// 	));
		// }

		if ($access = Access::check('rules', $user, $this->request, $options)) {
			return $this->redirect($access['redirect'], array(
				'message' => array(
					$access['message'],
					'title' => $access['title'],
					'type' => $access['type']
				)
			));
		}
	}

}

?>