<?php

namespace MyApp\Controllers;

// use ici le namespace des classes que tu utilises
use MyApp\Models\loginModel;
use MyApp\Config\Conf;

class loginController
{
	protected $oLoginModel;

	public function __construct()
	{
		$this->oLoginModel = new LoginModel();
	}

	/**
	 * Méthode permettant à l'utilisateur de se logger
	 *
	 * @param 
	 * @return void
	 */
	public function loginIndex()
	{
		$colors = ["orange", "red", "blue", "green"];
		$pickedColor = $colors[array_rand($colors)];

		if (isset($_POST['login'])){
			$name = strip_tags($_POST['pseudo']);
			$password = strip_tags($_POST['password']);

			if($this->oLoginModel->existsUser($name, $password)) {
				$_SESSION['user'] = $name;
				$_SESSION['color'] = $pickedColor;
				$url = URL . "/chat/chatIndex";
				header("Location: $url");
			} else {
				echo "<script>alert('Votre mot de passe est incorrect');</script>";
				$this->render(ROOT.'/src/Views/login/LoginView.php');
			}
		} else {
			$this->render(ROOT.'/src/Views/login/LoginView.php');
		}
	}

	public function signup()
	{
		if (isset($_POST['signup'])){
			$name = strip_tags($_POST['pseudo']);
			$email = strip_tags($_POST['email']);
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

			$this->oLoginModel->createUser($name, $password, $email);
			echo "<script>alert('Vous avez été inscrit');</script>";
			$this->render(ROOT.'/src/Views/login/LoginView.php');
		} else {
			$this->render(ROOT.'/src/Views/login/SignupView.php');
		}
	}

	public function forgotpassword()
	{
		$this->render(ROOT.'/src/Views/login/ForgotPasswordView.php');
	}

	public function render(string $fichier, array $data = []): void {
		require_once($fichier);
	}
}
