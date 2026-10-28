<?php
/*
 * Auteur   : BOUDCHICH Mohcine
 * Objectif : Exercice 5.4 : export des resultats en JSON et comparaison avec serialize()
 * Date     : 28/10/2026
 */
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';

$chemin = __DIR__ . '/data/notes.csv';
$resultats = [];

// 1. Construction du tableau associatif à partir du CSV
if (file_exists($chemin) && ($f = fopen($chemin, 'r')) !== false) {
    while (($ligne = fgetcsv($f, 0, ';', '"', '\\')) !== false) {
        if (count($ligne) < 3) {
            continue;
        }
        [$nom, $info, $math] = $ligne;
        $resultats[] = [
            "nom"     => $nom,
            "info"    => (float) $info,
            "math"    => (float) $math,
            "moyenne" => ($info + $math) / 2
        ];
    }
    fclose($f);
}

if (empty($resultats)) {
    echo "<p style='color:red'>Aucune donnée à exporter : saisissez d'abord des notes.</p>";
    include 'includes/pied_inc.php';
    exit;
}

// 2. Écriture dans data/notes.json
$json = json_encode($resultats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents(__DIR__ . '/data/notes.json', $json);
echo "<p>Fichier data/notes.json créé.</p>";

// 3. Relecture
$contenu = file_get_contents(__DIR__ . '/data/notes.json');
$tableau = json_decode($contenu, true);
echo "<h3>print_r après json_decode</h3><pre>";
print_r($tableau);
echo "</pre>";

// 4. Comparaison serialize() / json_encode()
echo "<h3>serialize()</h3><pre>" . htmlspecialchars(serialize($resultats)) . "</pre>";
echo "<h3>json_encode()</h3><pre>" . htmlspecialchars($json) . "</pre>";

/* Question : quel format est directement exploitable par JavaScript ?
 * Réponse : JSON (JSON.parse() dans le navigateur). serialize() produit un
 * format propre à PHP, lisible seulement avec unserialize().
 */

include 'includes/pied_inc.php';
