<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\controllers;

use app\models\Users;
use li3_doctrine\models\ValidateException;
use lithium\util\Validator;
use app\mails\AccountsMailer;

class AccountsController extends \app\controllers\AppController {

	protected $accessRules = array(
		'login' => array('allowAnyUser'),
		'logout' => array('allowAnyUser'),
		'current' => array('allowAnyUser'),
		// 'edit' => array('allowAnyUser'),
		// 'edit_password' => array('allowAnyUser'),
		// 'change_password' => array('allowAnyUser'),
		// 'request_verification_email' => array('allowAnyUser'),
		// 'verify_email' => array('allowAnyUser'),
		// 'recovery' => array('allowAll'),
		// 'recovery_confirmation' => array('allowAll'),
	);

	/**
	 * Informacion del usuario actual.
	 */
	public function current() {
		$user = Users::current();
		return compact('user');
	}

	/**
	 * Editar perfil del usuario actual.
	 *
	 * Actualmente permite la edicion de:
	 * - Nombre
	 * - Apellido Paterno
	 * - Apellido Materno
	 */
	// public function edit() {
	// 	$user = Users::current();
	// 	if ($this->request->data) {
	// 		try {
	// 			$user->save($this->request->data, array(
	// 				'nombre',
	// 				'apellidoPaterno',
	// 				'apellidoMaterno'
	// 			), array(
	// 				'flush' => true
	// 			));
	// 			return $this->redirect(array(
	// 				'Accounts::current',
	// 			));
	// 		} catch (ValidateException $e) {
	// 			$this->flash(array(
	// 				"Existen errores en el formulario. Favor de verificar",
	// 				'title' => "Error de validacion",
	// 				'type' => 'warning'
	// 			));
	// 		}
	// 	}
	// 	return compact('user');
	// }

	/**
	 * Inicio de session de usuarios.
	 */
	public function login() {
		// $redirect = 'Accounts::current';
		// if (!empty($this->request->query['redirect'])) {
		// 	$redirect = $this->request->query['redirect'];
		// }
		if ($this->request->data) {
			
			if ($user = Users::current($this->request)) {
				$user->setLastLogin();
				$user->save(array(), array(), array(
					'validate' => false,
					'flush' => true
				));
				return $this->redirect('Pages::home', array(
					// 'message' => array(
					// 	"Bienvenido {$user->nombreCompleto}!",
					// 	'type' => 'success',
					// 	'title' => 'Acceso correcto'
					//)
				));
			}
			$this->flash(array(
				'Los datos de acceso proporcionados no son correctos.',
				'type' => 'warning',
				'title' => 'Error de acceso'
			));
		}
		$user = new Users();
		$user->set($this->request->data);
		$this->_render['layout'] = 'no_navigation';
		return compact('user');
	}

	/**
	 * Termino de session actual.
	 */
	public function logout() {
		Users::current(false);
		return $this->redirect('Pages::home', array(
			//'message' => array(
				// 'La sesión ha finalizado',
				// 'title' => 'Acceso usuarios',
				// 'type' => 'success'
			//)
		));
	}

	/**
 	 * Cambio de password de usuario actual.
	 *
	 * Esta accion es llamada cuando el usuario debe cambiar su password de manera obligatoria, ya
	 * sea debido a la peticion y confirmacion del correo electronico o por solicitud de un
	 * administrador.
	 */
	// public function change_password() {
	// 	$user = Users::current();
	// 	# @TODO: Hacer esto mediante reglas de validacion??? maybe?
	// 	if (!$user->mustChangePassword()) {
	// 		return $this->redirect('edit_password');
	// 	}
	// 	if ($this->request->data) {
	// 		try {
	// 			$user->setMustChangePassword(false);
	// 			$user->save($this->request->data, array(
	// 				'password'
	// 			), array(
	// 				'events' => 'change_password',
	// 				'flush' => true,
	// 			));
	// 			return $this->redirect('Accounts::logout');
	// 		} catch (ValidateException $e) {
	// 			$this->flash(array(
	// 				'Existen errores en el formulario, favor de verificar',
	// 				'title' => 'Error de validacion',
	// 				'type' => 'warning'
	// 			));
	// 		}
	// 	}
	// 	$this->_render['layout'] = 'no_navigation';
	// 	return compact('user');
	// }

	/**
	 * Cambio de password del usuario actual por accion del mismo usuario.
	 *
	 * Se requiere de la confirmacion del password actual para realizar el cambio del mismo.
	 */
	// public function edit_password() {
	// 	$user = Users::current();
	// 	if ($this->request->data) {
	// 		try {
	// 			$user->save($this->request->data, array(
	// 				'password'
	// 			), array(
	// 				'events' => 'edit_password',
	// 				'flush' => true,
	// 			));
	// 			return $this->redirect('/');
	// 		} catch (ValidateException $e) {
	// 			$this->flash(array(
	// 				'Existen errores en el formulario, favor de verificar',
	// 				'title' => 'Error de validacion',
	// 				'type' => 'warning'
	// 			));
	// 		}
	// 	}
	// 	return compact('user');
	// }

