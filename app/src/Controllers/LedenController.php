<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Services\LedenServices;


class LedenController extends BaseController implements IController
{

    private LedenServices $service;
    public function __construct(?LedenServices $ledenService = null)
    {
        $this->service = $ledenService ?? new LedenServices();
    }

    public function index() {
        $data = $this->service->getAll();
        return \View::View("leden.index", 'Leden', ['leden' => $data]);
    }
    public function show(array $params) {
        $data = $this->service->get(intval($params['id']));
        return \View::View('leden.post', $data['Title'], $data);
    }
    public function Create() {
        return \View::View('admin.leden.create', 'Lid aanmaken');
    }
    public function store() {
        //TODO: Implement some validation
        $post = $this->service->create($_POST);
        return \View::Redirect("/admin/leden/{$post['id']}");
    }

    public function edit(array $params) {
        $post = $this->service->get(intval($params["id"]));
        return \View::View("admin.leden.edit", 'Wijzig lid', $post);
    }

    public function update() {
        //TODO: Implement some validation
        $post = $this->service->update(intval($_POST['id']), $_POST);
        return \View::Redirect("/admin/leden/{$post['id']}");
    }

    public function delete(array $params) {
        $post = $this->service->delete(intval($params["id"]));
        return \View::Redirect("/admin/leden");
    }

    public function destroy(array $params) {
        $post = $this->service->destroy(intval($params["id"]));
        return \View::Redirect("/admin/leden");
    }

    public function GetLeden()
    {
        $filter = [
            'name' => $_POST['name'] ?? '',
            'adress' => $_POST['adress'] ?? '',
            'role' => isset($_POST['role']) ? (array) $_POST['role'] : [],
            'phone' => $_POST['phone'] ?? '',
            'trashed' => $_POST['trashed'] ?? 0,
        ];

        $draw = intval($_POST['draw'] ?? 1);
        $start = intval($_POST['start'] ?? 0);
        $length = intval($_POST['length'] ?? 25);

        $result = $this->service->datatable($filter, $start, $length, $draw);

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