<?php
require_once(__DIR__ . '/partials/head.php');
?>

<?php if (isset($_SESSION['user'])): ?>
    <?php
    $birthDate = new \DateTime($_SESSION['user']['date_of_birth']);
    $today = new \DateTime();
    $age = $today->diff($birthDate)->y;
    ?>
    <?php if ($age < 18): ?>
        <div class="alert alert-warning">
            ⚠️ Vous êtes mineur. Vous pouvez consulter le site, mais vous ne pouvez pas acheter ni vous inscrire.
        </div>
    <?php endif; ?>
<?php endif; ?>

<h1>Licence'N'Kids</h1>

<?php
if (isset($_SESSION['user']) && $_SESSION['user']['idRole'] == 1) {
?>
    <h2>Licences disponibles</h2>
    <?php
    if (isset($arrayLicences)) {
        foreach ($arrayLicences as $licence) {
            $dateStartDay = date_create($licence->getStartLicence());
            $dateStopDay = date_create($licence->getStopLicence());
    ?>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $licence->getTitle() ?></h5>
                    <p class="card-text"><?= $licence->getDescription() ?></p>
                    <p class="card-text">Du <?= date_format($dateStartDay, 'd-m-Y à H:i') ?> au <?= date_format($dateStopDay, 'd-m-Y à H:i') ?></p>
                    <p class="card-text">Prix : <?= $licence->getPrice() ?> €</p>
                    <a href="/licence?id=<?= $licence->getId() ?>" class="btn btn-success">Voir plus</a>
                    <a href="/editLicence?id=<?= $licence->getId() ?>" class="btn btn-warning">Modifier</a>
                    <a href="/assignLicence?id=<?= $licence->getId() ?>" class="btn btn-info m-1">Assigner licence</a>
                    <?php if ($_SESSION['user']['id'] == $licence->getIdUser()) { ?>
                        <!-- Si l'utilisateur est le propriétaire de la licence -->
                        <form action="/deleteLicence" method="POST">
                            <input type="hidden" name="id" id="id" value="<?= $licence->getId() ?>">
                            <button type="submit" class="btn btn-danger m-1">Supprimer ma licence</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
    <?php
        }
    }
    ?>
    <h2>Licences assignées</h2>
    <?php
    if (isset($arrayLicencesByUsers)) {
        foreach ($arrayLicencesByUsers as $licence) {
            $dateStartDay = date_create($licence->getStartLicence());
            $dateStopDay = date_create($licence->getStopLicence());
    ?>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $licence->getTitle() ?></h5>
                    <p class="card-text"><?= $licence->getDescription() ?></p>
                    <p class="card-text">Du <?= date_format($dateStartDay, 'd-m-Y à H:i') ?> au <?= date_format($dateStopDay, 'd-m-Y à H:i') ?></p>
                    <p class="card-text">Assignée à : <?= $licence->getPseudo() ?></p>
                    <a href="/licence?id=<?= $licence->getId() ?>" class="btn btn-success">Voir plus</a>
                    <a href="/editLicence?id=<?= $licence->getId() ?>" class="btn btn-warning">Modifier</a>
                    <a href="/updateAssignLicence?id=<?= $licence->getId() ?>" class="btn btn-info m-1">Modifier status / assignation</a>
                    <?php if ($_SESSION['user']['id'] == $licence->getIdUser()) { ?>
                        <!-- Si l'utilisateur est le propriétaire de la licence -->
                        <form action="/deleteLicence" method="POST">
                            <input type="hidden" name="id" id="id" value="<?= $licence->getId() ?>">
                            <button type="submit" class="btn btn-danger m-1">Supprimer ma licence</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
    <?php
        }
    }
}

if (isset($_SESSION['user']) && $_SESSION['user']['idRole'] == 2) {
    ?>
    <h2>Licences disponibles</h2>
    <?php
    if (isset($arrayLicences)) {
        foreach ($arrayLicences as $licence) {
            $dateStartDay = date_create($licence->getStartLicence());
            $dateStopDay = date_create($licence->getStopLicence());
    ?>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $licence->getTitle() ?></h5>
                    <p class="card-text"><?= $licence->getDescription() ?></p>
                    <p class="card-text">Du <?= date_format($dateStartDay, 'd-m-Y à H:i') ?> au <?= date_format($dateStopDay, 'd-m-Y à H:i') ?></p>
                    <p class="card-text">Prix : <?= $licence->getPrice() ?> €</p>
                    <a href="/licence?id=<?= $licence->getId() ?>" class="btn btn-success">Voir plus</a>
                    <!-- Admin peut voir et modifier toutes les licences -->
                    <a href="/editLicence?id=<?= $licence->getId() ?>" class="btn btn-warning">Modifier</a>
                    <form action="/deleteLicence" method="POST">
                        <input type="hidden" name="id" id="id" value="<?= $licence->getId() ?>">
                        <button type="submit" class="btn btn-danger m-1">Supprimer la licence</button>
                    </form>
                </div>
            </div>
    <?php
        }
    }
}

require_once(__DIR__ . '/partials/footer.php');
?>
