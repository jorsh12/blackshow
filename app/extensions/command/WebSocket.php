<?php

namespace app\extensions\command;

use ZMQ;
use Ratchet\App;
use React\EventLoop\Factory;
use React\ZMQ\Context;
use app\extensions\websockets\WebSocketsApp;
use app\extensions\websockets\WampApp;

class WebSocket extends \lithium\console\Command {

	protected $host = 'localhost';
	protected $port = '1234';
	protected $bind = '0.0.0.0';

	protected $context = null;
	protected $socket = null;

	protected function _init() {
		parent::_init();
		xdebug_disable();

		$loop = Factory::create();
		$this->context = new Context($loop);
		$this->socket = $this->context->getSocket(ZMQ::SOCKET_PULL);
		$this->socket->bind('tcp://127.0.0.1:6666');

		$this->app = new App(
			$this->host,
			$this->port,
			$this->bind,
			$loop
		);
	}

	public function run($command = null) {
		foreach ($this->routes() as $route) {
			$route += [
				'path' => null,
				'controller' => null,
				'allowedOrigins' => [],
				'httpHost' => null,
			];
			$this->app->route(
				$route['path'],
				$route['controller'],
				$route['allowedOrigins'],
				$route['httpHost']
			);
		}
		$this->out(sprintf(
			"Host: %s\nPort: %s\nBind: %s",
			$this->host,
			$this->port,
			$this->bind
		));
		$this->app->run();
	}

	public function routes() {
		$wamp = new WampApp($this);
		$this->socket->on('message', array(&$wamp, 'onEntry'));

		return [
			[
				'path' => '/example',
				'controller' => new WebSocketsApp($this),
			],
			[
				'path' => '/wamp',
				'controller' => $wamp,
			],
		];
	}

}

?>
