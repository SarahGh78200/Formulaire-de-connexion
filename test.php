<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\User;

class RegisterController extends AbstractController
{
    public function index()
{
    if (isset($_POST['surname'], $_POST['name'], $_POST['birth_date'], $_POST['password'], $_POST['register_date'], $_POST['idRole'], $_POST['email'])) {
        $this->check('surname', $_POST['surname']);
        $this->check('name', $_POST['name']);
        $this->check('birth_date', $_POST['birth_date']);
        $this->check('password', $_POST['password']);
        $this->check('register_date', $_POST['register_date']);
        $this->check('Id_Role', $_POST['Id_Role']);
        $this->check('email', $_POST['email']);

        if (empty($this->arrayError)) {
            $name = htmlspecialchars($_POST['name']);
            $surname = htmlspecialchars($_POST['surname']);
            $birth_date = htmlspecialchars($_POST['birth_date']);
            $password = htmlspecialchars($_POST['password']);
            $register_date = htmlspecialchars($_POST['register_date']);
            $id_role = htmlspecialchars($_POST['Id_Role']);
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            if (empty($this->arrayError)) {
                // Créer un nouvel utilisateur avec les données fournies
                $user = new User(null, $surname, $name, $birth_date, $passwordHash, $id_role, $email);
                
                // Enregistrer l'utilisateur dans la base de données
                if ($user->save()) {
                    // Rediriger vers la page d'accueil après l'enregistrement
                    $this->redirectToRoute('/');
                } else {
                    // Gérer l'erreur si l'enregistrement échoue
                    $error = "Erreur lors de l'enregistrement de l'utilisateur.";
                }
            }
    }
    require_once(__DIR__ . "/../Views/security/register.view.php");
}
} 
}