<?php

namespace app\models\repositories;

use Doctrine\ORM\Query;

class EntityRepository extends \Doctrine\ORM\EntityRepository {

	public function get($options = array()) {
		$defaults = array(
			'alias' => $this->_entityName,
			'hydrationMode' => Query::HYDRATE_OBJECT,
			'page' => 0,
			'limit' => 20,
			'sort' => null,
			'order' => 'ASC',
		);
		$options += $defaults;

		$metadata = $this->_em->getClassMetadata($this->_entityName);

		//if (empty($options['sort'])) {
			//$options['sort'] = array();
			//foreach ($this->_class->getIdentifier() as $identifier) {
				//$sort = "{$options['alias']}.{$identifier}";
				//$order = 'ASC';
				//$options['sort'][$sort] = $order;
			//}
		//}

		$qb = $this->createQueryBuilder($options['alias']);

		// WHERE
		//$qb
			//->andWhere(array(
			//))
			//->setParameters(array(
			//)
		//;

		// JOINS
		//$qb
			//->join($options['alias'] . '.createdBy', 'createdBy')
			//->join($options['alias'] . '.updatedBy', 'updatedBy')
		//;

		$qb->select("count({$options['alias']})");

		$query = $qb->getQuery();
		$totalRecords = (int) $query->getSingleScalarResult();

		$qb->select($options['alias']);

		// JOINS
		//$qb
			//->addSelect(array(
				//'createdBy',
				//'updatedBy',
			//))
		//;

		// PAGINATION
		$offset = $options['page'] * $options['limit'];
		$qb
			->setFirstResult($offset)
			->setMaxResults($options['limit'])
		;

		// ORDER
		if ($metadata->hasField($options['sort'])) {
			$sort = "{$options['alias']}.{$options['sort']}";
			$qb->orderBy($sort, $options['order']);
		}
		//elseif (is_array($options['sort'])) {
			//foreach ($options['sort'] as $sort => $order) {
				//if (is_numeric($sort)) {
					//$sort = $order;
					//$order = null;
				//}
				//$qb->addOrderBy($sort, $order);
			//}
		//}

		$pagination = array(
			'page' => $options['page'],
			'limit' => $options['limit'],
			'sort' => $options['sort'],
			'order' => $options['order'],
			'totalRecords' => $totalRecords
		);

		$query = $qb->getQuery();
		$records = $query->getResult($options['hydrationMode']);

		return compact('records', 'pagination');
	}


}
