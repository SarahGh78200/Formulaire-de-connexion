<?php
require_once(__DIR__ . "/../partials/head.php");
?>
<h1>Inscription</h1>
<form method='POST'>
    <div>
        <label for="name">Nom</label>
        <input type="text" name='name'>
        <?php if (isset($this->arrayError['name'])) { ?>
            <p class='text-danger'><?= $this->arrayError['name'] ?></p>
        <?php } ?>
    </div>
    <div>
        <label for="prenom">Prénom</label>
        <input type="text" name='prenom'>
        <?php if (isset($this->arrayError['prenom'])) { ?>
            <p class='text-danger'><?= $this->arrayError['prenom'] ?></p>
        <?php } ?>
    </div>
    <div>
        <label for="mail">Email</label>
        <input type="email" name='mail'>
        <?php if (isset($this->arrayError['mail'])) { ?>
            <p class='text-danger'><?= $this->arrayError['mail'] ?></p>
        <?php } ?>
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name='password'>
        <?php if (isset($this->arrayError['password'])) { ?>
            <p class='text-danger'><?= $this->arrayError['password'] ?></p>
        <?php } ?>
    </div>
    <div>
        <label for="date_naissance">Date de naissance</label>
        <input type="date" name='date_naissance'>
        <?php if (isset($this->arrayError['date_naissance'])) { ?>
            <p class='text-danger'><?= $this->arrayError['date_naissance'] ?></p>
        <?php } ?>
    </div>
    <div>
        <label for="idRole">Role</label>
        <select class="form-select" aria-label="idRole" name="idRole">
            <option value="1">Admin</option> 
            <option value="2">Client</option> 
        </select>
    </div>
    <?php if (isset($this->arrayError['idRole'])) { ?>
        <p class='text-danger'><?= $this->arrayError['idRole'] ?></p>
    <?php } ?>
    </div>
    <button type="submit">Inscription</button>
</form>
<?php
require_once(__DIR__ . "/../partials/footer.php");
?>