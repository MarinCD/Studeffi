<?php
require './ad_estconnect_exe.php';
include 'includes/db.php';

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $sql = "DELETE FROM compteurs WHERE id = :id";
    $request = $pdo->prepare($sql);
    $request->execute([':id' => $_GET['id']]);
    header('Location: compteur_main.php?notif=successDelete');
    exit();
} else {
    header('Location: compteur_main.php?notif=failDelete');
    exit();
}
?>