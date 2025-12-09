<?php

namespace App\Controllers;

use App\Services\TeamsServices;

class TeamsController extends BaseController implements IController {
    private TeamsServices $service;
    public function __construct(?TeamsServices $service = null)
    {
        $this->service = $service ?? new TeamsServices();
    }

    public function index(): void {
        $data = $this->service->getAll();
        return \View::View("teams.index", 'Teams', ['teams' => $data]);
    }

    public function show(array $params): void {
        $data = $this->service->get(intval($params['id']));
        return \View::View('teams.post', $data['Titl'], $data);
    }

    public function Create(): void {
        return \View::View('admin.teams.create', 'Team aanmaken');
    }

    public function store(): void {
        //TODO: Implement some validation
        $post = $this->service->create($_POST);
        return \View::Redirect("/admin/teams/{$post['id']}");
    }

    public function edit(array $params): void {
        $post = $this->service->get(intval($params["id"]));
        return \View::View("admin.teams.edit", 'Wijzig team', $post);
    }

    public function update(): void {
        //TODO: Implement some validation
        $post = $this->service->update(intval($_POST['id']), $_POST);
        return \View::Redirect("/admin/teams/{$post['id']}");
    }

    public function delete(array $params): void {
        $post = $this->service->delete(intval($params["id"]));
        return \View::Redirect("/admin/teams");
    }

    public function destroy(array $params): void {
        $post = $this->service->destroy(intval($params["id"]));
        return \View::Redirect("/admin/teams");
    }
}