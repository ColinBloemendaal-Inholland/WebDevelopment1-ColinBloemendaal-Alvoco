<?php

namespace App\Controllers;

use App\Services\RolesServices;

class RolesController extends BaseController implements IController {
    private RolesServices $service;
    public function __construct(?RolesServices $ledenService = null)
    {
        $this->service = $ledenService ?? new RolesServices();
    }

    public function index(): void {
        $data = $this->service->getAll();
        return \View::View("roles.index", 'Roles', ['roles' => $data]);
    }

    public function show(array $params): void {
        $data = $this->service->get(intval($params['id']));
        return \View::View('roles.post', $data['Title'], $data);
    }

    public function Create(): void {
        return \View::View('admin.roles.create', 'Rol aanmaken');
    }

    public function store(): void {
        //TODO: Implement some validation
        $post = $this->service->create($_POST);
        return \View::Redirect("/admin/roles/{$post['id']}");
    }

    public function edit(array $params): void {
        $post = $this->service->get(intval($params["id"]));
        return \View::View("admin.roles.edit", 'Wijzig rol', $post);
    }

    public function update(): void {
        //TODO: Implement some validation
        $post = $this->service->update(intval($_POST['id']), $_POST);
        return \View::Redirect("/admin/roles/{$post['id']}");
    }

    public function delete(array $params): void {
        $post = $this->service->delete(intval($params["id"]));
        return \View::Redirect("/admin/roles");
    }

    public function destroy(array $params): void {
        $post = $this->service->destroy(intval($params["id"]));
        return \View::Redirect("/admin/roles");
    }
}