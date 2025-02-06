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
            <?php if (isset($this->arrayError['email'])) { ?>
                <p class='text-danger'><?= $this->arrayError['email'] ?></p>
            <?php } ?>
        </div>
        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" name="password">
            <?php if (isset($this->arrayError['password'])) { ?>
                <p class="text-danger"><?= $this->arrayError['password'] ?></p>
            <?php } ?>
        </div>
        <button class="boutons" type="submit">Connexion</button>
    </form>
</div>
<?php
if (isset($error)) {
    echo "<p class='text-danger'>" . $error . "</p>";
}
require_once(__DIR__ .  "/../partials/footer.php");
?>