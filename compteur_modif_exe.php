<?php
require './ad_estconnect_exe.php'; // Vérification de la connexion utilisateur
include './includes/db.php'; // Connexion à la base de données

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    if (!empty($_POST["nomProprietaire"]) && !empty($_POST["numeroVoie"]) && !empty($_POST["nomVoie"]) && is_numeric($_POST["codePostal"]) && !empty($_POST["ville"]) && !empty($_POST["codeInsee"])) {
        
        $sql = "UPDATE compteurs 
                SET nom_proprietaire = :nomProprietaire, 
                    numero_voie = :numeroVoie, 
                    nom_voie = :nomVoie, 
                    code_postal = :codePostal, 
                    ville = :ville, 
                    code_insee = :codeInsee 
                WHERE id = :id";
        $request = $pdo->prepare($sql);

        // Liaison des paramètres
        $request->execute([
            ':nomProprietaire' => $_POST['nomProprietaire'],
            ':numeroVoie' => $_POST['numeroVoie'],
            ':nomVoie' => $_POST['nomVoie'],
            ':codePostal' => $_POST['codePostal'],
            ':ville' => $_POST['ville'],
            ':codeInsee' => $_POST['codeInsee'],
            ':id' => $id
        ]);

        // Redirection en cas de succès
        header('Location: compteur_main.php?notif=successEdit');
        exit();
    } else {
        // Redirection en cas d'erreur
        header("Location: compteur_modif.php?id=$id&notif=failEdit");
        exit();
    }
} else {
    // Redirection si l'ID est invalide
    header('Location: compteur_main.php?notif=failEdit');
    exit();
}
?>