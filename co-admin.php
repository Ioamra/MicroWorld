<!DOCTYPE HTML>
<html>
	<head>
		<title>Connexion Administrateur</title>
        <?php require_once "includes/head.php"; ?>
	</head>	
	<body>
<?php
		require_once "includes/autoload.php";
		require_once "includes/nav.php";

        if(isset($_POST['pseudo']) && isset($_POST['mdp'])){
            $pseudo = $_POST['pseudo'];
            $mdp = sha1($_POST['mdp']);
            if ($pseudo == "admin" && $mdp == "9cf95dacd226dcf43da376cdb6cbba7035218921") {
                session_start();
                $_SESSION['id'] = 0;
                $_SESSION['admin'] = "admin";
                header("location:index.php");
            }
        }
?>
        <div class="box-perso">
            <div class="text-center">
                <form method="post">
                    <h1 class="pb-4">Connexion administrateur</h1>
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                    </div>
                    <div class="mb-3">
                        <label for="mdp" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="mdp" name="mdp" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </form>
                <hr/>
                <?php if (isset($mesError)) echo $mesError.'<hr/>'; ?>
            </div>
        </div>

        <?php require_once "includes/footer.php"; ?>
	</body>
</html>