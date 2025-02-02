<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\User;

class RegisterController extends AbstractController
{
    public function index()
{
    $error = null; // Initialisation de la variable $error

    if (isset($_POST['surname'], $_POST['name'], $_POST['birth_date'], $_POST['password'], $_POST['register_date'], $_POST['idRole'], $_POST['email'])) {
        $this->check('surname', $_POST['surname']);
        $this->check('name', $_POST['name']);
        $this->check('birth_date', $_POST['birth_date']);
        $this->check('password', $_POST['password']);
        $this->check('register_date', $_POST['register_date']);
        $this->check('idRole', $_POST['idRole']);
        $this->check('email', $_POST['email']);
var_dump('tefvfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffst');
        if (empty($this->arrayError)) {
            $name = htmlspecialchars($_POST['name']);
            $surname = htmlspecialchars($_POST['surname']);
            $birth_date = htmlspecialchars($_POST['birth_date']);
            $password = htmlspecialchars($_POST['password']);
            $register_date = htmlspecialchars($_POST['register_date']);
            $id_role = htmlspecialchars($_POST['idRole']);
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            if (User::findByEmail($email)) {
                $error = "Cette adresse e-mail est déjà utilisée.";
            } else {
                $user = new User(null, $name, $surname, $passwordHash, $birth_date, $id_role, $email);
                if ($user->save()) {
                    $this->redirectToRoute('/');
                } else {
                    $error = "Erreur lors de l'enregistrement de l'utilisateur.";
                }
            }
        }
    }

    

    require_once(__DIR__ . "/../Views/security/register.view.php");
}

}
