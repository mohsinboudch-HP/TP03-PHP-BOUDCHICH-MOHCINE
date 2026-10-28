<?php
/*
 * Auteur   : BOUDCHICH Mohcine
 * Objectif : Exercice 4.2 : traitement du formulaire GET
 * Date     : 28/10/2026
 */
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';

$nom    = htmlspecialchars($_GET['nom'] ?? '');
$prenom = htmlspecialchars($_GET['prenom'] ?? '');
$sexe   = $_GET['sexe'] ?? '';

if ($sexe === 'M') {
    $civilite = "Monsieur";
} elseif ($sexe === 'F') {
    $civilite = "Madame";
} else {
    $civilite = "";
}

echo "<p>Bonjour $civilite $prenom $nom</p>";

/* Observation : après l'envoi, l'URL contient les données en clair, par exemple
 * info.php?nom=Ali&prenom=Karim&sexe=M (méthode GET : données visibles dans l'URL).
 */

include 'includes/pied_inc.php';
