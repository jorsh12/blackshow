namespace {:namespace};

use {:use};
use app\models\Casos;
use app\models\LogEntry;
use li3_doctrine\models\ValidateException;
use lithium\action\DispatchException;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\OptimisticLockException;

class {:class} extends \app\controllers\AppController {

	protected $accessRules = array(
		'index' => array('allowAnyUser'),
		'view' => array('allowAnyUser'),
		'add' => array('allowAnyUser'),
		'edit' => array('allowAnyUser'),
		'delete' => array('allowAnyUser'),
		'versions' => array('allowAnyUser'),
	);

	public function versions() {
		if (!$id = $this->request->id) {
			return $this->redirect('/');
		}
		$em = {:model}::getEntityManager();
		$em->getFilters()->disable('soft-deleteable');
		${:singular} = {:model}::find($id);
		if (!${:singular}) {
			return $this->redirect('/');
		}
		$entries = LogEntry::getLogEntries(${:singular});
		return compact('{:singular}', 'entries');
	}

	public function index() {
		$pagination = $this->pagination;
		$options = array(
			'hydrationMode' => 'ObjectCollection'
		);
		$options += $pagination;
		$result = {:model}::get($options);
		${:plural} = $result['records'];
		$pagination = $result['pagination'];
		return compact('{:plural}', 'pagination');
	}

	public function view() {
		if (!$id = $this->request->id) {
			return $this->redirect('/');
		}
		${:singular} = {:model}::find($id);
		if (!${:singular}) {
			return $this->redirect('/');
		}
		return compact('{:singular}');
	}

	public function add() {
		if (!$id = $this->request->id) {
			return $this->redirect('/');
		}

		$caso = Casos::find($id);
		if (!$caso) {
			return $this->redirect('/');
		}

		${:singular} = new {:model}($caso);

		if ($this->request->data && !empty($this->request->data['{:singular}'])) {
			try {
				${:singular}->set($this->request->data['{:singular}']);
				$em = {:model}::getEntityManager();

				$em->persist(${:singular});
				$em->flush();
				return $this->redirect(array(
					'{:name}::view',
					'id' => ${:singular}->id
				));
			} catch (ValidateException $e) {
				$this->flash(array(
					'Existen errores en el formulario, favor de verificar.',
					'title' => 'Error de validacion',
					'type' => 'warning'
				));
			}
		}

		return compact('{:singular}');
	}

	public function edit() {
		if (!$id = $this->request->id) {
			return $this->redirect('/');
		}
		${:singular} = {:model}::find($id);
		if (!${:singular}) {
			return $this->redirect('/');
		}
		if ($this->request->data && !empty($this->request->data['{:singular}'])) {
			try {
				$data = $this->request->data['{:singular}'];
				if (!isset($data['version'])) {
					return $this->redirect('/');
				}
				$version = (int) $data['version'];
				${:singular} = {:model}::find($id, LockMode::OPTIMISTIC, $version);

				${:singular}->set($this->request->data['{:singular}']);
				$em = {:model}::getEntityManager();

				$em->persist(${:singular});
				$em->flush();
				return $this->redirect(array(
					'{:name}::view',
					'id' => ${:singular}->id
				));
			} catch (ValidateException $e) {
				$this->flash(array(
					'Existen errores en el formulario. Favor de verificar',
					'title' => 'Error de validacion',
					'type' => 'warning'
				));
			} catch (OptimisticLockException $e) {
				$updatedBy = ${:singular}->updatedBy->getUsername();
				$this->flash(array(
					"`{$updatedBy}` realizo cambios a este objeto. Favor de verificar.",
					'title' => 'Error de version',
					'type' => 'danger'
				));
			}
		}

		$this->set(compact('{:singular}'));
		return $this->render(array(
			'template' => 'add'
		));
	}

	public function delete() {
		if (!$this->request->is('post') && !$this->request->is('delete')) {
			$msg = '{:name}::delete can only be called with http:post or http:delete.';
			throw new DispatchException($msg);
		}
		if (!$id = $this->request->id) {
			return $this->redirect('/');
		}
		${:singular} = {:model}::find($id);
		if (!${:singular}) {
			return $this->redirect('/');
		}
		$em = {:model}::getEntityManager();

		$em->remove(${:singular});
		$em->flush();

		return $this->redirect('{:name}::index');
	}
}
