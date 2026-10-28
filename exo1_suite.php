<?php
// À COLLER dans exo1_bases.php, après l'exercice 1.1
// (le fichier doit commencer par <?php et contenir require 'config.php';)

/* ================= Exercice 1.2 : Constantes ================= */
require 'config.php';

echo "<h2>Exercice 1.2</h2>";
echo "ETABLISSEMENT = " . ETABLISSEMENT . "<br>";
echo "NOTE_MIN = " . NOTE_MIN . "<br>";
echo "NOTE_MAX = " . NOTE_MAX . "<br>";
echo "SEUIL = " . SEUIL . "<br>";

echo "defined('SEUIL') : ";
var_dump(defined('SEUIL'));      // bool(true)
echo "<br>defined('INCONNUE') : ";
var_dump(defined('INCONNUE'));   // bool(false)
echo "<br>";

/* Réponses en commentaire :
 * - Afficher une constante non définie : en PHP 8, cela lève une erreur
 *   fatale (Error : Undefined constant "INCONNUE") et le script s'arrête.
 *   (En PHP 7, c'était seulement un warning et PHP affichait "INCONNUE".)
 * - const vs define() :
 *   const est résolue à la compilation, doit être écrite au niveau global
 *   (pas dans un if, une boucle ou une fonction), nom fixe ; elle sert aussi
 *   à déclarer les constantes de classe.
 *   define() est exécutée à l'exécution, peut être appelée dans un if ou une
 *   fonction, et le nom peut être dynamique (une chaîne calculée).
 */

/* ================= Exercice 1.3 : Calcul ================= */
echo "<h2>Exercice 1.3</h2>";
$prix_ht = 60;
$tva = 20;
$prix_ttc = $prix_ht * (1 + $tva / 100);
echo "Le prix TTC du produit est de $prix_ttc €.<br>";

/* ================= Exercice 1.4 : Types et conversions ================= */
echo "<h2>Exercice 1.4</h2>";

// 1. Cast en string
$test = 42;
$test = (string) $test;
var_dump($test);                 // string(2) "42"
echo "<br>";

// 2. Conversion en booléen
// Prédictions : 0 => false, 0.0 => false, "0" => false, "" => false,
//               "abc" => true, [] => false, null => false
var_dump((bool) 0);              // false
var_dump((bool) 0.0);            // false
var_dump((bool) "0");            // false
var_dump((bool) "");             // false
var_dump((bool) "abc");          // true
var_dump((bool) []);             // false
var_dump((bool) null);           // false
echo "<br>";

// 3. Conversions numériques
// Prédictions : 3, 12, 1500.0, 1
var_dump((int) 3.9);             // int(3)  : on tronque, on n'arrondit pas
var_dump((int) "12abc");         // int(12) : lit les chiffres du début
var_dump((float) "1.5e3");       // float(1500)
var_dump((int) true);            // int(1)
echo "<br>";

// 4. Le nombre 255 dans 4 notations
$dec = 255;
$hex = 0xFF;
$oct = 0377;
$bin = 0b11111111;
echo "Décimal : $dec<br>";
echo "Hexadécimal : $hex (0xFF)<br>";
echo "Octal : $oct (0377)<br>";
echo "Binaire : $bin (0b11111111)<br>";
// Pour afficher l'écriture dans chaque base :
echo dechex(255) . " | " . decoct(255) . " | " . decbin(255) . "<br>"; // ff | 377 | 11111111

/* ================= Exercice 1.5 : Chaînes de caractères ================= */
echo "<h2>Exercice 1.5</h2>";
$traitees = "égales à";
$ici = 2;

// 1.
echo 'Ahmed a dit : "J\'ai réussi"' . "<br>";
// 2.
echo 'Voulez-vous supprimer C:\*.*?' . "<br>";
// 3. (guillemets simples : \n n'est pas interprété)
echo 'Ceci n\'affichera pas \n de nouvelle ligne (le \n doit apparaître tel quel)' . "<br>";
// 4. (guillemets simples : variables non interprétées)
echo 'Les variables ne seront pas $traitees $ici (variables non interprétées)' . "<br>";
// 5. (guillemets doubles : variables interprétées)
echo "Les variables seront $traitees $ici (variables interprétées)" . "<br>";

// Retirer les * avec trim()
$texte = trim("*Bonjour les développeurs*", "*");
echo $texte . "<br>";            // Bonjour les développeurs

// Chaque lettre sur une ligne, avec strlen() et for
// (mb_strlen / mb_substr pour gérer correctement le "é" en UTF-8)
$n = mb_strlen($texte);
for ($i = 0; $i < $n; $i++) {
    echo mb_substr($texte, $i, 1) . "<br>";
}
// Version avec strlen() seul : le "é" fait 2 octets et s'afficherait mal
// for ($i = 0; $i < strlen($texte); $i++) { echo $texte[$i] . "<br>"; }
