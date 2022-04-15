<!DOCTYPE HTML>
<html>
	<head>
		<title>Inscription</title>
        <?php include "includes/head.php"; ?>
	</head>	
	<body>
    <?php
    include "includes/autoload.php";
    include "includes/nav.php";

    if (isset($_POST['submit'])){
    
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $tel = htmlspecialchars($_POST['tel']);
        $mail = htmlspecialchars($_POST['mail']);
        $adress = htmlspecialchars($_POST['adress']);
        if ($_POST['mdp1'] == $_POST['mdp2']) {
            $mdp = sha1($_POST['mdp1']);
            $manager = new ClientManager($bdd);
			$mesError = $manager->inscription(
                new Client([
                    "Nom" => "$nom",
                    "Prenom" => "$prenom",
                    "Pseudo" => "$pseudo",
				    "Mail" => "$mail",
                    "Telephone" => "$tel",
                    "Adresse" => "$adress",
				    "Mdp" => "$mdp"
			    ])
            );

        } else {
            $mesError = "Les deux mots de passe ne sont pas identique.";
        }
    }

    ?>
        <div class="box-perso">
            <div class="text-center">
                <form method="post">
                    <h1 class="pb-4">Inscription</h1>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prenom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                    </div>
                    <div class="mb-3">
                        <label for="mail" class="form-label">Adresse Email</label>
                        <input type="email" class="form-control" id="mail" name="mail" required>
                    </div>
                    <div class="mb-3">
                        <label for="tel" class="form-label">Telephone</label>
                        <input type="tel" class="form-control" id="tel" name="tel" required>
                    </div>
                    <div class="mb-3">
                        <label for="adress" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adress" name="adress" required>
                    </div>
                    <div class="mb-3">
                        <label for="mdp1" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="mdp1" name="mdp1" required>
                    </div>
                    <div class="mb-3">
                        <label for="mdp2" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="mdp2" name="mdp2" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Se connecter</button>
                </form>
                <hr/>
                <?php if (isset($mesError)) echo $mesError.'<hr/>'; ?>
                <a href="connexion.php">Vous avez déjà un compte, connectez-vous !</a>
            </div>
        </div>


        <?php require_once "includes/footer.php"; ?>
	</body>
</html>