<?php
session_start();
if(empty($_SESSION['id'])){
    header('location:index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>MicroWorld - Profil</title>
	<?php require_once "includes/head.php"; ?>
</head>
	<body class="body-bg-grey">
		<?php
		require_once "includes/autoload.php";
		require_once "includes/nav.php";

        if (isset($_POST['submit'])) {
            $managerClient = new ClientManager($bdd);
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $tel = htmlspecialchars($_POST['tel']);
            $mail = htmlspecialchars($_POST['mail']);
            $adress = htmlspecialchars($_POST['adress']);
            $ancienMdp = sha1($_POST['ancienMdp']);
            $ancienMdpOk = $managerClient->verifMdp(
                new Client([
                    "IdClient" => $_SESSION['id'],
                    "Mdp" => $ancienMdp
                ])
            );
            if ($ancienMdpOk == false) {
                $mesError = "Le mot de passe ne correspond pas.";
            } else {
                if (!empty($_POST['mdp1']) && !empty($_POST['mdp2'])) {
                    if ($_POST['mdp1'] == $_POST['mdp2']) {
                        $mdp = sha1($_POST['mdp1']);
                        $managerClient->update(
                            new Client([
                                "IdClient" => $_SESSION['id'],
                                "Nom" => $nom,
                                "Prenom" => $prenom,
                                "Pseudo" => $pseudo,
                                "Telephone" => $tel,
                                "Mail" => $mail,
                                "Adresse" => $adress,
                                "Mdp" => $mdp
                            ])
                        );
                    } else {
                        $mesError = "Les mots de passe ne sont pas identique.";
                    }
                } else {
                    $managerClient->update(
                        new Client([
                            "IdClient" => $_SESSION['id'],
                            "Nom" => $nom,
                            "Prenom" => $prenom,
                            "Pseudo" => $pseudo,
                            "Telephone" => $tel,
                            "Mail" => $mail,
                            "Adresse" => $adress,
                            "Mdp" => $ancienMdp
                        ])
                    );
                }
            }
        }

		?>
<form class="box-perso" method="post">
    <div class="card p-3 text-black">
        <h2 class="text-center pb-2">Profil</h2>
        <?=@$mesError?>
        <div class="p-4" style="background-color: #f8f9fa;">
            <!-- Tableau des information de l'utilisateur -->
            <table class="table">
                <tbody>
              <tr>
                  <th>Nom :</th>
                  <td><input type="text" class="form-control" name="nom" pattern="[a-zA-Zéè]{3,15}" value="<?=$_SESSION['nom']?>" required></td>
              </tr>
              <tr>
                <th>Prenom :</th>
                <td><input type="text" class="form-control" name="prenom" pattern="[a-zA-Zéè]{3,15}" value="<?=$_SESSION['prenom']?>" required></td>
              </tr>
              <tr>
                  <th>Pseudo :</th>
                  <td><input type="text" class="form-control" name="pseudo" pattern="[a-zA-Zéè]{3,15}" value="<?=$_SESSION['pseudo']?>" required></td>
                </tr>
                <tr>
                    <th>Mail :</th>
                    <td><input type="text" class="form-control" name="mail" pattern="[a-z0-9._%+-éèàùç]+@[a-z0-9.-]+\.[a-z]{2,3}" value="<?=$_SESSION['mail']?>" required></td>
                </tr>
              <tr>
                  <th>Telephone :</th>
                  <td><input type="tel" class="form-control" name="tel" pattern="[0-9]{10}" value="<?=$_SESSION['telephone']?>" required></td>
                </tr>
                <tr>
                    <th>Adresse :</th>
                    <td><input type="text" class="form-control" name="adress" value="<?=$_SESSION['adresse']?>" required></td>
                </tr>
                <tr>
                    <th>Ancient mot de passe :</th>
                    <td><input type="password" class="form-control" name="ancienMdp" required></td>
                </tr>
              <tr>
                  <th>Nouveau mot de passe :</th>
                  <td><input type="password" class="form-control" name="mdp1"></td>
                </tr>
                <tr>
                    <th>Nouveau mot de passe :</th>
                    <td><input type="password" class="form-control" name="mdp2"></td>
                </tr>
            </tbody>
          </table>
          <button type="submit" name="submit" class="btn btn-success">Valider les changement</button>
          <a class="ms-5 text-decoration-none text-dark" href="historique.php">Voir l'historique de mes achats.</a>
        </div>
    </div>
</form>


		<?php require_once "includes/footer.php"; ?>
	</body>
</html>