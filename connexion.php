<!DOCTYPE HTML>
<html>
	<head>
		<title>Connexion</title>
        <?php require_once "includes/head.php"; ?>
	</head>	
	<body class="body-bg-grey">
<?php
		require_once "includes/autoload.php";
		require_once "includes/nav.php";

        if(isset($_POST['mail']) && isset($_POST['mdp'])){
            $mail = $_POST['mail'];
            $mdp = sha1($_POST['mdp']);

			$manager = new ClientManager($bdd);
			$connexionOk = $manager->connexion(
                new Client([
				    "Mail" => $mail,
				    "Mdp" => $mdp
			    ])
            );
            if ($connexionOk == false) $mesError = "Adresse e-mail ou mot de passe invalide.";
        }
?>
        <div class="box-perso text-center">
            <form method="post">
                <h1 class="pb-4">Connexion</h1>
                <div class="mb-3">
                    <label for="mail" class="form-label">Adresse Email</label>
                    <input type="email" class="form-control" id="mail" name="mail" required>
                </div>
                <div class="mb-3">
                    <label for="mdp" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="mdp" name="mdp" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Se connecter</button>
            </form>
            <hr/>
            <?php if (isset($mesError)) echo $mesError.'<hr/>'; ?>
            <a href="inscription.php">Vous n'avez pas de compte, inscrivez-vous !</a>
        </div>

        <?php require_once "includes/footer.php"; ?>
	</body>
</html>