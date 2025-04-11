<?php
session_start();
require 'includes/db.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$sql = "SELECT id, nom_proprietaire, numero_voie, nom_voie, code_postal, ville, code_insee FROM compteurs";
$stmt = $pdo->query($sql);
$meters = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <main class="container pt-3">
        <h1 class="text-start text-dark">
            <i class="bi bi-lightning"></i> Gestion des compteurs d'électricité 
            <a href="./compteur_ajout_test.php"><i class="bi bi-plus-circle-fill text-success"></i></a>
        </h1>
        <hr>

        <?php
        $notifs = [
            "successEdit" => [
                "couleur" => "success",
                "text" => "Compteur modifié avec succès."
            ],
            "failEdit" => [
                "couleur" => "danger",
                "text" => "Erreur durant la modification."
            ],
            "successAdd" => [
                "couleur" => "success",
                "text" => "Compteur ajouté avec succès."
            ],
            "failAdd" => [
                "couleur" => "danger",
                "text" => "Erreur durant l'ajout"
            ],
            "successDelete" => [
                "couleur" => "success",
                "text" => "Compteur supprimé avec succès."
            ],
            "failDelete" => [
                "couleur" => "danger",
                "text" => "Erreur durant la suppression"
            ],
        ];
        if (isset($_GET['notif']) && array_key_exists($_GET['notif'], $notifs)) {
        ?>
            <div class="alert alert-<?php echo $notifs[$_GET['notif']]["couleur"]; ?>" role="alert">
                <i class="bi bi-info-circle"></i>&nbsp;<?php echo $notifs[$_GET['notif']]["text"]; ?>
            </div>
        <?php } ?>

        <table class="table table-striped table-bordered mt-3">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nom du Propriétaire</th>
                    <th>Numéro de Voie</th>
                    <th>Nom de Voie</th>
                    <th>Code Postal</th>
                    <th>Ville</th>
                    <th>Code Insee</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($meters as $meter) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($meter['id']); ?></td>
                    <td><?php echo htmlspecialchars($meter['nom_proprietaire']); ?></td>
                    <td><?php echo htmlspecialchars($meter['numero_voie']); ?></td>
                    <td><?php echo htmlspecialchars($meter['nom_voie']); ?></td>
                    <td><?php echo htmlspecialchars($meter['code_postal']); ?></td>
                    <td><?php echo htmlspecialchars(strtoupper($meter['ville'])); ?></td>
                    <td><?php echo htmlspecialchars($meter['code_insee']); ?></td>
                    <td class="text-center">
                        <a href="compteur_modif.php?id=<?php echo $meter['id']; ?>" class="text-info">
                            <i class="bi bi-pencil-fill h4"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="compteur_delete.php?id=<?php echo $meter['id']; ?>" class="text-danger">
                            <i class="bi bi-x-circle-fill h4"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </main>
