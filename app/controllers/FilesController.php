<?php

namespace app\controllers;

use app\models\Files;
use app\models\LogEntry;
use li3_doctrine\models\ValidateException;
use lithium\action\DispatchException;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\OptimisticLockException;

class FilesController extends \app\controllers\AppController {

	protected $accessRules = array(
		// 'index' => array('allowAnyUser'),
		// 'view' => array('allowAnyUser'),
		'add' => array('allowAnyUser'),
		'edit' => array('allowAnyUser'),
		'delete' => array('allowAnyUser'),
		// 'versions' => array('allowAnyUser'),
	);

	// public function versions() {
	// 	if (!$id = $this->request->id) {
	// 		return $this->redirect('/');
	// 	}
	// 	$em = Files::getEntityManager();
	// 	$em->getFilters()->disable('soft-deleteable');
	// 	$file = Files::find($id);
	// 	if (!$file) {
	// 		return $this->redirect('/');
	// 	}
	// 	$entries = LogEntry::getLogEntries($file);
	// 	return compact('file', 'entries');
	// }

	// public function index() {
	// 	$pagination = $this->pagination;
	// 	$options = array(
	// 		'hydrationMode' => 'ObjectCollection'
	// 	);
	// 	$options += $pagination;
	// 	$result = Files::get($options);
	// 	$files = $result['records'];
	// 	$pagination = $result['pagination'];
	// 	return compact('files', 'pagination');
	// }

	// public function view() {
	// 	if (!$id = $this->request->id) {
	// 		return $this->redirect('/');
	// 	}
	// 	$file = Files::find($id);
	// 	if (!$file) {
	// 		return $this->redirect('/');
	// 	}
	// 	return compact('file');
	// }

	public function add() {
		$file = new Files();

		dump($this->request->imageType);

		if ($this->request->data && !empty($this->request->data['file'])) {
			try {
				//$file->set($this->request->data['file']);
				$em = Files::getEntityManager();
				$uploadableListener = Files::getUploadableListener();
				if ($uploadableListener === null) {
					throw new Exception("Listener not found", 1);
				}
				$uploadableListener->addEntityFileInfo(
					$file,
					$this->request->data['file']
				);
				//dump($this->request->data['file']);die();
				$em->persist($file);
				$em->flush($file);
				return $this->redirect(array(
					'Pages::lighting'					
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

		return compact('file');
	}

	public function edit() {
		if (!$id = $this->request->id) {
			return $this->redirect('/');
		}
		$file = Files::find($id);
		if (!$file) {
			return $this->redirect('/');
		}
		if ($this->request->data && !empty($this->request->data['file'])) {
			try {
				$data = $this->request->data['file'];
				if (!isset($data['version'])) {
					return $this->redirect('/');
				}
				$version = (int) $data['version'];
				$file = Files::find($id, LockMode::OPTIMISTIC, $version);

				$file->set($this->request->data['file']);
				$em = Files::getEntityManager();

				$em->persist($file);
				$em->flush();
				return $this->redirect(array(
					'Files::view',
					'id' => $file->id
				));
			} catch (ValidateException $e) {
				$this->flash(array(
					'Existen errores en el formulario. Favor de verificar',
					'title' => 'Error de validacion',
					'type' => 'warning'
				));
			} catch (OptimisticLockException $e) {
				$updatedBy = $file->updatedBy->getUsername();
				$this->flash(array(
					"`{$updatedBy->username}` realizo cambios a este objeto. Favor de verificar.",
					'title' => 'Error de version',
					'type' => 'danger'
				));
			}
		}

		$this->set(compact('file'));
		return $this->render(array(
			'template' => 'add'
		));
	}

	public function delete() {
		if (!$this->request->is('post') && !$this->request->is('delete')) {
			$msg = 'Files::delete can only be called with http:post or http:delete.';
			throw new DispatchException($msg);
		}
		if (!$id = $this->request->id) {
			return $this->redirect('/');
		}
		$file = Files::find($id);
		if (!$file) {
			return $this->redirect('/');
		}
		$em = Files::getEntityManager();

		$em->remove($file);
		$em->flush();

		return $this->redirect('Files::index');
	}
}




?>