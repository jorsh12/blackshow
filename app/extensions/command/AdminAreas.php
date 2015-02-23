<?php

namespace app\extensions\command;

use app\models\Areas;
use lithium\core\Libraries;
use lithium\util\Inflector;

class AdminAreas extends \lithium\console\Command {

	public function run($command = null) {
		$em = Areas::getEntityManager();

		$cjm = new Areas();
		$cjm->set([
			'nombre' => 'CJM'
		]);
		$em->persist($cjm);

		$data = array();
		//$controllers = Libraries::locate('controllers');
		//foreach ($controllers as $class) {
			//$name = preg_replace('/Controller$/', '', substr($class, strrpos($class, '\\') + 1));
			//$library = Libraries::get($class);
			//$data[$library][] = $name;
			////dump($class, $name, $library);
		//}
		$libraries = array(
			'entrevista',
			'medico_general',
			'trabajo_social',
		);
		$models = Libraries::locate('models');
		foreach ($models as $class) {
			$name = substr($class, strrpos($class, '\\') + 1);
			if (strpos($name, 'Repository') !== false) {
				continue;
			}
			$library = Libraries::get($class);
			if (!in_array($library, $libraries)) continue;
			$data[$library][] = $name;
			//dump($class, $name, $library);
		}
		foreach ($data as $library => $areas) {
			$libArea = new Areas();
			$libArea->set([
				'nombre' => Inflector::humanize($library),
				'parent' => $cjm,
			]);
			$em->persist($libArea);
			foreach ($areas as $area) {
				$newArea = new Areas();
				$newArea->set([
					'nombre' => Inflector::humanize(Inflector::underscore($area)),
					'library' => $library,
					'controller' => $area,
					'parent' => $libArea,
				]);
				$em->persist($newArea);
			}
		}
		$em->flush();
	}
}

?>
