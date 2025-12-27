<?php

namespace App\Controllers;
use App\Models\Requests\RolesStoreRequest;
use App\Models\Requests\RolesUpdateRequest;
use App\Services\RolesServices;

class RolesController extends BaseController implements IController {
    private RolesServices $service;
    public function __construct(?RolesServices $ledenService = null)
    {
        $this->service = $ledenService ?? new RolesServices();
    }

    public function index() {
        $data = $this->service->getAll();
        \View::View("roles.index", 'Roles', ['roles' => $data]);
    }

    public function show(array $params) {
        $data = $this->service->get(intval($params['id']));
        \View::View('roles.post', $data['Title'], $data);
    }

    public function Create() {
        \View::View('admin.roles.create', 'Rol aanmaken');
    }

    public function store()
    {
        try {
            $validated = new RolesStoreRequest($_POST)->validate();
            $post = $this->service->create($validated);
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect("/admin/roles/create");
        }
        \View::Redirect("/admin/roles/{$post['id']}");
    }

    public function edit(array $params) {
        $post = $this->service->get(intval($params["id"]));
        \View::View("admin.roles.edit", 'Wijzig bestuurslid', $post);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new RolesUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            \View::Redirect("/admin/roles/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect("/admin/roles/{$id}");
        }
    }

    public function delete(array $params) {
        $post = $this->service->delete(intval($params["id"]));
        \View::Redirect("/admin/roles");
    }

    public function destroy(array $params) {
        $post = $this->service->destroy(intval($params["id"]));
        \View::Redirect("/admin/roles");
    }
}