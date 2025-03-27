<?php

namespace MyApp\Models;

//use ici le namespace des classes que tu utilises
use MyApp\Config\DbConnection;

class loginModel
{
	protected $dbh;

	public function __construct()
	{
		$dbh = DbConnection::getInstance();
		$this->dbh = $dbh->getConnection();
	}

	public function existsUser($name, $password)
	{
		$sql  = "SELECT * FROM users WHERE name=:name AND password=:password";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name", $name);
		$stmt->bindParam(":password", $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
		$result = isset($user['name']) ? true : false;
		return $result;
	}

	public function createUser($name, $password, $email)
	{
		$sql  = "INSERT INTO users (name, password, email) VALUES (:name, :password, :email)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
		$stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
	}

	public function retrievePassword($email, $password)
	{
		$sql  = "UPDATE users SET password=:password WHERE email=:email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
	}
}
