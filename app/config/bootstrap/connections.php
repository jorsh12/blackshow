<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

/**
 * ### Configuring backend database connections
 *
 * Lithium supports a wide variety relational and non-relational databases, and is designed to allow
 * and encourage you to take advantage of multiple database technologies, choosing the most optimal
 * one for each task.
 *
 * As with other `Adaptable`-based configurations, each database configuration is defined by a name,
 * and an array of information detailing what database adapter to use, and how to connect to the
 * database server. Unlike when configuring other classes, `Connections` uses two keys to determine
 * which class to select. First is the `'type'` key, which specifies the type of backend to
 * connect to. For relational databases, the type is set to `'database'`. For HTTP-based backends,
 * like CouchDB, the type is `'http'`. Some backends have no type grouping, like MongoDB, which is
 * unique and connects via a custom PECL extension. In this case, the type is set to `'MongoDb'`,
 * and no `'adapter'` key is specified. In other cases, the `'adapter'` key identifies the unique
 * adapter of the given type, i.e. `'MySql'` for the `'database'` type, or `'CouchDb'` for the
 * `'http'` type. Note that while adapters are always specified in CamelCase form, types are
 * specified either in CamelCase form, or in underscored form, depending on whether an `'adapter'`
 * key is specified. See the examples below for more details.
 *
 * ### Multiple environments
 *
 * As with other `Adaptable` classes, `Connections` supports optionally specifying different
 * configurations per named connection, depending on the current environment. For information on
 * specifying environment-based configurations, see the `Environment` class.
 *
 * @see lithium\core\Adaptable
 * @see lithium\core\Environment
 */
use lithium\data\Connections;
use lithium\storage\Cache;
use Doctrine\Common\Cache\MemcachedCache;
use Doctrine\Common\Cache\ApcCache;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\DBAL\Event\Listeners\OracleSessionInit;

$models = array(
	LITHIUM_APP_PATH . '/models/mappings',
);
// Agregar mappings de librerias dentro de `app/libraries/`
// @TODO: Cargar solo de las librarias registradas en lithium
$models = array_merge($models, glob(LITHIUM_APP_PATH . "/libraries/*/models/mappings"));

$common = array(
	'type' => 'Doctrine',
	'driver' => 'pdo_mysql',
	'mapping' => 'yml',
	'models' => $models,
	'cache' => function() {
		$cache = new ArrayCache();
		//if (extension_loaded('memcached')) {
			//$memcached = Cache::adapter('memcached')->connection;
			//$cache = new MemcachedCache();
			//$cache->setMemcached($memcached);
		//} elseif (extension_loaded('apc')) {
			//$cache = new ApcCache();
		//}
		return $cache;
	},
	'filters' => array(
		'createEntityManager' => function($self, $params, $chain) {
			// $params['eventManager']->addEventSubscriber(
			// 	new OracleSessionInit(array(
			// 		'NLS_DATE_FORMAT' => 'YYYY-MM-DD HH24:MI:SS',
			// 		'NLS_COMP' => 'LINGUISTIC',
			// 		'NLS_SORT' => 'BINARY_CI',
			// 	))
			// );
			// http://www.doctrine-project.org/jira/browse/DBAL-434
			// $conn->getDatabasePlatform()->registerDoctrineTypeMapping('date', 'date');

			$repository = '\\app\\models\\repositories\\EntityRepository';
			$params['config']->setDefaultRepositoryClassName($repository);

			$rtel = new Doctrine\ORM\Tools\ResolveTargetEntityListener();
			// Adds a target-entity class
			$rtel->addResolveTargetEntity(
				'app\\models\\AuthUser',
				'app\\models\\Users',
				array()
			);
			// Add the ResolveTargetEntityListener
			$params['eventManager']->addEventListener(
				Doctrine\ORM\Events::loadClassMetadata,
				$rtel
			);

			$metadataCache = $params['config']->getMetadataCacheImpl();
			$annotationReader = new Doctrine\Common\Annotations\AnnotationReader();
			$cachedAnnotationReader = new Doctrine\Common\Annotations\CachedReader(
				$annotationReader,
				$metadataCache
			);

			//Doctrine\Common\Annotations\AnnotationRegistry::registerFile(
				//LITHIUM_LIBRARY_PATH . '/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php'
			//);
			//$driverChain = new Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain();
			//$originalDriver = $params['config']->getMetadataDriverImpl();
			//$driverChain->setDefaultDriver($originalDriver);
			////$annotationDriver = new Doctrine\ORM\Mapping\Driver\AnnotationDriver(
				////$cachedAnnotationReader,
				////array(
					////LITHIUM_APP_PATH . '/models/annotations'
				////)
			////);
			////$driverChain->addDriver($annotationDriver, 'app\\models\\annotations');
			//$driverChain->addDriver($originalDriver, 'app\\models');
			//$driverChain->setDefaultDriver($originalDriver);
			//Gedmo\DoctrineExtensions::registerAbstractMappingIntoDriverChainORM(
				//$driverChain, // our metadata driver chain, to hook into
				//$cachedAnnotationReader // our cached annotation reader
			//);
			//$params['config']->setMetadataDriverImpl($driverChain);

			$softDeleteableListener = new Gedmo\SoftDeleteable\SoftDeleteableListener;
			$softDeleteableListener->setAnnotationReader($cachedAnnotationReader);
			$params['eventManager']->addEventSubscriber($softDeleteableListener);
			$params['config']->addFilter(
				'soft-deleteable',
				'Gedmo\SoftDeleteable\Filter\SoftDeleteableFilter'
			);

			// $translatableListener = new Gedmo\Translatable\TranslatableListener;
			// $translatableListener->setAnnotationReader($cachedAnnotationReader);
			// $params['eventManager']->addEventSubscriber($translatableListener);

			$treeListener = new Gedmo\Tree\TreeListener;
			$treeListener->setAnnotationReader($cachedAnnotationReader);
			$params['eventManager']->addEventSubscriber($treeListener);

			$uploadableListener = new Gedmo\Uploadable\UploadableListener;
			$uploadableListener->setAnnotationReader($cachedAnnotationReader);
			$params['eventManager']->addEventSubscriber($uploadableListener);

			$sortableListener = new Gedmo\Sortable\SortableListener;
			$sortableListener->setAnnotationReader($cachedAnnotationReader);
			$params['eventManager']->addEventSubscriber($sortableListener);

			$sluggableListener = new Gedmo\Sluggable\SluggableListener;
			$sluggableListener->setAnnotationReader($cachedAnnotationReader);
			$params['eventManager']->addEventSubscriber($sluggableListener);

			$timestampableListener = new Gedmo\Timestampable\TimestampableListener;
			$timestampableListener->setAnnotationReader($cachedAnnotationReader);
			$params['eventManager']->addEventSubscriber($timestampableListener);

			$ipTraceableListener = new Gedmo\IpTraceable\IpTraceableListener;
			$ipTraceableListener->setAnnotationReader($cachedAnnotationReader);
			$params['eventManager']->addEventSubscriber($ipTraceableListener);

			$blameableListener = new Gedmo\Blameable\BlameableListener;
			$blameableListener->setAnnotationReader($cachedAnnotationReader);
			$params['eventManager']->addEventSubscriber($blameableListener);

			$loggableListener = new Gedmo\Loggable\LoggableListener;
			$loggableListener->setAnnotationReader($cachedAnnotationReader);
			$params['eventManager']->addEventSubscriber($loggableListener);

			//$blameableListener->setUserValue($user);
			//$ipTraceableListener->setIpValue($ip);
			//$loggableListener->setUsername($user->getUsername());
			//$uploadableListener->setDefaultPath(LITHIUM_APP_PATH . '/resources/uploads');

			$em = $chain->next($self, $params, $chain);
			return $em;
		},
	)
);

