<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\User;

class RegisterController extends AbstractController
{
    public function index()
    {

        if (isset($_POST['surname'],$_POST['name'] ,$_POST['email'], $_POST['password'], $_POST['idRole'])) {
            $this->check('surname', $_POST['surname']);
            $this->check('name', $_POST['name']);
            $this->check('mail', $_POST['email']);
            $this->check('password', $_POST['password']);
            $this->check('idRole', $_POST['idRole']);

            if (empty($this->arrayError)) {
                $surname = htmlspecialchars($_POST['surname']);
                $name = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                $id_role = htmlspecialchars($_POST['idRole']);
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $user = new User(null, $surname ,$name, $email, $passwordHash, null, $id_role);
                $user->save();
                $this->redirectToRoute('/');
            }
        }
        require_once(__DIR__ . "/../Views/security/register.view.php");
    }
}
