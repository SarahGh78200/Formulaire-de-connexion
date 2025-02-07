<?php
require_once(__DIR__ . "/../partials/head.php"); 
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<div class="myBody2">
<h1>Connexion</h1>

<form class="formulaire1" method='POST'>
    <div>
        <label for="email">Mail :</label>
        <input type="email" name='email'>
        <?php if (!empty($errors['email'])) { ?>
            <p class='text-danger'><?= htmlspecialchars($errors['email']) ?></p>
        <?php } ?>
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password">
        <?php if (!empty($errors['password'])) { ?>
            <p class="text-danger"><?= htmlspecialchars($errors['password']) ?></p>
        <?php } ?>
    </div>
    <button class="boutons" type="submit">Connexion</button>
</form>

<?php 
// Affichage de l'erreur globale si elle existe
if (!empty($errors['global'])) { ?>
    <p class="text-danger"><?= htmlspecialchars($errors['global']) ?></p>
<?php } ?>
</div>

<?php 
require_once(__DIR__ .  "/../partials/footer.php"); 
?>
