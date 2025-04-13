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
        &nbsp;Gestion des compteurs - Modification de <?php echo htmlspecialchars($compteur['nom_proprietaire']); ?>
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
                <input name="codePostal" id="codePostal" type="text" class="form-control" value="<?php echo htmlspecialchars($compteur['code_postal']); ?>" oninput="fetchVilleEtCodeInsee()" required pattern="\d{5}" title="Code postal à 5 chiffres">
            </div>
            <div class="col-9">
                <label for="ville">Ville</label>
                <select name="ville" id="ville" class="form-control" required>
                    <option value="<?php echo htmlspecialchars($compteur['ville']); ?>"><?php echo htmlspecialchars($compteur['ville']); ?></option>
                </select>
            </div>
        </div>
        <!-- Champ masqué pour le Code INSEE -->
        <input type="hidden" name="codeInsee" id="codeInsee" value="<?php echo htmlspecialchars($compteur['code_insee']); ?>">

        <div class="row mt-3">
            <div class="col-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-pencil-square"></i>&nbsp;Modifier
                </button>
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