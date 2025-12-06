<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Helpers\Auth;
use App\Services\LedenServices;


class LedenController
{

    private LedenServices $service;
    public function __construct(?LedenServices $ledenService = null)
    {
        $this->service = $ledenService ?? new LedenServices();
    }

    public function index()
    {
    }

    public function GetLeden()
    {
        // $leden = $this->service->getAll();

        $filter = [
            'name' => $_POST['name'] ?? '',
            'adress' => $_POST['adress'] ?? '',
            'role' => isset($_POST['role']) ? (array) $_POST['role'] : [],
            'phone' => $_POST['phone'] ?? '',
            'trashed' => $_POST['trashed'] ?? 0,
        ];

        $draw = intval($_POST['draw'] ?? 1);
        $start = intval($_POST['start'] ?? 0);
        $length = intval($_POST['length'] ?? 10);

        $result = $this->service->getLedenForDataTable($filter, $start, $length, $draw);

        header('Content-Type: application/json');
        echo json_encode($result);
        return;
    }

    public function loginView()
    {
        return \View::View("leden.login");
    }

    public function login()
    {
        if (!isset($_POST["email"]) && !isset($_POST["password"]))
            return \View::Redirect("/login");
        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $this->service->getByEmail($email);
        if (!$user) {
            return false;
        }

        //TODO: implement hasing
        if ($password != $user->password) {
            return false;
        }

        \Auth::login($user->email, $user->id);
        \View::Redirect("/");
    }
}