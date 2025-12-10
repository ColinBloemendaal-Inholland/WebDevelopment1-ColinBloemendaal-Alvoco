<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Services\LedenServices;
use App\Requests\LedenStoreRequest;
use App\Requests\LedenUpdateRequest;
use App\Services\RolesServices;
use Rakit\Validation\Validator;

class LedenController extends BaseController implements IController
{

    private RolesServices $rolenServices;
    private LedenServices $service;
    public function __construct(?LedenServices $ledenService = null, ?RolesServices $rolesServices = null)
    {
        $this->service = $ledenService ?? new LedenServices();
        $this->rolenServices = $rolesServices ?? new RolesServices();
    }

    public function index()
    {
        $data = $this->service->getAll();
        return \View::View("leden.index", 'Leden', ['leden' => $data]);
    }
    public function show(array $params)
    {
        $data = $this->service->get(intval($params['id']));
        return \View::View('leden.post', $data['Title'], $data);
    }
    public function Create()
    {
        $data = $this->rolenServices->getAll();
        return \View::View('admin.leden.create', 'Lid aanmaken', ['rolen'=> $data]);
    }
    public function store()
    {
        try {
            $validated = new LedenStoreRequest($_POST)->validate();
            $post = $this->service->create($validated);
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            return \View::Redirect("/admin/leden/create");
        }
        return \View::Redirect("/admin/leden/{$post['id']}");
    }

    public function edit(array $params)
    {
        $post = $this->service->get(intval($params["id"]));
        return \View::View("admin.leden.edit", 'Wijzig lid', $post);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new LedenUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            return \View::Redirect("/admin/leden/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            return \View::Redirect("/admin/leden/{$id}");
        }
    }

    public function delete(array $params)
    {
        $id = intval($params["id"]);
        $post = $this->service->delete($id);
        if(!$post)
            return \View::Redirect("/admin/leden/{$id}");
        return \View::Redirect("/admin/leden");
    }

    public function destroy(array $params)
    {
        $id = intval($params["id"]);
        $post = $this->service->destroy($id);
        if(!$post)
            return \View::Redirect("/admin/leden/{$id}");
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