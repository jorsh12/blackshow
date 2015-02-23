<?php

namespace app\extensions\websockets;

use Exception;
use Ratchet\ConnectionInterface;
use SplObjectStorage;
use app\models\Usuarios;
use lithium\console\Command;

class WebSocketsApp implements \Ratchet\MessageComponentInterface {

	protected $cmd;
	protected $clients;

	public function __construct(Command $cmd) {
		$this->cmd = $cmd;
		$this->clients = new SplObjectStorage();
	}

	public function onOpen(ConnectionInterface $conn) {
		$this->cmd->out(sprintf(
			"Connected [(%d) %s]",
			$conn->resourceId,
			$conn->remoteAddress
		));
		$this->clients->attach($conn);
		$this->send($conn, 'CONNECTED');
	}

	public function onMessage(ConnectionInterface $conn, $msg) {
		$this->cmd->out(sprintf(
			"Message [(%d) %s]",
			$conn->resourceId,
			$conn->remoteAddress
		));
		$this->send($conn, $msg);
		switch ($msg) {
			case 'users':
				$usuarios = Usuarios::findAll();
				foreach ($usuarios as $usuario) {
					$this->send($conn, $usuario->nombre);
				}
			break;
		}
	}

	public function onClose(ConnectionInterface $conn) {
		$this->cmd->out(sprintf(
			"Disconnected [(%d) %s]",
			$conn->resourceId,
			$conn->remoteAddress
		));
		$this->clients->detach($conn);
		$this->send($conn, 'DISCONNECTED');
	}

	public function onError(ConnectionInterface $conn, Exception $e) {
		$this->cmd->out(sprintf(
			"Error [(%d) %s]",
			$conn->resourceId,
			$conn->remoteAddress
		));
		$this->cmd->error(var_export($e, true));
	}

	protected function send(ConnectionInterface $conn, $message) {
		$data = [
			'from' => [
				'resource' => $conn->resourceId,
				'ip' => $conn->remoteAddress,
			],
			'message' => $message
		];
		foreach ($this->clients as $client) {
			$client->send(json_encode($data));
		}
	}

}
?>