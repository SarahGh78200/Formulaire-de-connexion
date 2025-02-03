<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\User;

class LoginController extends AbstractController
{
    public function index()
    {
        if (isset($_POST['email'], $_POST['password'])) {
            $this->check('email', $_POST['email']);
            $this->check('password', $_POST['password']);

            if (empty($this->arrayError)) {
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                $user = User::findByEmail($email);

                if ($user) {
                    $passwordUser = $user->getPassword();

                    if (password_verify($password, $passwordUser)) {
                        $_SESSION['user'] = [
                            'id' => $user->getId(),
                            'surname' => $user->getSurname(),
                            'name' => $user->getName(),
                            'idUser' => $user->getId(),
                            'idRole' => $user->getId_Role(),
                            'email' => $user->getEmail(),
                        ];
                        $this->redirectToRoute('/');
                    } else {
                        $error = "Le mail ou mot de passe n'est pas correct";
                    }
                } else {
                    $error = "Le mail ou mot de passe n'est pas correct";
                }
            }
        }

        if (isset($_SESSION['user'])) {
            $this->redirectToRoute('/');
        }

        require_once(__DIR__ . "/../Views/security/login.view.php");
    }
}
