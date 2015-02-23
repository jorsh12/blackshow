<?php

namespace app\models;

use DateTime;
use lithium\core\Environment;
use lithium\util\Inflector;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\DBAL\Types\Type;

/**
 * DoctrineEntity
 */
abstract class DoctrineEntity extends \li3_doctrine\models\DoctrineEntity {

	public function onPrePersist(LifecycleEventArgs $eventArgs) {
		parent::onPrePersist($eventArgs);
	}

	public function onPreUpdate(PreUpdateEventArgs $eventArgs) {
		parent::onPreUpdate($eventArgs);
	}

	public function setIfEmpty(array $data, array $whitelist = array()) {
		if (!empty($whitelist)) {
			$data = array_intersect_key($data, array_flip($whitelist));
		}
		foreach ($data as $name => $value) {
			$oldValue = $this->__get($name);
			if ($oldValue instanceof DoctrineEntity) {
				$oldValue->setIfEmpty($value);
			} elseif (empty($oldValue)) {
				$this->__set($name, $value);
			}
		}
	}

	# @TODO: Esta cosa es un desmadre, de verdad lo siento.
	public function formFields(array $whitelist = array(), $binding = null) {
		if (Environment::is('development')) {
			$types = array(
				'string' => 'text',
				'integer' => 'number',
				'bigint' => 'number',
				'smallint' => 'number',
				'float' => 'number',
				'boolean' => 'checkbox',
				'text' => 'textarea',
				'object' => 'textarea',
				'array' => 'select',
				'simple_array' => 'select',
				'json_array' => 'select',
				'guid' => 'text',
				'date' => 'date',
				'time' => 'time',
				'datetime' => 'datetime',
				'datetimez' => 'datetime-local',
				//'blob',
			);
			$meta = $this->_getClassMetadata();
			$missing = array();
			foreach ($meta->fieldMappings as $name => $mapping) {
				if (
					!isset($this->formFields[$name]) &&
					isset($types[$mapping['type']])
				) {
					$type = $types[$mapping['type']];

					if (
						(
							isset($mapping['declared']) && in_array(
								$mapping['declared'], array(
									'app\models\AuditableEntity',
									'app\models\SoftAuditableEntity'
								)
							)
						) &&
						$meta->versionField !== $mapping['fieldName']
					) {
						continue;
					}

					if (
						(!empty($mapping['id']) && $mapping['id']) ||
						($meta->isVersioned && $meta->versionField === $mapping['fieldName'])
					) {
						$type = 'hidden';
					}

					$missing[$name] = array(
						'type' => $type,
					);

					if ($type !== 'hidden') {
						$missing[$name] += array(
							'label' => Inflector::humanize(Inflector::underscore($name)),
							'placeholder' => Inflector::humanize(Inflector::underscore($name)),
						);
					}

					$this->formFields[$name] = $missing[$name] + array(
						'readonly' => true,
						'disabled' => true,
						'placeholder' => "Missing form field `{$meta->name}::{$name}`",
						'wrap' => array('class' => 'form-group has-error'),
					);
				}
			}
			$export = $missing + $this->formFields;
			$export = var_export($export, true);
			$this->formFields['_formFields'] = array(
				'disabled' => true,
				'readonly' => true,
				'label' => "#  `{$meta->name}::formFields`",
				'type' => 'textarea',
				'rows' => 15,
				'value' => "# {$meta->name}\nprotected \$formFields = {$export};"
			);
		}
		return parent::formFields($whitelist, $binding);
	}

	public function formatDate(DateTime $date, $format = 'datetime') {
		switch ($format) {
            case Type::DATE:
			case 'date':
				return $date->format('Y-m-d');
			break;
			case Type::TIME:
			case 'time':
				return $date->format('H:i:s');
			break;
			case Type::DATETIME:
			case 'datetime':
			case Type::DATETIMETZ:
			case 'datetime-local':
				return $date->format(DateTime::RFC3339);
			break;
			default:
				return $date->format($format);
		}
	}

	public function data($name = null) {
		$data = parent::data($name);
		if (!empty($name)) {
			$metadata = $this->_getClassMetadata();
			if ($data instanceof DateTime) {
				$type = $metadata->getTypeOfField($name) ? : Type::DATETIME;
				$data = $this->formatDate($data, $type);
			}
			if ($data instanceof DoctrineEntity) {
				if (method_exists($data, "getId") && is_callable(array($data, "getId"))) {
					$data = $data->getId();
				}
			}
			if ($data instanceof \Doctrine\ORM\PersistentCollection) {
				$data = $data->getKeys();
			}
		}
		return $data;
	}

	public function set(array $data, array $whitelist = array()) {
		if (!empty($whitelist)) {
			$data = array_intersect_key($data, array_flip($whitelist));
		}
		$metadata = $this->_getClassMetadata();
		foreach ($data as $field => $value) {
			if ($metadata->hasField($field)) {
				$type = $metadata->getTypeOfField($field);
				if (
					in_array($type, array(
						Type::DATETIME,
						Type::DATETIMETZ,
						Type::DATE,
						Type::TIME
					)) &&
					!($value instanceof DateTime) &&
					is_string($value)
				) {
					$data[$field] = new DateTime($value);
				}
			}
		}
		return parent::set($data);
	}

}
