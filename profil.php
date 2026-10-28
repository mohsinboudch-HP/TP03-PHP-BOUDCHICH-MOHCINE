<?php
/*
 * Auteur   : BOUDCHICH Mohcine
 * Objectif : Exercice 6.1 : page de profil protegee par la session
 * Date     : 28/10/2026
 */
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
</head>
<body>
<h1>Bienvenue, <?= htmlspecialchars($_SESSION['login']) ?> !</h1>
<p><a href="deconnexion.php">Se déconnecter</a></p>
</body>
</html>
