<?php

namespace app\controllers;

use app\models\ContactUs;
use app\models\Texts;

use li3_swiftmailer\mailer\Transports;
use li3_swiftmailer\mailer\Message;

use lithium\template\View;

class ContactUsController extends \app\controllers\AppController {

	protected $accessRules = array(
		//'view' => array('allowAnyUser'),
		'add' => array('allowAnyUser'),
	);

	// public function view() {
	// 	return $this->render();
	// }

	public function add() {
		$contactUs = new ContactUs();
		$texto = Texts::findOneBy(array('page' => 'contact_us'));
		if ($texto == null){
			$texto = new Texts();
		}

		if ($this->request->data) {
			try {

				$contactUs->set($this->request->data);

				$em = ContactUs::getEntityManager();
				$em->persist($contactUs);
				$em->flush();
				
				$templateEmail = new View(array(
		            'paths' => array(
		                'template' => '{:library}/views/elements/mail.html.php'
		            )
		        ));

				$data = $this->request->data;
		        $templateEmail = $templateEmail->render('all', compact('data'));

				$mailer = Transports::adapter('default');
				$message = Message::newInstance()
					->setSubject('Mensaje de Blackshow')
					->setFrom(array($data['email'] => $data['name']))
					->setTo(array(
				  		'jorge.pena@durango.gob.mx' => 'Jorge Peña',
					))
					->setBody($templateEmail, 'text/html');
				$mailer->send($message);

				return $this->redirect(array(
					'ContactUs::add'
				));

			} catch (ValidateException $e) {
				$this->flash(array(
					'Existen errores en el formulario, favor de verificar.',
					'title' => 'Error de validacion',
					'type' => 'warning'
				));
			}
		}

		return compact('contactUs', 'texto');
	}

	public function updateTexto() {
		
		if ($this->request->data) {
			$em = Texts::getEntityManager();
			
			$texto = Texts::findOneBy(array('page' => $this->request->data['page']));
			if ($texto == null) {
				$texto = new Textos();	
			}
			$texto->set($this->request->data);
			$em->persist($texto);
			$em->flush();
		}

		return $this->redirect('ContactUs::add');
	}

	// public function delete() {		
	// 	$em = CorporateImages::getEntityManager();

	// 	$event = CorporateImages::find($this->request->id);
	// 	$em->remove($event);
	// 	$em->flush();

	// 	return $this->redirect(array(
	// 		'CorporateImages::view'
	// 	));
	// }

}