Connections::add('default', array(
	'development' => array(
		'host' => 'localhost',
		'user' => 'blackshow',
		'password' => 'blackshow',
		'dbname' => 'blackshow',
		'charset'  => 'utf8',
	) + $common,
	'test' => array(
		'host' => 'localhost',
		'user' => 'u185261589_bshow',
		'password' => 'bshow15973',
		'dbname' => 'u185261589_bshow',
		'charset'  => 'utf8',
	) + $common,
	'production' => array(
		// 'host' => 'localhost',
		// 'user' => 'CJM',
		// 'password' => 'CJM',
		// 'dbname' => 'CJM',
		// 'charset'  => 'utf8',
	) + $common,
));

use app\models\Users;

$dispatcherFilter = function($self, $params, $chain) {
	// Configuration for the Doctrine listeners
	$connection = Connections::get('default');

	$em = $connection->getEntityManager();
	$em->getFilters()->enable('soft-deleteable');

	$user = Users::current();

	$eventManager = $connection->getEventManager();
	foreach ($eventManager->getListeners('prePersist') as $listener) {
		if ($listener instanceof Gedmo\Blameable\BlameableListener) {
			$listener->setUserValue($user ? : 'Anonymous');
		}
		if ($listener instanceof Gedmo\IpTraceable\IpTraceableListener) {
			$ip = $params['request']->env('REMOTE_ADDR');
			$listener->setIpValue($ip ? : '::1');
		}
	}
	foreach ($eventManager->getListeners('onFlush') as $listener) {
		if ($listener instanceof Gedmo\Loggable\LoggableListener) {
			if ($user) {
				$username = $user->getEmail();
				$listener->setUsername($username);
			}
		}
		if ($listener instanceof Gedmo\Uploadable\UploadableListener) {
			$listener->setDefaultPath(LITHIUM_APP_PATH . '/webroot/img/uploads');
		}
		// if ($listener instanceof Gedmo\Translatable\TranslatableListener) {
		// 	$listener->setDefaultLocale('es_ES');
		// 	$listener->setPersistDefaultLocaleTranslation(true);
		// }
	}
	return $chain->next($self, $params, $chain);
};
\lithium\action\Dispatcher::applyFilter('_call', $dispatcherFilter);
\lithium\console\Dispatcher::applyFilter('_call', $dispatcherFilter);


/**
 * Uncomment this configuration to use MongoDB as your default database.
 */
// Connections::add('default', array(
// 	'type' => 'MongoDb',
// 	'host' => 'localhost',
// 	'database' => 'my_app'
// ));

/**
 * Uncomment this configuration to use CouchDB as your default database.
 */
// Connections::add('default', array(
// 	'type' => 'http',
// 	'adapter' => 'CouchDb',
// 	'host' => 'localhost',
// 	'database' => 'my_app'
// ));

/**
 * Uncomment this configuration to use MySQL as your default database.
 */
// Connections::add('default', array(
// 	'type' => 'database',
// 	'adapter' => 'MySql',
// 	'host' => 'localhost',
// 	'login' => 'root',
// 	'password' => '',
// 	'database' => 'my_app',
// 	'encoding' => 'UTF-8'
// ));

?>