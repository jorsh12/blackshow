<?php

namespace app\controllers;

use app\models\TheatresImages;

class TheatresImagesController extends \app\controllers\AppController {

	protected $accessRules = array(
		'view' => array('allowAnyUser'),
		'add' => array('denyUsers'),
		'delete' => array('denyUsers'),
	);

	public function view() {
		$images = TheatresImages::findAll();
		return $this->set(compact('images'));
	}

	public function add() {
		$theatres = new TheatresImages();

		if ($this->request->data && !empty($this->request->data['file'])) {
			try {
				$theatres->set($this->request->data);
				$em = TheatresImages::getEntityManager();
				$uploadableListener = TheatresImages::getUploadableListener();
				if ($uploadableListener === null) {
					throw new Exception("Listener not found", 1);
				}
				$uploadableListener->addEntityFileInfo(
					$theatres,
					$this->request->data['file']
				);
				//dump($this->request->data['corporate']);die();
				$em->persist($theatres);
				$em->flush($theatres);
				return $this->redirect(array(
					'TheatresImages::view'
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

		return compact('theatres');
	}

	public function delete() {		
		$em = TheatresImages::getEntityManager();

		$event = TheatresImages::find($this->request->id);
		$em->remove($event);
		$em->flush();

		return $this->redirect(array(
			'TheatresImages::view'
		));
	}

}