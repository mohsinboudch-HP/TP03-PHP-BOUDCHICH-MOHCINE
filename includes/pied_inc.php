<?php
/*
 * Auteur   : BOUDCHICH Mohcine
 * Objectif : Pied de page : date du jour et jours restants avant la fin du semestre
 * Date     : 28/10/2026
 */
?>
<hr>
<footer>
<?php
echo "Date du jour : " . date("d/m/Y") . "<br>";

// Nombre de jours restants avant la fin du semestre (date choisie : 31/01/2027)
$aujourdhui = new DateTime('today');
$fin = new DateTime('2027-01-31');
$diff = $aujourdhui->diff($fin);
if ($diff->invert) {
    echo "Le semestre est terminé.";
} else {
    echo "Il reste " . $diff->days . " jour(s) avant la fin du semestre (31/01/2027).";
}
?>
</footer>
</body>
</html>
