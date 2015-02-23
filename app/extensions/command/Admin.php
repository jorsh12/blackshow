<?php

namespace app\extensions\command;

use app\models\Users;

class Admin extends \lithium\console\Command {

	public function run($command = null) {
		$this->out($command);
	}

	protected function users() {
		$qb = Users::createQueryBuilder('u');

		$qb
			->select([
				'u.id',
				'u.email',
			])
			->orderBy('u.id', 'ASC')
		;
		$results = $qb->getQuery()->getResult();

		$table = [
			['ID', 'Email'],
			['--', '-------']
		];

		$this->columns(array_merge($table, $results));
		return true;
	}

	protected function create() {
		var_dump("entre");
		$user = new Users();

		$user->setEmail($this->in('Email: '));
		$user->setNombre($this->in('Nombre: '));
		$user->setApellidoPaterno($this->in('Apellido Paterno: '));
		$user->setApellidoMaterno($this->in('Apellido Materno: '));
		$user->setPassword($this->in('Password: '));

		$user->setActive(true);
		$user->setEmailVerified(true);
		$user->setMustChangePassword(true);		

		$user->save(array(), array(), array('flush' => true));
	}

	protected function password($email) {
		if (!$user = Users::findOneBy(compact('email'))) {
			$this->error('No se encuentra el usuario especificado.');
			return false;
		}

		$options = ['quit' => ''];

		$this->out("User: {$user->email}");
		$result = $this->in('Ingrese nuevo password: ', $options);

		if ($result === false) {
			$this->out('Cambio de password cancelado.');
			return true;
		}

		$user->setPassword($result);
		Users::getEntityManager()->flush($user);

		$this->out('Cambio de password exitoso.');
		return true;
	}

}

?>