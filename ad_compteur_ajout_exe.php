<?php
require 'includes/db.php';

    // Vérification des champs obligatoires
    if (!empty($_POST["nomProprietaire"]) && !empty($_POST["numeroVoie"]) && !empty($_POST["nomVoie"]) && is_numeric($_POST["codePostal"]) && !empty($_POST["ville"]) && !empty($_POST["codeInsee"]) && !empty($_POST["refCompteur"]) && !empty($_POST["typeCompteur"])) {
        
        $sql = "INSERT INTO compteurs
            (nom_proprietaire, numero_voie, nom_voie, code_postal, ville, code_insee)
            VALUES
            (:nomProprietaire, :numeroVoie, :nomVoie, :codePostal, :ville, :codeInsee);";
        $request = $pdo->prepare($sql);
        
        // Liaison des paramètres
        $request->bindParam(':nomProprietaire', $_POST['nomProprietaire']);
        $request->bindParam(':numeroVoie', $_POST['numeroVoie']);
        $request->bindParam(':nomVoie', $_POST['nomVoie']);
        $request->bindParam(':codePostal', $_POST['codePostal']);
        $request->bindParam(':ville', $_POST['ville']);
        $request->bindParam(':codeInsee', $_POST['codeInsee']);

        // Exécution de la requête
        $request->execute();
        var_dump($request);
        // Redirection vers la page principale des compteurs
        header('Location: ./index.php?page=compteur_main');
        exit();
    } else {
        // Redirection vers la page d'ajout en cas d'erreur
        //header('Location: ./index.php?page=compteur_ajout');
        exit();
    }
?>