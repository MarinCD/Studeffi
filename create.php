<?php
session_start();
require 'includes/db.php';
include 'includes/header.php';

?>
<main class="container pt-3">
    <h1 class="text-start text-dark">
        <i class="bi bi-lightning"></i> Gestion des compteurs - Ajout d'un compteur
    </h1>
    <hr>
    <form action="ad_compteur_ajout_exe.php" method="POST">
        <div class="row mt-3">
            <div class="col">
                <label for="nomProprietaire">Nom du propriétaire</label>
                <input name="nomProprietaire" id="nomProprietaire" type="text" class="form-control" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3">
                <label for="numeroVoie">Numéro de la voie</label>
                <input name="numeroVoie" id="numeroVoie" type="text" class="form-control" required>
            </div>
            <div class="col-9">
                <label for="nomVoie">Nom de la voie</label>
                <input name="nomVoie" id="nomVoie" type="text" class="form-control" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3">
                <label for="codePostal">Code Postal</label>
                <input name="codePostal" id="codePostal" type="text" class="form-control" required>
            </div>
            <div class="col-9">
                <label for="ville">Ville</label>
                <input name="ville" id="ville" type="text" class="form-control" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <label for="codeInsee">Code INSEE</label>
                <input name="codeInsee" id="codeInsee" type="text" class="form-control" required>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle"></i>&nbsp;Ajouter</button>
            </div>
        </div>
    </form>
</main>