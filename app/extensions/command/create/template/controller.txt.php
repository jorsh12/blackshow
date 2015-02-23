namespace {:namespace};

use {:use};
use li3_doctrine\models\ValidateException;
use lithium\action\DispatchException;

class {:class} extends \app\controllers\AppController {

	protected $accessRules = array(
		'index' => array('allowAnyUser'),
		'view' => array('allowAnyUser'),
		'add' => array('allowAnyUser'),
		'edit' => array('allowAnyUser'),
		'delete' => array('allowAnyUser'),
	);

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
		${:singular} = new {:model}();

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