	/**
	 * Activacion de nuevos usuarios.
	 */
	// public function verify_email() {
	// 	if (!$token = $this->request->token) {
	// 		return $this->redirect('/');
	// 	}
	// 	# @TODO: Hacer esto un metodo del repositorio
	// 	$user = Users::findOneBy(array(
	// 		'token' => $token,
	// 		'emailVerified' => false,
	// 		'active' => true,
	// 	));
	// 	if (!$user) {
	// 		return $this->redirect('/', array(
	// 			'message' => array(
	// 				'No existe el usuario para el codigo de activacion indicado',
	// 				'title' => 'Error',
	// 				'type' => 'danger'
	// 			)
	// 		));
	// 	}
	// 	$user->setEmailVerified(true);
	// 	$user->setMustChangePassword(true);
	// 	$user->setToken();
	// 	$user->save(array(), array(), array(
	// 		'validate' => false,
	// 		'flush' => true
	// 	));

	// 	Users::current($user);
	// 	return $this->redirect('Accounts::change_password', array(
	// 		'message' => array(
	// 			'Momento de cambiar tu password.',
	// 			'title' => 'Correcto!',
	// 			'type' => 'success'
	// 		)
	// 	));
	// }

	/**
	 * Solicitud de cambio de password para los usuarios que la han olvidado.
	 *
	 * Los usuarios tienen que haber verificado de manera exitosa su email para poder hacer esta
	 * solicitud.
	 *
	 * Se genera un nuevo token al hacer una peticion de recuperacion de password, por lo que
	 * correos anteriores enviados por esta peticion quedan inservibles.
	 */
	// public function recovery() {
	// 	if ($this->request->data) {
	// 		// @FIXME: que hacer en caso de que no este bien el formulario?
	// 		if (!isset($this->request->data['email'])) {
	// 			return $this->redirect('/');
	// 		}
	// 		# @TODO: Hacer esto un metodo del repositorio
	// 		$email = $this->request->data['email'];
	// 		$user = Users::findOneBy(array(
	// 			'email' => $email,
	// 			'emailVerified' => true,
	// 			'active' => true,
	// 		));
	// 		if ($user) {
	// 			$user->setToken();
	// 			$user->save(array(), array(), array(
	// 				'validate' => false,
	// 				'flush' => true
	// 			));
	// 			AccountsMailer::recovery($user);
	// 			return $this->redirect('/', array(
	// 				'message' => array(
	// 					'Se le ha enviado un correo de confirmacion para realizar el cambio de password.',
	// 					'title' => 'Cambio de Password',
	// 					'type' => 'success'
	// 				)
	// 			));
	// 		}
	// 		$this->flash(array(
	// 			'No existe el usuario para el correo indicado',
	// 			'title' => 'Error',
	// 			'type' => 'danger'
	// 		));
	// 	}
	// 	$user = new Users();
	// 	$user->set($this->request->data);
	// 	return compact('user');
	// }

	/**
	 * Confirmacion de cambio de password de usuario.
	 */
	// public function recovery_confirmation() {
	// 	if (!$token = $this->request->token) {
	// 		return $this->redirect('/');
	// 	}
	// 	# @TODO: Hacer esto un metodo del repositorio
	// 	$user = Users::findOneBy(array(
	// 		'token' => $token,
	// 		'emailVerified' => true,
	// 		'active' => true,
	// 	));
	// 	if (!$user) {
	// 		return $this->redirect('/', array(
	// 			'message' => array(
	// 				'No existe el usuario para el codigo indicado',
	// 				'title' => 'Error',
	// 				'type' => 'danger'
	// 			)
	// 		));
	// 	}
	// 	$user->setMustChangePassword(true);
	// 	$user->setToken();
	// 	$user->save(array(), array(), array(
	// 		'validate' => false,
	// 		'flush' => true
	// 	));
	// 	Users::current($user);

	// 	return $this->redirect('Accounts::change_password', array(
	// 		'message' => array(
	// 			'Momento de cambiar tu password.',
	// 			'title' => 'Correcto!',
	// 			'type' => 'success'
	// 		)
	// 	));
	// }

	/**
	 * Solicitud de reenvio de correo de activacion.
	 */
	// public function request_verification_email() {
	// 	if ($this->request->data) {
	// 		// @FIXME: que hacer en caso de que no este bien el formulario?
	// 		if (!isset($this->request->data['email'])) {
	// 			return $this->redirect('/');
	// 		}
	// 		# @TODO: Hacer esto un metodo del repositorio
	// 		$email = $this->request->data['email'];
	// 		$user = Users::findOneBy(array(
	// 			'email' => $email,
	// 			'emailVerified' => false,
	// 			'active' => true,
	// 		));
	// 		if ($user) {
	// 			AccountsMailer::register($user);
	// 			return $this->redirect('/', array(
	// 				'message' => array(
	// 					'La ha reenviado un correo de confirmacion para la activacion de usuario.',
	// 					'title' => 'Activacion de usuario',
	// 					'type' => 'success'
	// 				)
	// 			));
	// 		}
	// 		$this->flash(array(
	// 			'No existe el usuario para el correo indicado',
	// 			'title' => 'Error',
	// 			'type' => 'danger'
	// 		));
	// 	}
	// 	$user = new Users();
	// 	$user->set($this->request->data);
	// 	return compact('user');
	// }

}

?>
