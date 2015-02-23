<?php

namespace app\controllers;

use app\models\SeveralImages;

class SeveralImagesController extends \app\controllers\AppController {

	protected $accessRules = array(
		'view' => array('allowAnyUser'),
		'add' => array('denyUsers'),
		'delete' => array('denyUsers'),
	);

	public function view() {
		$images = SeveralImages::findAll();
		return $this->set(compact('images'));
	}

	public function add() {
		$several = new SeveralImages();

		if ($this->request->data && !empty($this->request->data['file'])) {
			try {
				$several->set($this->request->data);
				$em = SeveralImages::getEntityManager();
				$uploadableListener = SeveralImages::getUploadableListener();
				if ($uploadableListener === null) {
					throw new Exception("Listener not found", 1);
				}
				$uploadableListener->addEntityFileInfo(
					$several,
					$this->request->data['file']
				);
				//dump($this->request->data['corporate']);die();
				$em->persist($several);
				$em->flush($several);
				return $this->redirect(array(
					'SeveralImages::view'
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

		return compact('several');
	}

	public function delete() {		
		$em = SeveralImages::getEntityManager();

		$event = SeveralImages::find($this->request->id);
		$em->remove($event);
		$em->flush();

		return $this->redirect(array(
			'SeveralImages::view'
		));
	}

}