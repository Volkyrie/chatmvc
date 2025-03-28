<?php

namespace MyApp\Models;

use MyApp\Config\DbConnection;

class chatModel 
{
	protected $dbh;

	public function __construct()
	{
		$dbh = DbConnection::getInstance();
		$this->dbh = $dbh->getConnection();
	}

	public function insertMessage(int $userId, int $roomId, string $message)
	{
		$sql  = "INSERT INTO users (user_id, room_id, text) VALUES (:user, :room, :msg)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':user', $userId);
		$stmt->bindParam(':room', $roomId);
        $stmt->bindParam(':msg', $message);
        $stmt->execute();
	}

	public function getRooms()
	{
		$sql  = "SELECT * FROM rooms";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $data;
	}

	public function getMessages($roomId)
	{
		$sql  = "SELECT * FROM messages WHERE room_id=:roomId";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(":roomId", $roomId);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $data;
	}
}
