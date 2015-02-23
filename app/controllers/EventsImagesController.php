<?php

namespace app\controllers;

use app\models\EventsImages;

class EventsImagesController extends \app\controllers\AppController {

	protected $accessRules = array(
		'view' => array('allowAnyUser'),
		'add' => array('denyUsers'),
		'delete' => array('denyUsers'),
	);

	public function view() {
		$images = EventsImages::findAll();
		return $this->set(compact('images'));
	}

	public function add() {
		$event = new EventsImages();

		if ($this->request->data && !empty($this->request->data['file'])) {
			try {
				$event->set($this->request->data);
				$em = EventsImages::getEntityManager();
				$uploadableListener = EventsImages::getUploadableListener();
				if ($uploadableListener === null) {
					throw new Exception("Listener not found", 1);
				}
				$uploadableListener->addEntityFileInfo(
					$event,
					$this->request->data['file']
				);

				$em->persist($event);
				$em->flush($event);
				return $this->redirect(array(
					'EventsImages::view'
				));
			} catch (ValidateException $e) {
				$this->flash(array(
					'Existen errores en el formulario, favor de verificar.',
					'title' => 'Error de validacion',
					'type' => 'warning'
				));
			} catch(UploadableException $e) {
				$this->flash(array(
					$e->getMessage(),
					'title' => 'Error',
					'type' => 'warning'
				));
			}
		}

		return compact('event');
	}

	public function delete() {
		if (!$id = $this->request->id) {
			return $this->redirect('/');
		}
		
		$event = EventsImages::find($id);
		if (!$event) {
			return $this->redirect('/');
		}

		$em = EventsImages::getEntityManager();
		$em->remove($event);
		$em->flush();

		return $this->redirect(array(
			'EventsImages::view'
		));
	}

}