<?php
require './ad_estconnect_exe.php';
include 'includes/header.php';
?>
<main class="container pt-3">
    <h1 class="text-start text-dark">
        <i class="bi bi-lightning"></i> Gestion des compteurs - Ajout d'un compteur
    </h1>
    <hr>
    <form action="compteur_ajout_exe.php" method="POST">
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
                <input name="codePostal" id="codePostal" type="text" class="form-control" oninput="fetchVilleEtCodeInsee()" required pattern="\d{5}" title="Code postal à 5 chiffres">
            </div>
            <div class="col-9">
                <label for="ville">Ville</label>
                <select name="ville" id="ville" class="form-control" required>
                    <option value="">Sélectionnez une commune</option>
                </select>
            </div>
        </div>
        <!-- Champ masqué pour le Code INSEE -->
        <input type="hidden" name="codeInsee" id="codeInsee">

        <div class="row mt-3">
            <div class="col-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle"></i>&nbsp;Ajouter</button>
            </div>
        </div>
    </form>
</main>
<script>
    async function fetchVilleEtCodeInsee() {
        const codePostal = document.getElementById("codePostal").value;

        if (codePostal.length === 5) {
            try {
                const response = await fetch(`https://geo.api.gouv.fr/communes?codePostal=${codePostal}`);
                const communes = await response.json();

                const villeSelect = document.getElementById("ville");
                const codeInseeInput = document.getElementById("codeInsee");

                // Réinitialise la liste déroulante
                villeSelect.innerHTML = '<option value="">Sélectionnez une commune</option>';

                if (communes.length > 0) {
                    communes.forEach((commune) => {
                        const option = document.createElement("option");
                        option.value = commune.nom; // Utilise le nom de la commune comme valeur
                        option.textContent = commune.nom; // Affiche le nom de la commune
                        option.dataset.codeInsee = commune.code; // Ajoute un attribut personnalisé pour le Code INSEE
                        villeSelect.appendChild(option);
                    });

                    // Sélectionne automatiquement la première commune
                    villeSelect.selectedIndex = 1; // La première commune après "Sélectionnez une commune"
                    codeInseeInput.value = communes[0].code; // Renseigne le Code INSEE
                } else {
                    villeSelect.innerHTML = '<option value="">Aucune commune trouvée</option>';
                    codeInseeInput.value = "";
                }
            } catch (error) {
                console.error("Erreur lors de la récupération des données de l'API :", error);
                document.getElementById("ville").innerHTML = '<option value="">Erreur API</option>';
                document.getElementById("codeInsee").value = "";
            }
        } else {
            // Réinitialise les champs si le Code Postal est invalide ou vide
            document.getElementById("ville").innerHTML = '<option value="">Sélectionnez une commune</option>';
            document.getElementById("codeInsee").value = "";
        }
    }

    // Écouteur pour mettre à jour le Code INSEE en fonction de la ville sélectionnée
    document.getElementById("ville").addEventListener("change", function() {
        const selectedOption = this.options[this.selectedIndex];
        const codeInseeInput = document.getElementById("codeInsee");

        if (selectedOption.dataset.codeInsee) {
            codeInseeInput.value = selectedOption.dataset.codeInsee; // Met à jour le Code INSEE depuis l'attribut data
        } else {
            codeInseeInput.value = ""; // Réinitialise si aucune commune sélectionnée
        }
    });
</script>