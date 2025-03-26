<?php

namespace MyApp\Models;


class chatModel 
{
	protected $dbh;

	public function __construct()
	{
		//$this->dbh = $this->getConnection();
	}

	public function insertMessage(int $userId, int $roomId, string $message)
	{
		
	}

	public function getRooms()
	{
		
	}

	public function getMessages($roomId)
	{
		
	}
}
