<?php

namespace App\Controllers;

use App\Models\Requests\TrainersStoreRequest;
use App\Models\Requests\TrainersUpdateRequest;
use App\Services\LedenServices;
use App\Services\TeamsServices;
use App\Services\TrainersServices;

class TrainersController extends BaseController implements IController {
    private TrainersServices $service;
    private LedenServices $ledenServices;
    private TeamsServices $teamsServices;
    public function __construct()
    {
        $this->service = new TrainersServices();
        $this->ledenServices = new LedenServices();
        $this->teamsServices = new TeamsServices();
    }

    public function index() {
        $data = $this->service->getAll();
        \View::View("trainers.index", 'Trainers', ['trainers' => $data]);
    }

    public function show(array $params) {
        $data = $this->service->get(intval($params['id']));
        \View::View('trainers.post', $data['Title'], $data);
    }

    public function Create() {
        $teams = $this->teamsServices->getAll();
        $leden = $this->ledenServices->getAll();
        \View::View('admin.trainers.create', 'Trainer aanmaken', ['teams' => $teams, 'leden' => $leden]);
    }

    public function store()
    {
        try {
            $validated = new TrainersStoreRequest($_POST)->validate();
            $post = $this->service->create($validated);
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect("/admin/trainers/create");
        }
        \View::Redirect("/admin/trainers/{$post['id']}");
    }

    public function edit(array $params) {
        $post = $this->service->get(intval($params["id"]));
        \View::View("admin.trainers.edit", 'Wijzig bestuurslid', $post);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new TrainersUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            \View::Redirect("/admin/trainers/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect("/admin/trainers/{$id}");
        }
    }

    public function delete(array $params) {
        $post = $this->service->delete(intval($params["id"]));
        \View::Redirect("/admin/trainers");
    }

    public function destroy(array $params) {
        $post = $this->service->destroy(intval($params["id"]));
        \View::Redirect("/admin/trainers");
    }

    public function GetTrainers() {
        $filter = [
            'name' => $_POST['name'] ?? '',
            'role' => $_POST['role'] ?? ''
        ];

        $draw = intval($_POST['draw'] ?? 1);
        $start = intval($_POST['start'] ?? 0);
        $length = intval($_POST['length'] ?? 25);

        $result = $this->service->datatable($filter, $start, $length, $draw);

        header('Content-Type: application/json');
        echo json_encode($result);
        return;
    }
}