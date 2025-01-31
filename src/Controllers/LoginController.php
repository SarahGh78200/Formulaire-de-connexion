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

                // Créer un utilisateur avec l'email et mot de passe fournis
                $user = new User(null, null, null, $password, null, null,$email);
                // Chercher l'utilisateur dans la base de données
                $responseGetUser = $user->login($email);

                if ($responseGetUser) {
                    $passwordUser = $responseGetUser->getPassword();

                    // Vérifier si le mot de passe est correct
                    if (password_verify($password, $passwordUser)) {
                          $_SESSION['user'] = [
                            'id' => $responseGetUser->getId(),  // Utiliser le getter approprié
                            
                            'surname' => $responseGetUser->getSurname(),
                            'name' => $responseGetUser->getSurname(),
                            'idUser' => $responseGetUser->getId(),
                            'idRole' => $responseGetUser->getId_Role(),  // Utiliser le getter approprié pour id_role
                            'email' => $responseGetUser->getEmail(),
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

        // Si l'utilisateur est déjà connecté, rediriger
        if (isset($_SESSION['user'])) {
            $this->redirectToRoute('/');
        }

        // Afficher la vue de login
        require_once(__DIR__ . "/../Views/security/login.view.php");
    }
}
