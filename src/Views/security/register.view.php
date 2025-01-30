<?php
require_once(__DIR__ . "/../partials/head.php");
?>
<h1>Inscription</h1>
<form method='POST'>
    <div>
        <label for="surname">Nom</label>
        <input type="text" name='surname'>
        <?php if (isset($this->arrayError['surname'])) { 
            ?>
            <p class='text-danger'><?= $this->arrayError['surname'] ?></p>
        <?php } ?>
    </div>
    <div>
        <label for="name">Prénom</label>
        <input type="text" name='name'>
        <?php if (isset($this->arrayError['name'])) { ?>
            <p class='text-danger'><?= $this->arrayError['name'] ?></p>
        <?php } ?>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name='email'>
        <?php if (isset($this->arrayError['email'])) { ?>
            <p class='text-danger'><?= $this->arrayError['email'] ?></p>
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
        <label for="birth_date">Date de naissance</label>
        <input type="birth_date" date='birth_date'>
        <?php if (isset($this->arrayError['birth_date'])) { ?>
            <p class='text-danger'><?= $this->arrayError['birth_date'] ?></p>
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