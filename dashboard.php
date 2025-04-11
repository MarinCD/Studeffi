<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

echo "<h1>Bienvenue sur le tableau de bord</h1>";
echo "<a href='compteur/read.php'>Gérer les compteurs d'électricité</a>";
echo "<br><a href='logout.php'>Se déconnecter</a>";
?>