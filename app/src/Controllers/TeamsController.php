<?php

namespace App\Controllers;

use App\Models\Requests\TeamsStoreRequest;
use App\Models\Requests\TeamsUpdateRequest;
use App\Services\TeamsServices;

class TeamsController extends BaseController implements IController {
    private TeamsServices $service;
    public function __construct(?TeamsServices $service = null)
    {
        $this->service = $service ?? new TeamsServices();
    }

    public function index() {
        $data = $this->service->getAll();
        return \View::View("teams.index", 'Teams', ['teams' => $data]);
    }

    public function show(array $params) {
        $data = $this->service->get(intval($params['id']));
        return \View::View('teams.post', $data['Titl'], $data);
    }

    public function Create() {
        return \View::View('admin.teams.create', 'Team aanmaken');
    }

    public function store()
    {
        try {
            $validated = new TeamsStoreRequest($_POST)->validate();
            $post = $this->service->create($validated);
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            return \View::Redirect("/admin/teams/create");
        }
        return \View::Redirect("/admin/teams/{$post['id']}");
    }

    public function edit(array $params) {
        $post = $this->service->get(intval($params["id"]));
        return \View::View("admin.teams.edit", 'Wijzig bestuurslid', $post);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new TeamsUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            return \View::Redirect("/admin/teams/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            return \View::Redirect("/admin/teams/{$id}");
        }
    }

    public function delete(array $params) {
        $post = $this->service->delete(intval($params["id"]));
        return \View::Redirect("/admin/teams");
    }

    public function destroy(array $params) {
        $post = $this->service->destroy(intval($params["id"]));
        return \View::Redirect("/admin/teams");
    }
}