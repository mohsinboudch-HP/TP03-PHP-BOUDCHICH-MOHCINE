<?php
/*
 * Auteur   : BOUDCHICH Mohcine
 * Objectif : Exercices 2.1 à 2.3 - structures de contrôle et boucles
 * Date     : 28/10/2026
 */

echo '<meta charset="UTF-8">';
require 'config.php';

/* ================= Exercice 2.1 : if / elseif / else ================= */
echo "<h2>Exercice 2.1 : mention()</h2>";

function mention($note)
{
    if ($note >= 16) {
        return "Très bien";
    } elseif ($note >= 14) {
        return "Bien";
    } elseif ($note >= 12) {
        return "Assez bien";
    } elseif ($note >= SEUIL) {
        return "Passable";
    } else {
        return "Ajourné";
    }
}

foreach ([18, 16, 15, 14, 12, 10, 9.5, 0] as $n) {
    echo "Note $n : " . mention($n) . "<br>";
}

/* ================= Exercice 2.2 : switch ================= */
echo "<h2>Exercice 2.2 : switch</h2>";

$mois = (int) date("m");   // 1 à 12

switch ($mois) {
    case 1:  $nom_mois = "Janvier";   break;
    case 2:  $nom_mois = "Février";   break;
    case 3:  $nom_mois = "Mars";      break;
    case 4:  $nom_mois = "Avril";     break;
    case 5:  $nom_mois = "Mai";       break;
    case 6:  $nom_mois = "Juin";      break;
    case 7:  $nom_mois = "Juillet";   break;
    case 8:  $nom_mois = "Août";      break;
    case 9:  $nom_mois = "Septembre"; break;
    case 10: $nom_mois = "Octobre";   break;
    case 11: $nom_mois = "Novembre";  break;
    case 12: $nom_mois = "Décembre";  break;
    default: $nom_mois = "Mois inconnu";
}
echo "Nous sommes en $nom_mois.<br>";

/* Question : que se passe-t-il si on oublie un break dans un case ?
 * Réponse : PHP continue d'exécuter les instructions du case suivant
 * (effet "cascade" ou fall-through), sans tester sa condition, jusqu'à
 * rencontrer un break ou la fin du switch. Le résultat devient faux :
 * par exemple, sans break dans le case 10, $nom_mois recevrait "Novembre"
 * puis "Décembre" et finirait par valoir "Décembre".
 */

/* ================= Exercice 2.3 : Boucles ================= */
echo "<h2>Exercice 2.3 : boucles</h2>";

// 1. Triangle d'étoiles (deux for imbriquées)
echo "<h3>1. Triangle</h3>";
for ($i = 1; $i <= 6; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}

// 2. while : de 0 à 20 par pas de 2, le 10 en gras
echo "<h3>2. while</h3>";
$i = 0;
while ($i <= 20) {
    if ($i == 10) {
        echo "<strong>$i</strong> ";
    } else {
        echo "$i ";
    }
    $i += 2;
}
echo "<br>";

// 3. for + continue : nombres pairs de 0 à 10
echo "<h3>3. for et continue</h3>";
for ($i = 0; $i <= 10; $i++) {
    if ($i % 2 != 0) {
        continue;          // on saute les nombres impairs
    }
    echo "$i ";
}
echo "<br>";

// 4. while + switch + break 2
echo "<h3>4. break 2</h3>";
$i = 0;
while (++$i) {
    switch ($i) {
        case 5:
            echo "At 5<br>";
            break 1;       // sort uniquement du switch
        case 10:
            echo "At 10; quitting<br>";
            break 2;       // sort du switch ET de la boucle while
        default:
            break;
    }
}

// 5. do-while : même affichage que la question 2
echo "<h3>5. do-while</h3>";
$i = 0;
do {
    if ($i == 10) {
        echo "<strong>$i</strong> ";
    } else {
        echo "$i ";
    }
    $i += 2;
} while ($i <= 20);
echo "<br>";

/* Différence essentielle entre while et do-while :
 * - while teste la condition AVANT chaque tour : le corps peut ne jamais
 *   s'exécuter.
 * - do-while teste la condition APRÈS le corps : le corps s'exécute au moins
 *   une fois, même si la condition est fausse dès le départ.
 */
