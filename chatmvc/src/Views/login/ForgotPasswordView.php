<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
	<title>Messagerie instantanee</title>
	<!-- BOOTSTRAP CORE STYLE  -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!-- CUSTOM STYLE  -->
	<link href="../public/css/style.css" rel="stylesheet" />
</head>

<body>
	<div class="container">
		<div class="row pad-botm">
			<h4 class="header-line">Recuperation de mot de passe</h4>
		</div>

		<!--LOGIN PANEL START-->
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12 offset-md-3">

				<form role="form" method="post" action="forgotpassword">
					<!-- TODO -->
                    <div class="form-group">
                        <label>Entrez votre Email</label>
                        <input class="form-control" type="text" name="email" required/>
                    </div>

                    <div class="form-group">
                        <label>Nouveau mot de passe</label>
                        <input id="password" class="form-control" type="password" name="newpassword" required/>
                    </div>

                    <div class="form-group">
                        <label>Confirmez le mot de passe</label>
                        <input id="confirmedPassword" class="form-control" type="password" name="newpassword-check" required/>
                    </div>
					<p id="msg" class="d-none text-danger">Les mdp ne correspondent pas</p>

                    <button id="validBtn" type="submit" name="signup" class="btn btn-info"> ENVOYER </button>&nbsp;&nbsp; | &nbsp;<a href="/chatmvc/chatmvc/">Login</a>
				</form>
			</div>

		</div>
		<!---LOGIN PABNEL END-->
	</div>
	<script>
		// Fonction de validation sans param�tre qui renvoie 
		// TRUE si les mots de passe saisis dans le formulaire sont identiques
		// FALSE sinon
		function valid() {
			//TODO
		}
	</script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../public/js/login.js"></script>

</html>