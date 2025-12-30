<?php

namespace App\Controllers;

use App\Models\Requests\TeamsStoreRequest;
use App\Models\Requests\TeamsUpdateRequest;
use App\Services\CoachesServices;
use App\Services\SpelersServices;
use App\Services\TeamsServices;
use App\Services\TrainersServices;

class TeamsController extends BaseController implements IController
{
    private TeamsServices $service;
    private SpelersServices $spelersServices;
    private CoachesServices $coachesServices;
    private TrainersServices $trainersServices;
    public function __construct()
    {
        $this->service = new TeamsServices();
        $this->spelersServices = new SpelersServices();
        $this->coachesServices = new CoachesServices();
        $this->trainersServices = new TrainersServices();
    }

    public function index()
    {
        $teams = $this->service->getAllByCategory();
        \View::View("teams.index", 'Teams', ['teams' => $teams]);
    }

    public function show(array $params)
    {
        $data = $this->service->get(intval($params['id']));
        \View::View('teams.post', $data['Titl'], $data);
    }

    public function Create()
    {
        $spelers = $this->spelersServices->getAll();
        $coaches = $this->coachesServices->getAll();
        $trainers = $this->trainersServices->getAll();
        \View::View('admin.teams.create', 'Team aanmaken', [
            'spelers' => $spelers,
            'coaches' => $coaches,
            'trainers' => $trainers,
        ]);
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
            \View::Redirect("/admin/teams/create");
        }
        \View::Redirect("/admin/teams/{$post['id']}");
    }

    public function edit(array $params)
    {
        $team = $this->service->get(intval($params["id"]));
        $coaches = $this->coachesServices->getAll();
        $spelers = $this->spelersServices->getAll();
        $trainers = $this->trainersServices->getAll();
        \View::View("admin.teams.edit", 'Wijzig bestuurslid', ['team' => $team, 'coaches' => $coaches, 'spelers' => $spelers, 'trainers' => $trainers]);
    }

    public function update(array $params)
    {
        $validated = [];
        $id = intval($params['id']);
        try {
            $validated = new TeamsUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            \View::Redirect("/admin/teams/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect("/admin/teams/{$id}");
        }
    }

    public function delete(array $params)
    {
        $post = $this->service->delete(intval($params["id"]));
        if (!$post) {
            \View::Redirect("/admin/teams/{$params["id"]}");
        }
        \View::Redirect("/admin/teams");
    }

    public function destroy(array $params)
    {
        $post = $this->service->destroy(intval($params["id"]));
        if (!$post) {
            \View::Redirect("/admin/teams/{$params["id"]}");
        }
        \View::Redirect("/admin/teams");
    }

    public function getTeams()
    {
        $filter = [
            'name' => $_POST['name'] ?? ''
        ];

        $draw = intval($_POST['draw'] ?? 1);
        $start = intval($_POST['start'] ?? 0);
        $length = intval($_POST['length'] ?? 25);

        $result = $this->service->datatable($filter, $start, $length, $draw);

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}

