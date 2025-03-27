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
		$this->render(ROOT.'/src/Views/login/LoginView.php');
	}

	public function signup()
	{
		$this->render(ROOT.'/src/Views/login/SignupView.php');
	}

	public function forgotpassword()
	{
		$this->render(ROOT.'/src/Views/login/ForgotPasswordView.php');
	}

	public function render(string $fichier, array $data = []): void {
		require_once($fichier);
	}
}
