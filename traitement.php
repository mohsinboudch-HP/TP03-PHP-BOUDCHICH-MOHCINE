<?php
/*
 * Auteur   : BOUDCHICH Mohcine
 * Objectif : Exercices 4.3 et 5.1 : traitement du formulaire POST et ecriture dans data/notes.csv
 * Date     : 28/10/2026
 */
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $erreurs[] = "Aucune donnée reçue : utilisez le formulaire de saisie.";
} elseif (!isset($_POST['nom'], $_POST['note_info'], $_POST['note_math'])) {
    $erreurs[] = "Des champs sont manquants.";
} else {
    $nom  = trim($_POST['nom']);
    $info = trim($_POST['note_info']);
    $math = trim($_POST['note_math']);

    // On teste === '' et non empty() : empty("0") vaut true, alors que 0 est une note valide.
    if ($nom === '' || $info === '' || $math === '') {
        $erreurs[] = "Tous les champs sont obligatoires.";
    } elseif (!is_numeric($info) || !is_numeric($math)) {
        $erreurs[] = "Les notes doivent être des nombres.";
    } elseif ($info < NOTE_MIN || $info > NOTE_MAX || $math < NOTE_MIN || $math > NOTE_MAX) {
        $erreurs[] = "Les notes doivent être comprises entre " . NOTE_MIN . " et " . NOTE_MAX . ".";
    }
}

if (!empty($erreurs)) {
    foreach ($erreurs as $e) {
        echo "<p style='color:red'>" . htmlspecialchars($e) . "</p>";
    }
    echo "<p><a href='saisie.html'>Retour au formulaire</a></p>";
} else {
    // 5.1 Ajout d'une ligne dans data/notes.csv
    $dossier = __DIR__ . '/data';
    if (!is_dir($dossier)) {
        mkdir($dossier);
    }
    $fichier = fopen($dossier . '/notes.csv', 'a');       // "a" : ajout à la fin
    if ($fichier === false) {
        echo "<p style='color:red'>Impossible d'ouvrir le fichier de notes.</p>";
    } else {
        fputcsv($fichier, [$nom, $info, $math], ';', '"', '\\');
        fclose($fichier);

        echo "<h2>Récapitulatif</h2>";
        echo "<ul>";
        echo "<li>Nom : " . htmlspecialchars($nom) . "</li>";
        echo "<li>Note Info : " . htmlspecialchars($info) . "</li>";
        echo "<li>Note Math : " . htmlspecialchars($math) . "</li>";
        echo "</ul>";
        echo "<p>Données enregistrées. <a href='saisie.html'>Saisir un autre apprenant</a> | <a href='liste.php'>Voir la liste</a></p>";
    }
}

/* Questions :
 * - Pourquoi préférer POST à GET pour un mot de passe ?
 *   Avec GET, les données apparaissent dans l'URL : elles sont visibles à l'écran,
 *   gardées dans l'historique du navigateur et dans les journaux du serveur.
 *   Avec POST, elles sont dans le corps de la requête (pas dans l'URL).
 * - Que contient $_REQUEST ?
 *   Un tableau qui regroupe le contenu de $_GET, $_POST et $_COOKIE
 *   (selon la configuration request_order de php.ini).
 * - Que se passerait-il avec le mode "w" au lieu de "a" ?
 *   "w" vide (écrase) le fichier à chaque ouverture : seul le dernier apprenant
 *   saisi resterait dans notes.csv. "a" ajoute à la fin sans effacer.
 */

include 'includes/pied_inc.php';
