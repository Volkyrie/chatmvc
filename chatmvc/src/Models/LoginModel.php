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
		$sql  = "SELECT * FROM users WHERE user_name=:name";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_OBJ);
		$result = (!empty($user) && password_verify($password, $user->password)) ? true : false;
		return $result;
	}

	public function createUser($name, $password, $email)
	{
		$sql  = "INSERT INTO users (user_name, password, email) VALUES (:name, :password, :email)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':name', $name);
		$stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
	}

	public function retrievePassword($email, $password)
	{
		$sql  = "UPDATE users SET password=:password WHERE email=:email";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(":password", $password, \PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, \PDO::PARAM_STR);
        $stmt->execute();
	}
}
