<?php
/*
 * Auteur   : BOUDCHICH Mohcine
 * Objectif : Exercice 6.3 : validation d'une date avec checkdate()
 * Date     : 28/10/2026
 */
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';
?>
<h2>Validation d'une date</h2>
<form action="dates.php" method="get">
    Jour : <input type="text" name="jour" size="2">
    Mois : <input type="text" name="mois" size="2">
    Année : <input type="text" name="annee" size="4">
    <input type="submit" value="Vérifier">
</form>
<?php
if (isset($_GET['jour'], $_GET['mois'], $_GET['annee'])) {
    $j = (int) $_GET['jour'];
    $m = (int) $_GET['mois'];
    $a = (int) $_GET['annee'];
    if (checkdate($m, $j, $a)) {
        echo "<p style='color:green'>La date $j/$m/$a est valide.</p>";
    } else {
        echo "<p style='color:red'>La date $j/$m/$a n'est pas valide.</p>";
    }
}
include 'includes/pied_inc.php';
