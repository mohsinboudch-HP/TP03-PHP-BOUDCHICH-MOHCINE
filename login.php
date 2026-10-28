<?php
/*
 * Auteur   : BOUDCHICH Mohcine
 * Objectif : Exercices 6.1 et 6.2 : connexion avec session et cookie
 * Date     : 28/10/2026
 */
session_start();   // toute première instruction

$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    if ($login === '') {
        $erreur = "Veuillez saisir un login.";
    } else {
        $_SESSION['login'] = $login;

        // 6.2.1 Cookie valable 24 heures
        setcookie("dernier_login", $login, time() + 86400, "/");

        // 6.2.3 Variante : un seul cookie avec login + date (JSON)
        $infos = ["login" => $login, "date" => date("d/m/Y H:i")];
        setcookie("connexion", json_encode($infos), time() + 86400, "/");

        header("Location: profil.php");
        exit;
    }
}

// 6.2.2 Pré-remplissage du champ login
$dernier = $_COOKIE['dernier_login'] ?? '';

// 6.2.3 Relecture du cookie JSON
$derniereConnexion = null;
if (isset($_COOKIE['connexion'])) {
    $derniereConnexion = json_decode($_COOKIE['connexion'], true);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
<h1>Connexion</h1>
<?php if ($erreur !== ""): ?>
    <p style="color:red"><?= htmlspecialchars($erreur) ?></p>
<?php endif; ?>
<?php if (is_array($derniereConnexion)): ?>
    <p>Dernière connexion : <?= htmlspecialchars($derniereConnexion['login'] ?? '') ?>
       le <?= htmlspecialchars($derniereConnexion['date'] ?? '') ?></p>
<?php endif; ?>
<form action="login.php" method="post">
    <p>Login : <input type="text" name="login" value="<?= htmlspecialchars($dernier) ?>"></p>
    <p><input type="submit" value="Se connecter"></p>
</form>
</body>
</html>
<?php
/* Questions :
 * - Où est stockée une session ? Où est stocké un cookie ?
 *   La session est stockée côté SERVEUR (fichiers de session) ; le navigateur ne
 *   garde que l'identifiant PHPSESSID. Le cookie est stocké côté CLIENT, dans le
 *   navigateur.
 * - Pourquoi setcookie() et header() doivent-ils être appelés avant tout affichage ?
 *   Ils envoient des en-têtes HTTP, qui doivent précéder le corps de la page.
 *   Dès qu'un affichage (même un espace ou une ligne vide avant <?php) a été
 *   envoyé, les en-têtes sont déjà partis : erreur "headers already sent".
 */
