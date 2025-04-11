<?php
session_start();
include './db.php';
// Redirection vers la page de connexion si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
header('Location: dashboard.php');
?>