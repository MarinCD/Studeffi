<?php
require './ad_estconnect_exe.php';
include 'includes/db.php';

    // Vérification des champs obligatoires
    if (!empty($_POST["nomProprietaire"]) && !empty($_POST["numeroVoie"]) && !empty($_POST["nomVoie"]) && is_numeric($_POST["codePostal"]) && !empty($_POST["ville"]) && !empty($_POST["codeInsee"])) {
        $sql = "INSERT INTO compteurs (nom_proprietaire, numero_voie, nom_voie, code_postal, ville, code_insee)
                VALUES (:nomProprietaire, :numeroVoie, :nomVoie, :codePostal, :ville, :codeInsee)";
        $request = $pdo->prepare($sql);;
        
        // Liaison des paramètres
        $request->bindParam(':nomProprietaire', $_POST['nomProprietaire']);
        $request->bindParam(':numeroVoie', $_POST['numeroVoie']);
        $request->bindParam(':nomVoie', $_POST['nomVoie']);
        $request->bindParam(':codePostal', $_POST['codePostal']);
        $request->bindParam(':ville', $_POST['ville']);
        $request->bindParam(':codeInsee', $_POST['codeInsee']);

        // Exécution de la requête
        $request->execute();
        // Redirection vers la page principale des compteurs
        header('Location: compteur_main.php?notif=successAdd');
        exit();
    } else {
        // Redirection vers la page d'ajout en cas d'erreur
        header('Location: compteur_main.php?notif=failAdd');
        exit();
    }
?>