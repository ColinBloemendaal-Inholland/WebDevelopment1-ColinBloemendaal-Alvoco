<?php

namespace App\Controllers;

use App\Services\TrainersServices;

class TrainersController extends BaseController implements IController {
    private TrainersServices $service;
    public function __construct(?TrainersServices $ledenService = null)
    {
        $this->service = $ledenService ?? new TrainersServices();
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
        return \View::View('admin.trainers.create', 'Trainer aanmaken');
    }

    public function store() {
        //TODO: Implement some validation
        $post = $this->service->create($_POST);
        return \View::Redirect("/admin/trainers/{$post['id']}");
    }

    public function edit(array $params) {
        $post = $this->service->get(intval($params["id"]));
        return \View::View("admin.trainers.edit", 'Wijzig trainer', $post);
    }

    public function update() {
        //TODO: Implement some validation
        $post = $this->service->update(intval($_POST['id']), $_POST);
        return \View::Redirect("/admin/trainers/{$post['id']}");
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