<?php
/*
 * Auteur   : BOUDCHICH Mohcine
 * Objectif : Exercices 5.2 et 5.3 : lecture de data/notes.csv (fgetcsv puis fgets/explode)
 * Date     : 28/10/2026
 */
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';

$chemin = __DIR__ . '/data/notes.csv';

if (!file_exists($chemin)) {
    echo "<p style='color:red'>Aucune note enregistrée (fichier introuvable).</p>";
    include 'includes/pied_inc.php';
    exit;
}

$f = fopen($chemin, 'r');
if ($f === false) {
    echo "<p style='color:red'>Erreur : impossible d'ouvrir le fichier.</p>";
    include 'includes/pied_inc.php';
    exit;
}

/* ================= 5.2 Avec fgetcsv() ================= */
echo "<h2>5.2 Lecture avec fgetcsv()</h2>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Nom</th><th>Info</th><th>Math</th><th>Moyenne</th><th>Mention</th></tr>";

$totalMoyennes = 0;
$nbApprenants = 0;

while (($ligne = fgetcsv($f, 0, ';', '"', '\\')) !== false) {
    if (count($ligne) < 3) {
        continue;   // ligne vide
    }
    [$nom, $info, $math] = $ligne;
    $moyenne = ($info + $math) / 2;
    $totalMoyennes += $moyenne;
    $nbApprenants++;

    echo "<tr>";
    echo "<td>" . htmlspecialchars($nom) . "</td>";
    echo "<td>$info</td><td>$math</td>";
    echo "<td>" . number_format($moyenne, 2) . "</td>";
    echo "<td>" . mention($moyenne) . "</td>";
    echo "</tr>";
}
fclose($f);
echo "</table>";

if ($nbApprenants > 0) {
    echo "<p><strong>Moyenne générale de la classe : "
        . number_format($totalMoyennes / $nbApprenants, 2) . "</strong></p>";
} else {
    echo "<p>Aucun apprenant dans le fichier.</p>";
}

/* ================= 5.3 Lecture "bas niveau" ================= */
echo "<h2>5.3 Lecture avec fgets(), feof() et explode()</h2>";
$f = fopen($chemin, 'r');
echo "<ul>";
while (!feof($f)) {
    $ligne = fgets($f);
    if ($ligne === false || trim($ligne) === '') {
        continue;
    }
    $champs = explode(';', trim($ligne));
    echo "<li>" . htmlspecialchars(implode(' | ', $champs)) . "</li>";
}
echo "</ul>";
fclose($f);

/* Comparaison :
 * - fgetcsv() : découpe directement la ligne en tableau, gère les guillemets et
 *   les séparateurs contenus dans un champ (ex. "Ali; Karim"). Plus sûr et plus
 *   court. Inconvénient : moins de contrôle sur la ligne brute.
 * - fgets() + explode() : on lit la ligne brute et on la découpe soi-même ;
 *   plus de contrôle et facile à comprendre, mais il faut gérer le retour à la
 *   ligne (trim), les lignes vides, et explode casse si un champ contient le
 *   séparateur ou des guillemets.
 */

include 'includes/pied_inc.php';
