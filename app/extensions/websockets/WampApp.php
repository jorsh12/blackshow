<?php

namespace app\extensions\websockets;

use Exception;
use Ratchet\ConnectionInterface;
use SplObjectStorage;

class WampApp implements \Ratchet\Wamp\WampServerInterface {

	public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
		var_dump($conn, $topic, $event);
		$topic->broadcast($event);
	}

	public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
		var_dump($conn, $id, $topic, $params);
		$conn->callError($id, $topic, 'RPC not supported on this demo');
	}

	public function onMessage(ConnectionInterface $conn, $msg) { }

	protected $subscribedTopics = array();
	public function onSubscribe(ConnectionInterface $conn, $topic) {
		$this->subscribedTopics[$topic->getId()] = $topic;
	}
	public function onUnSubscribe(ConnectionInterface $conn, $topic) {}

	public function onOpen(ConnectionInterface $conn) {}

	public function onClose(ConnectionInterface $conn) {}

	public function onError(ConnectionInterface $conn, Exception $e) {}

	public function onEntry($entry) {
		$entry = json_decode($entry, true);
		$key = 'category';
		if (
			!$entry ||
			empty($entry[$key]) ||
			!array_key_exists($entry[$key], $this->subscribedTopics)
		) {
			return;
		}
		var_dump($entry[$key], $entry);
		$topic = $this->subscribedTopics[$entry[$key]];
		$topic->broadcast($entry);
	}

}

?>
