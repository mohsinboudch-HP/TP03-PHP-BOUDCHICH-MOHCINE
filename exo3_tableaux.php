<?php
/*
 * Auteur   : BOUDCHICH Mohcine
 * Objectif : Exercices 3.1 a 3.5 et 4.1 : tableaux, tris, operateurs, includes
 * Date     : 28/10/2026
 */
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';

/* ================= 3.1 Création ================= */
$notes = [
    "Mohamed" => 16, "Ahmed" => 14, "Hind" => 13, "Aicha" => 15,
    "Samir" => 13, "Zakaria" => 13, "Rafik" => 10, "Ilham" => 9,
    "Hamza" => 7, "Sami" => 7, "Noura" => 14
];
$modules = ["Programmation Web", "Algorithmique", "Base de données"];

echo "<h2>3.1 Création</h2>";
echo "<h3>Modules avec foreach</h3>";
foreach ($modules as $m) {
    echo $m . "<br>";
}
echo "<h3>Modules par indice</h3>";
for ($i = 0; $i < count($modules); $i++) {
    echo "Module $i : " . $modules[$i] . "<br>";
}

/* ================= 3.2 Affichage HTML ================= */
echo "<h2>3.2 Tableau HTML</h2>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Nom</th><th>Note</th><th>Mention</th></tr>";
foreach ($notes as $nom => $note) {
    $style = ($note < SEUIL) ? " style='color:red'" : "";
    echo "<tr$style><td>$nom</td><td>$note</td><td>" . mention($note) . "</td></tr>";
}
echo "</table>";

/* ================= 3.3 Statistiques ================= */
echo "<h2>3.3 Statistiques</h2>";

// 1. Sans array_sum()
$somme = 0;
$meilleure = null;
$faible = null;
$nb = 0;
foreach ($notes as $n) {
    $somme += $n;
    $nb++;
    if ($meilleure === null || $n > $meilleure) {
        $meilleure = $n;
    }
    if ($faible === null || $n < $faible) {
        $faible = $n;
    }
}
$moyenne = $somme / $nb;
echo "Somme = $somme<br>";
echo "Moyenne = " . number_format($moyenne, 2) . "<br>";
echo "Meilleure note = $meilleure<br>";
echo "Plus faible note = $faible<br>";

// 2. Vérification avec les fonctions PHP
echo "<h3>Vérification</h3>";
echo "array_sum = " . array_sum($notes) . "<br>";
echo "count = " . count($notes) . "<br>";
echo "moyenne = " . number_format(array_sum($notes) / count($notes), 2) . "<br>";
echo "max = " . max($notes) . "<br>";
echo "min = " . min($notes) . "<br>";

// 3. Effectifs par mention
$effectifs = ["Très bien" => 0, "Bien" => 0, "Assez bien" => 0, "Passable" => 0, "Ajourné" => 0];
foreach ($notes as $n) {
    $effectifs[mention($n)]++;
}
echo "<h3>Effectifs par mention</h3>";
foreach ($effectifs as $m => $effectif) {
    echo "$m : $effectif<br>";
}

/* ================= 3.4 Tri ================= */
function afficher($tab)
{
    echo "<ul>";
    foreach ($tab as $cle => $valeur) {
        echo "<li>$cle : $valeur</li>";
    }
    echo "</ul>";
}

echo "<h2>3.4 Tris</h2>";

$t = $notes; ksort($t);
echo "<h3>Noms croissants (ksort)</h3>";
afficher($t);

$t = $notes; arsort($t);
echo "<h3>Notes décroissantes (arsort)</h3>";
afficher($t);

$t = $notes; krsort($t);
echo "<h3>Noms décroissants (krsort)</h3>";
afficher($t);

$t = $notes; asort($t);
echo "<h3>Notes croissantes (asort)</h3>";
afficher($t);

/* Question : quelle fonction de tri pour un tableau indexé comme $modules ?
 * Réponse : sort() (ordre croissant) ou rsort() (ordre décroissant).
 * Elles trient les valeurs et réindexent le tableau (0, 1, 2...), alors que
 * asort/arsort/ksort/krsort conservent l'association clé => valeur.
 */
$m = $modules; sort($m);
echo "<h3>Modules triés (sort)</h3>";
afficher($m);

/* ================= 3.5 Opérateurs de tableaux ================= */
echo "<h2>3.5 Opérateurs de tableaux</h2>";
$a = ["x" => 1, "y" => 2];
$b = ["y" => 2, "x" => 1];

echo "<pre>";
echo '$a + $b : ';  var_dump($a + $b);   // ["x"=>1, "y"=>2]
echo '$a == $b : '; var_dump($a == $b);  // true
echo '$a === $b : '; var_dump($a === $b); // false
echo "</pre>";

/* Explications :
 * - $a + $b (union) : garde les éléments de $a, puis ajoute ceux de $b dont la
 *   clé n'existe pas dans $a. Ici toutes les clés existent déjà : résultat = $a.
 * - $a == $b : true, car les deux tableaux ont les mêmes paires clé/valeur
 *   (l'ordre n'a pas d'importance).
 * - $a === $b : false, car il faut les mêmes paires, dans le même ORDRE et du
 *   même type. Ici l'ordre des clés est différent (x,y contre y,x).
 */

/* ================= 4.1 Expériences (à tester une par une) ================= */
/* Expérience 1 : fichier inexistant
 *   include 'includes/inexistant.php';
 *     -> Warning (avertissement) ; le script CONTINUE de s'exécuter.
 *   require 'includes/inexistant.php';
 *     -> Fatal error (erreur fatale) ; le script S'ARRÊTE immédiatement.
 *
 * Expérience 2 : inclusion double
 *   include 'includes/menu_inc.php';
 *   include 'includes/menu_inc.php';       -> le menu s'affiche DEUX fois.
 *   include_once 'includes/menu_inc.php';
 *   include_once 'includes/menu_inc.php';  -> le menu s'affiche UNE seule fois
 *   (PHP vérifie que le fichier n'a pas déjà été inclus).
 */

include 'includes/pied_inc.php';
