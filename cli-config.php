<?php
/**
 * Doctrine console setup.
 */

define('CONNECTION_NAME', 'default');
define('ENVIRONMENT', 'development');

require_once('app/config/bootstrap.php');

use lithium\core\Environment;
use lithium\data\Connections;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

Environment::set(ENVIRONMENT);

$connection = Connections::get(CONNECTION_NAME);

if (!$connection) {
	throw new Exception(
		'Can\'t locate lithium\'s database connection named `' . CONNECTION_NAME . '`.'
	);
}

$entityManager = $connection->getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);