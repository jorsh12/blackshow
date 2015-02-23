<?php

namespace app\controllers;

use app\models\CorporateImages;

class CorporateImagesController extends \app\controllers\AppController {

	protected $accessRules = array(
		'view' => array('allowAnyUser'),
		'add' => array('denyUsers'),
		'delete' => array('denyUsers'),
	);

	public function view() {
		$images = CorporateImages::findAll();
		return $this->set(compact('images'));
	}

	public function add() {
		$corporate = new CorporateImages();

		if ($this->request->data && !empty($this->request->data['file'])) {
			// list($width, $height, $type, $attr) = getimagesize($this->request->data['file']['tmp_name']);
			// dump($width, $height, $type, $attr);
			try {				
				$corporate->set($this->request->data);
				$em = CorporateImages::getEntityManager();
				$uploadableListener = CorporateImages::getUploadableListener();
				if ($uploadableListener === null) {
					throw new Exception("Listener not found", 1);
				}
				$uploadableListener->addEntityFileInfo(
					$corporate,
					$this->request->data['file']
				);
				//dump($this->request->data['corporate']);die();
				$em->persist($corporate);
				$em->flush($corporate);
				return $this->redirect(array(
					'CorporateImages::view'
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

		return compact('corporate');
	}

	public function delete() {		
		$em = CorporateImages::getEntityManager();

		$event = CorporateImages::find($this->request->id);
		$em->remove($event);
		$em->flush();

		return $this->redirect(array(
			'CorporateImages::view'
		));
	}

}