<?php
/*
 * Auteur   : BOUDCHICH Mohcine
 * Objectif : Exercice 6.1 : deconnexion (destruction de la session)
 * Date     : 28/10/2026
 */
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit;
