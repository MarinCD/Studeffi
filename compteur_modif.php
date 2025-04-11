<?php 
    require './ad_estconnect_exe.php'; // Vérification de la connexion utilisateur
    include './includes/db.php'; // Connexion à la base de données
    include 'includes/header.php';

    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "SELECT * FROM compteurs WHERE id = :id";
        $reponse = $pdo->prepare($sql);
        $reponse->execute([':id' => $id]);
        $compteur = $reponse->fetch();
    }
?>
<main class="container pt-3">
    <h1 class="text-start text-dark">
        <i class="bi bi-pencil-square"></i>&nbsp;Gestion des compteurs - Modification de <?php echo htmlspecialchars($compteur['nom_proprietaire']); ?>
    </h1>
    <hr>

    <?php
        $notifs = [
           
            "failEdit" => [
                "couleur" => "danger",
                "text" => "Erreur durant la modification."
            ],
        ];
        if (isset($_GET['notif']) && array_key_exists($_GET['notif'], $notifs)) {
        ?>
            <div class="alert alert-<?php echo $notifs[$_GET['notif']]["couleur"]; ?>" role="alert">
                <i class="bi bi-info-circle"></i>&nbsp;<?php echo $notifs[$_GET['notif']]["text"]; ?>
            </div>
        <?php } ?>


    <form action="compteur_modif_exe.php?id=<?php echo $id; ?>" method="POST">
        <div class="row mt-3">
            <div class="col">
                <label for="nomProprietaire">Nom du propriétaire</label>
                <input name="nomProprietaire" id="nomProprietaire" type="text" class="form-control" value="<?php echo htmlspecialchars($compteur['nom_proprietaire']); ?>" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3">
                <label for="numeroVoie">Numéro de voie</label>
                <input name="numeroVoie" id="numeroVoie" type="text" class="form-control" value="<?php echo htmlspecialchars($compteur['numero_voie']); ?>" required>
            </div>
            <div class="col-9">
                <label for="nomVoie">Nom de la voie</label>
                <input name="nomVoie" id="nomVoie" type="text" class="form-control" value="<?php echo htmlspecialchars($compteur['nom_voie']); ?>" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3">
                <label for="codePostal">Code Postal</label>
                <input name="codePostal" id="codePostal" type="text" class="form-control" value="<?php echo htmlspecialchars($compteur['code_postal']); ?>" required>
            </div>
            <div class="col-9">
                <label for="ville">Ville</label>
                <input name="ville" id="ville" type="text" class="form-control" value="<?php echo htmlspecialchars($compteur['ville']); ?>" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <label for="codeInsee">Code INSEE</label>
                <input name="codeInsee" id="codeInsee" type="text" class="form-control" value="<?php echo htmlspecialchars($compteur['code_insee']); ?>" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-pencil-square"></i>&nbsp;Modifier
                </button>
            </div>
        </div>
    </form>
</main>