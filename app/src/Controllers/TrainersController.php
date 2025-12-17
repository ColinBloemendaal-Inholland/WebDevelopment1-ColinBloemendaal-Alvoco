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
        return \View::View("trainers.index", 'Trainers', ['trainers' => $data]);
    }

    public function show(array $params) {
        $data = $this->service->get(intval($params['id']));
        return \View::View('trainers.post', $data['Title'], $data);
    }

    public function Create() {
        $teams = $this->teamsServices->getAll();
        $leden = $this->ledenServices->getAll();
        return \View::View('admin.trainers.create', 'Trainer aanmaken', ['teams' => $teams, 'leden' => $leden]);
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
            return \View::Redirect("/admin/trainers/create");
        }
        return \View::Redirect("/admin/trainers/{$post['id']}");
    }

    public function edit(array $params) {
        $post = $this->service->get(intval($params["id"]));
        return \View::View("admin.trainers.edit", 'Wijzig bestuurslid', $post);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new TrainersUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            return \View::Redirect("/admin/trainers/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            return \View::Redirect("/admin/trainers/{$id}");
        }
    }

    public function delete(array $params) {
        $post = $this->service->delete(intval($params["id"]));
        return \View::Redirect("/admin/trainers");
    }

    public function destroy(array $params) {
        $post = $this->service->destroy(intval($params["id"]));
        return \View::Redirect("/admin/trainers");
    }
}