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

	public function getUserId($userName) {
		$sql = "SELECT * FROM users WHERE user_name=:userName";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(':userName', $userName);
		$stmt->execute();
		$userId = $stmt->fetch(\PDO::FETCH_OBJ);
		return $userId;
	}

	public function insertMessage(int $userId, int $roomId, string $message, string $color)
	{
		$date = time();
		$sql  = "INSERT INTO messages (user_id, room_id, text, date, color) VALUES (:user, :room, :msg, :date, :color)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':user', $userId);
		$stmt->bindParam(':room', $roomId);
        $stmt->bindParam(':msg', $message);
		$stmt->bindParam(':date', $date);
		$stmt->bindParam(':color', $color);
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
		$sql  = "SELECT * FROM
				(SELECT * FROM messages
				JOIN rooms ON messages.room_id=rooms.roomId
				JOIN users ON messages.user_id=users.userId
				WHERE room_id=:roomId
				ORDER BY `messages`.`date` DESC LIMIT 10)
				as msg ORDER BY msg.date";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(":roomId", $roomId);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		if(!isset($data[0]['user_name'])) {
			$sql = "SELECT * FROM rooms WHERE roomId=:roomId";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(":roomId", $roomId);
			$stmt->execute();
			$data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}
		return $data;
	}
}
