<?php 


if (!isset($_SESSION['user'])) {
    $this->redirectToRoute('/login');
}

// Récupérer la date de naissance de l'utilisateur
$userDob = $_SESSION['user']['date_of_birth'];
$birthDate = new \DateTime($userDob);
$today = new \DateTime();
$age = $today->diff($birthDate)->y;

if ($age < 18) {
    $_SESSION['error'] = "Vous devez avoir au moins 18 ans pour effectuer un achat.";
    $this->redirectToRoute('/');
}
