<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Licence;

class HomeController extends AbstractController
{
    public function index()
    {
        if (isset($_SESSION['user'])) {

            $licence = new Licence(null, null, null, null, null, null, null, null, null, null, null);
            $arrayTasks = $licence->unassignedFutureTask();

            if ($_SESSION['user']['idRole'] == 1) {
                $arrayTasksByUsers = $licence->assignedFutureTask();
            }
        }
        require_once(__DIR__ . '/../Views/home.view.php');
    }
}
